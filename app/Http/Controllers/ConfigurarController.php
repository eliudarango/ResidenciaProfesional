<?php

namespace App\Http\Controllers;

// Librerias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfigurarController extends Controller
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
     * 
     */
    //Metodo para retonar a la vista para cambiar foto de perfil
    public function index()
    {
        try {
            return view('perfil.configurar');
        } catch (\Throwable $th) {
        }
    }
    /**
     * Write code on Method
     *
     *
     */
    //Metodo para cambiar foto de perfil
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
                'telefono' => 'required|string|max:20',
                'avatar' => 'required|image',
            ]);
            // Validacion para eliminar la antigua foto , para no almacenarlas al hacer el update
            $AntiguoAvatar = public_path('avatars/' . Auth()->user()->avatar);
            if (File::exists($AntiguoAvatar)) {
                File::delete($AntiguoAvatar);
            }

            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            // Hacer el update
            Auth()
                ->user()
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'avatar' => $avatarName
                ]);
            //retonar mensaje correcto
            return back()->with('success', 'Perfil modificado correctamente.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Ha ocurrido un error al modificar el perfil']);
        }
    }
}
