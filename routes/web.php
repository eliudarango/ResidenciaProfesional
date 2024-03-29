<?php

use Illuminate\Support\Facades\Route;
//Llamada a controladores
use App\Http\Controllers\Administrador\RolController;
use App\Http\Controllers\Administrador\UsuarioController;
use App\Http\Controllers\Inventario\MaterialController;
use App\Http\Controllers\Inventario\ArticuloController;
use App\Http\Controllers\Inventario\InsumoController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Rutas de autenticación
Auth::routes();
//Rutas de middleware
Route::group(['middleware' => ['auth']], function () {
    //Ruta home o inicio 
    Route::resource('/', HomeController::class);
    //Ruta de roles
    Route::resource('roles', RolController::class);
    //Ruta de usuarios
    Route::resource('usuarios', UsuarioController::class);
    //Ruta de materiales
    Route::resource('materials', MaterialController::class);
    //Ruta de articulos
    Route::resource('articulos', ArticuloController::class);
    //Ruta de insumos
    Route::resource('insumos', InsumoController::class);
    //Ruta de perfil
    Route::resource('perfil', PerfilController::class);

});
//Ruta que capture todas las URL no coincidentes
Route::fallback(function () {
    return redirect('/');
});








