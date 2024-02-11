<?php

namespace App\Http\Controllers;
//Librerias
use Illuminate\Http\Request;

class HomeController extends Controller
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
    //Vista para retornar a la pagina de inicio o home
    public function index()
    {
        return view('home');
    }
}
