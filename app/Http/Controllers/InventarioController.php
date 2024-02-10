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
        $this->middleware('permission:ver-inventario|crear-inventario|editar-inventario|borrar-inventario', ['only' => ['index']]);
        $this->middleware('permission:crear-inventario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-inventario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-inventario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::paginate(5);
        return view('inventarios.index',compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('inventarios.agregar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'descripcion'=>'required',
            'estado',
            'mantenimiento'
        ]);
        Inventario::create($request->all());
        return redirect()->route('inventarios.index');

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
    public function edit(Inventario $inventario)
    {
        return view('inventarios.editar',compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        request()->validate([
            'descripcion'=>'required',
            'estado',
            'mantenimiento'
        ]);
        $inventario->update($request->all());
        return redirect()->route('inventarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return redirect()->route('inventarios.index');
    }
}
