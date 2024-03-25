<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
//Librerias
use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
{

    //Middleware, permisos del controlador Material
    function _construct()
    {
        $this->middleware('permission:Ver-material|Crear-material|Editar-material|Borrar-material', ['only' => ['index']]);
        $this->middleware('permission:Crear-material', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-material', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-material', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    //Metodo para retornar vista material
    public function index()
    {
        try {
            $materials = Material::paginate(5);
            return view('materials.index', compact('materials'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo para retonar vista de agregar material
    public function create()
    {
        try {
            return view('materials.agregar');
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo para agregar material
    public function store(Request $request)
    {
        try {
            request()->validate([
                'categoria' => 'required'
            ]);
            Material::create($request->all());
            return redirect()->route('materials.index')->with('success', 'Material agregada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar la material']);
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
    //Metodo para retornar vista de editar material
    public function edit(Material $material)
    {
        try {
            return view('materials.editar', compact('material'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para actualizar material
    public function update(Request $request, Material $material)
    {
        try {
            request()->validate([
                'categoria' => 'required'
            ]);
            $material->update($request->all());
            return redirect()->route('materials.index')->with('success', 'Material editada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar la material']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar material
    public function destroy(Material $material)
    {
        try {
            $material->delete();
            return redirect()->route('materials.index')->with('success', 'Material eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar la material']);
        }
    }
}
