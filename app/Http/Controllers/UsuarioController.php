<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;


class UsuarioController extends Controller
{
    function _construct()
    {
        $this->middleware('permission:ver-usuarios|crear-usuarios|editar-usuarios|borrar-usuarios', ['only' => ['index']]);
        $this->middleware('permission:crear-usuarios', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuarios', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-usuarios', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::paginate(5);
        return view('usuarios.index', compact('usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.agregar', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}