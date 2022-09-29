<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class, 'show']);

Route::get('/dashboard',[DashboardController::class, 'show'])->middleware('auth');

Route::group(['prefix' => 'admin', 'as'=>'admin.',  'middleware' => ['auth','isAdmin']], function()
{
    //Actividades
    Route::group(['prefix' => 'actividades','as'=>'actividades.'], function()
    {
    Route::get('/',[ActividadController::class, 'index'])->name('index');
    Route::get('/crear',[ActividadController::class, 'create']);
    Route::post('/guardar',[ActividadController::class, 'store']);
    Route::get('/{actividad}',[ActividadController::class, 'show']);
    Route::get('/{actividad}/editar',[ActividadController::class, 'edit']);
    Route::put('/{actividad}',[ActividadController::class, 'update']);
    Route::delete('/{actividad}',[ActividadController::class, 'destroy']);
    });

    //Eventos
    Route::group(['prefix' => 'eventos'], function()
    { 
    Route::get('/',[EventoController::class, 'index']);
    Route::get('/crear',[EventoController::class, 'create']);
    Route::post('/guardar',[EventoController::class, 'store']);
    Route::get('/{evento}',[EventoController::class, 'show']);
    Route::get('/{evento}/editar',[EventoController::class, 'edit']);
    Route::put('/{evento}',[EventoController::class, 'update']);
    Route::delete('/{evento}',[EventoController::class, 'destroy']);
    });
});

require __DIR__.'/auth.php';
