<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
//Librerias
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;


class UsuarioController extends Controller
{
    //Middleware, permisos del controlador usuario
    function _construct()
    {
        $this->middleware('permission:Ver-usuarios|Crear-usuarios|Editar-usuarios|Borrar-usuarios', ['only' => ['index']]);
        $this->middleware('permission:Crear-usuarios', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-usuarios', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-usuarios', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = User::paginate(5);
            return view('usuarios.index', compact('usuarios'));
        } catch (\Throwable $th) {
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    //Metodo para usuario usuario
    public function create()
    {
        try {
            $roles = Role::pluck('name', 'name')->all();
            return view('usuarios.agregar', compact('roles'));
        } catch (\Throwable $th) {
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    //Metodo de vista de agregar usuario
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required | email |unique:users,email',
                'password' => 'required | same:confirm-password',
                'roles' => 'required'

            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return redirect()->route('usuarios.index')->with('success', 'Usuario agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar el usuario']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    //Metodo para editar usuario
    public function edit(string $id)
    {
        try {
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();
            return view('usuarios.editar', compact('user', 'roles', 'userRole'));
        } catch (\Throwable $th) {
        }
    }
    /**
     * Update the specified resource in storage.
     */
    //Metodo para modificar usuario
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required | email |unique:users,email,' . $id,
                'password' => 'same:confirm-password',
                'roles' => 'required'

            ]);
            $input = $request->all();

            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }
            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
            return redirect()->route('usuarios.index')->with('success', 'Usuario editado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar al usuario']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar usuario
    public function destroy(string $id)
    {
        try {
            User::find($id)->delete();
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar al usuario']);
        }
    }
}