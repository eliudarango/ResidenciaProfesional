<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RolController extends Controller
{

    function _construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permission = Permission::get();
        return view('roles.agregar', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
    public function edit(string $id)
    {
        //
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.editar', compact('role', 'permission', 'rolePermissions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, ['name' => 'required', 'permission' => 'required']);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index');
    }
}