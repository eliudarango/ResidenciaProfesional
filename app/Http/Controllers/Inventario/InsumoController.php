<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
//Librerias
use App\Http\Controllers\Controller;
use App\Models\Insumo;
use App\Models\Material;

class InsumoController extends Controller
{

    //Middleware, permisos del controlador Insumo
    function _construct()
    {
        $this->middleware('permission:Ver-insumo|Crear-insumo|Editar-insumo|Borrar-insumo', ['only' => ['index']]);
        $this->middleware('permission:Crear-insumo', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-insumo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-insumo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    //Metodo para retornar vista insumo
    public function index()
    {
        try {
            $insumos = Insumo::paginate(5);
            return view('insumos.index', compact('insumos'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo para retonar vista de agregar insumo
    public function create()
    {
        try {
            $materiales = Material::all();
            return view('insumos.agregar', compact('materiales'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo para agregar insumo
    public function store(Request $request)
    {
        try {
            request()->validate([
                'material_id' => 'required'
            ]);
            Insumo::create($request->all());
            return redirect()->route('insumos.index')->with('success', 'Insumo agregada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar la insumo']);
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
    //Metodo para retornar vista de editar insumo
    public function edit(Insumo $insumo)
    {
        try {
            $materiales = Material::all();
            return view('insumos.editar', compact('insumo','materiales'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para actualizar insumo
    public function update(Request $request, Insumo $insumo)
    {
        try {
            request()->validate([
                'material_id' => 'required'
            ]);
            $insumo->update($request->all());
            return redirect()->route('insumos.index')->with('success', 'Insumo editada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar la insumo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar insumo
    public function destroy(Insumo $insumo)
    {
        try {
            $insumo->delete();
            return redirect()->route('insumos.index')->with('success', 'Insumo eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar la insumo']);
        }
    }
}
