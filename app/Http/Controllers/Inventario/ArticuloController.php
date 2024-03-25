<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
//Librerias
use App\Http\Controllers\Controller;
use App\Models\Articulo;
use App\Models\Material;

class ArticuloController extends Controller
{

    //Middleware, permisos del controlador Articulo
    function _construct()
    {
        $this->middleware('permission:Ver-articulo|Crear-articulo|Editar-articulo|Borrar-articulo', ['only' => ['index']]);
        $this->middleware('permission:Crear-articulo', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-articulo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-articulo', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    //Metodo para retornar vista articulo
    public function index()
    {
        try {
            $articulos = Articulo::paginate(5);
            return view('articulos.index', compact('articulos'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo para retonar vista de agregar articulo
    public function create()
    {
        try {
            $materiales = Material::all();
            return view('articulos.agregar', compact('materiales'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo para agregar articulo
    public function store(Request $request)
    {
        try {
            request()->validate([
                'numero_serie' => 'required',
                'material_id' => 'required'
                
            ]);
            Articulo::create($request->all());
            return redirect()->route('articulos.index')->with('success', 'Articulo agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar el articulo']);
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
    //Metodo para retornar vista de editar articulo
    public function edit(Articulo $articulo)
    {
        try {
            $materiales = Material::all();
            return view('articulos.editar', compact('articulo','materiales'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para actualizar articulo
    public function update(Request $request, Articulo $articulo)
    {
        try {
            request()->validate([
                'numero_serie' => 'required',
                'material_id' => 'required'
            ]);
            $articulo->update($request->all());
            return redirect()->route('articulos.index')->with('success', 'Articulo editado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar el articulo']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar articulo
    public function destroy(Articulo $articulo)
    {
        try {
            $articulo->delete();
            return redirect()->route('articulos.index')->with('success', 'Articulo eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar el articulo']);
        }
    }
}
