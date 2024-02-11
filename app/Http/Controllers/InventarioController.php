<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Librerias
use App\Models\Inventario;

class InventarioController extends Controller
{

    //Middleware, permisos del controlador Inventario
    function _construct()
    {
        $this->middleware('permission:Ver-inventario|Crear-inventario|Editar-inventario|Borrar-inventario', ['only' => ['index']]);
        $this->middleware('permission:Crear-inventario', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-inventario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-inventario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    //Metodo para retornar vista inventario
    public function index()
    {
        try {
            $inventarios = Inventario::paginate(5);
            return view('inventarios.index', compact('inventarios'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo para retonar vista de agregar inventario
    public function create()
    {
        try {
            return view('inventarios.agregar');
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo para agregar inventario
    public function store(Request $request)
    {
        try {
            request()->validate([
                'descripcion' => 'required',
                'estado',
                'mantenimiento'
            ]);
            Inventario::create($request->all());
            return redirect()->route('inventarios.index')->with('success', 'Inventario agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar el inventario']);
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
    //Metodo para retornar vista de editar inventario
    public function edit(Inventario $inventario)
    {
        try {
            return view('inventarios.editar', compact('inventario'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para actualizar inventario
    public function update(Request $request, Inventario $inventario)
    {
        try {
            request()->validate([
                'descripcion' => 'required',
                'estado',
                'mantenimiento'
            ]);
            $inventario->update($request->all());
            return redirect()->route('inventarios.index')->with('success', 'Inventario editado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar el inventario']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar inventario
    public function destroy(Inventario $inventario)
    {
        try {
            $inventario->delete();
            return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el inventario']);
        }
    }
}
