<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\AyudaController;
use App\Http\Controllers\CuentaAsociadaController;
use App\Http\Controllers\PagarController;
use App\Http\Controllers\RecuperacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TarjetaBancariaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest 
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/', [AutenticacionController::class, 'login'])->name('login');
    Route::post('entrar', [AutenticacionController::class, 'entering'])->name('entering');

    Route::controller(RegistroController::class)->group( function () {
        Route::get('registro', 'index')->name('registro.index');
        Route::post('registro', 'store')->name('registro.store');
    });

    Route::controller(RecuperacionController::class)->group( function () {
        Route::get('recuperacion', 'index')->name('recuperacion.index');
        Route::post('recuperacion', 'verify')->name('recuperacion.verify');
        Route::patch('recuperacion', 'generate')->name('recuperacion.generate');
    });
});

// Auth
Route::middleware(['web', 'auth'], ['except' => []])->group(function () {
    Route::get('pagar', [PagarController::class, 'index'])->name('pagar.index');
    Route::get('pagar/{numero_cuenta}', [PagarController::class, 'crear'])->name('pagar.crear');
    Route::post('pagar/{numero_cuenta}/validar', [PagarController::class, 'validar'])->name('pagar.validar');
    Route::post('pagar/{numero_cuenta}/validado/{tarjeta_bancaria}', [PagarController::class, 'validado'])->name('pagar.validado')->withoutMiddleware('auth')->middleware('reauth3DS'); // VerifyCsrfToken::$except
    Route::get('pagar/{numero_cuenta}/autorizar/{id_transaccion}', [PagarController::class, 'autorizar'])->name('pagar.autorizar'); 
    Route::post('pagar/{numero_cuenta}/procesar/{id_transaccion}', [PagarController::class, 'procesar'])->name('pagar.procesar'); 
    
    Route::get('cuentas_asociadas/{numero}/descargar', [CuentaAsociadaController::class, 'descargar'])->name('cuentas_asociadas.descargar');
    Route::resource('cuentas_asociadas', CuentaAsociadaController::class)->except(['show','edit','update']);
           
    Route::resource('tarjetas_bancarias', TarjetaBancariaController::class)
        ->parameter('tarjetas_bancarias', 'tarjeta_bancaria')
        ->except('show');

    Route::get('usuario/edit', [UsuarioController::class,'edit'])->name('usuario.edit');
    Route::patch('usuario/identificacion', [UsuarioController::class,'updateIdentificacion'])->name('usuario.update.identificacion');
    Route::patch('usuario/contrasena', [UsuarioController::class,'updateContrasena'])->name('usuario.update.contrasena');
    Route::get('ayuda', AyudaController::class)->name('ayuda.index');
    Route::post('terminar', [AutenticacionController::class, 'logout'])->name('logout');
});
