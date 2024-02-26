<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
//Librerias
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use App\Models\Categoria;

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
            $inventarios = Inventario::with('categoria')->get()->groupBy('id_categoria');
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
            $categorias = Categoria::all();
            return view('inventarios.agregar', compact('categorias'));
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
                'id_categoria' => 'required',
                'descripcion' => 'required',
                'numero_serie',
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
            $categorias = Categoria::all();
            return view('inventarios.editar', compact('inventario','categorias'));
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
                'id_categoria' => 'required',
                'descripcion' => 'required',
                'numero_serie',
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
