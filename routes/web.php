<?php

use Illuminate\Support\Facades\Route;
//Llamada a controladores
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InventarioController;
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
    //Ruta de roles
    Route::resource('roles', RolController::class);
    //Ruta de usuarios
    Route::resource('usuarios', UsuarioController::class);
     //Ruta de inventarios
     Route::resource('inventarios', InventarioController::class);

});
//Ruta de home o inicio
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');







