<?php

namespace App\Http\Controllers;
//Librerias
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Metodo para retornar a la vista del profile o perfil
    public function index()
    {
        return view('perfil.perfil');
    }
}
