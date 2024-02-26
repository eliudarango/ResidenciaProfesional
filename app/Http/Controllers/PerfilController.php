<?php

namespace App\Http\Controllers;

//Librerias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('perfil.index');
        } catch (\Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return view('perfil.editar');
        } catch (\Throwable $th) {
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
                    'avatar' => $avatarName,
                ]);
            //retonar mensaje correcto
            return back()->with('success', 'Perfil modificado correctamente.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Ha ocurrido un error al modificar el perfil']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
