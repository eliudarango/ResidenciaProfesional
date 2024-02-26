<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;

//Librerias
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    //Middleware, permisos del controlador Rol
    function _construct()
    {
        $this->middleware('permission:Ver-rol|Crear-rol|Editar-rol|Borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:Crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-rol', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::paginate(5);
            return view('roles.index', compact('roles'));
        } catch (\Throwable $th) {
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo de crear rol
    public function create()
    {
        try {
            $permission = Permission::get();
            return view('roles.agregar', compact('permission'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo de vista para crear rol
    public function store(Request $request)
    {
        try {
            $this->validate($request, ['name' => 'required', 'permission' => 'required']);
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            return redirect()->route('roles.index')->with('success', 'Rol agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar el rol']);
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
    //Metodo para editar rol
    public function edit(string $id)
    {
        try {
            $role = Role::find($id);
            $permission = Permission::get();
            $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();
            return view('roles.editar', compact('role', 'permission', 'rolePermissions'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para editar rol
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, ['name' => 'required', 'permission' => 'required']);
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            return redirect()->route('roles.index')->with('success', 'Rol editado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar el rol']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar rol
    public function destroy(string $id)
    {
        try {
            DB::table('roles')->where('id', $id)->delete();
            return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el rol']);
        }
    }
}