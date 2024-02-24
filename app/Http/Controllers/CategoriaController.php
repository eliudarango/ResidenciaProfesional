<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Librerias
use App\Models\Categoria;

class CategoriaController extends Controller
{

    //Middleware, permisos del controlador Categoria
    function _construct()
    {
        $this->middleware('permission:Ver-categoria|Crear-categoria|Editar-categoria|Borrar-categoria', ['only' => ['index']]);
        $this->middleware('permission:Crear-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Borrar-categoria', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    //Metodo para retornar vista categoria
    public function index()
    {
        try {
            $categorias = Categoria::paginate(5);
            return view('categorias.index', compact('categorias'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    //Metodo para retonar vista de agregar categoria
    public function create()
    {
        try {
            return view('categorias.agregar');
        } catch (\Throwable $th) {
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    //Metodo para agregar categoria
    public function store(Request $request)
    {
        try {
            request()->validate([
                'tipo' => 'required'
            ]);
            Categoria::create($request->all());
            return redirect()->route('categorias.index')->with('success', 'Categoria agregada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al agregar la categoria']);
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
    //Metodo para retornar vista de editar categoria
    public function edit(Categoria $categoria)
    {
        try {
            return view('categorias.editar', compact('categoria'));
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    //Metodo para actualizar categoria
    public function update(Request $request, Categoria $categoria)
    {
        try {
            request()->validate([
                'tipo' => 'required'
            ]);
            $categoria->update($request->all());
            return redirect()->route('categorias.index')->with('success', 'Categoria editada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al editar la categoria']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //Metodo para eliminar categoria
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('categorias.index')->with('success', 'Categoria eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ha ocurrido un error al eliminar la categoria']);
        }
    }
}
