<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use App\Models\Actividad;
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

Route::get('/', [HomeController::class, 'show']);

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => ['auth', 'isAdmin']], function () {
    //Admin Actividades
    Route::group(['prefix' => 'actividades', 'as' => 'actividades.'], function () {
        Route::get('/', [ActividadController::class, 'index'])->name('index');
        Route::get('/crear', [ActividadController::class, 'create'])->name('create');
        Route::post('/guardar', [ActividadController::class, 'store']);
        Route::get('/{actividad}', [ActividadController::class, 'show'])->name('show');
        Route::get('/{actividad}/editar', [ActividadController::class, 'edit'])->name('edit');
        Route::put('/{actividad}', [ActividadController::class, 'update']);
        Route::delete('/{actividad}', [ActividadController::class, 'destroy']);
        Route::get('/json/getActividades', [ActividadController::class, 'getActividadesJson']);
    });

    //Admin Eventos
    Route::group(['prefix' => 'eventos', 'as' => 'eventos.'], function () {
        Route::get('/', [EventoController::class, 'index'])->name('index');
        Route::get('/crear', [EventoController::class, 'create'])->name('create');
        Route::post('/guardar', [EventoController::class, 'store']);
        Route::get('/{evento}', [EventoController::class, 'show'])->name('show');
        Route::get('/{evento}/editar', [EventoController::class, 'edit'])->name('edit');
        Route::put('/{evento}', [EventoController::class, 'update']);
        Route::delete('/{evento}', [EventoController::class, 'destroy']);
        Route::get('/json/getEventos', [EventoController::class, 'getEventosJson']);
    });

    // Admin Reservas 

    Route::group(['prefix' => 'reservas', 'as' => 'reservas.'], function () {
        Route::get('/', [ReservaController::class, 'index'])->name('index');
        Route::delete('/{reserva}', [ReservaController::class, 'destroy']);
        Route::get('/json/getReservas', [ReservaController::class, 'getReservasJson']);

    });

    // Admin Inscripciones 

    Route::group(['prefix' => 'inscripciones', 'as' => 'inscripciones.'], function () {
        Route::get('/', [InscripcionController::class, 'index'])->name('index');
        Route::delete('/{inscripcion}', [InscripcionController::class, 'destroy']);
        Route::get('/json/getInscripciones', [InscripcionController::class, 'getInscripcionesJson']);

    });

    // Admin Usuarios 

    Route::group(['prefix' => 'lista-usuarios', 'as' => 'lista-usuarios.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/{user}', [UserController::class, 'destroy']);
        Route::get('/json/getUsuarios', [UserController::class, 'getUsuariosJson']);

    });
});

Route::group(['prefix' => 'user', 'as' => 'user.',  'middleware' => ['auth']], function () {
    //User Reservas
    Route::group(['prefix' => 'reservas', 'as' => 'reservas.'], function () {
        Route::get('/', [UserController::class, 'indexReservas'])->name('reservas');
        Route::delete('/{reserva}', [UserController::class, 'destroyReserva']);
        Route::get('/json/getReservas', [UserController::class, 'getReservasJson']);
    });

   //User Inscripciones
   Route::group(['prefix' => 'inscripciones', 'as' => 'inscripciones.'], function () {
    Route::get('/', [UserController::class, 'indexInscripciones'])->name('inscripciones');
    Route::delete('/{inscripcion}', [UserController::class, 'destroyInscripcion']);
    Route::get('/json/getInscripciones', [UserController::class, 'getInscripcionesJson']);
});

});

Route::group(['prefix' => 'reservar-actividad', 'as' => 'reservar-actividad.', 'middleware' => ['auth']], function () {
    Route::get('/{actividad}', [ActividadController::class, 'previewActividad'])->name('preview-actividad');
    Route::post('/guardar', [ReservaController::class, 'store']);

});

Route::group(['prefix' => 'inscripcion-evento', 'as' => 'inscripcion-evento.', 'middleware' => ['auth']], function () {
    Route::get('/{evento}', [EventoController::class, 'previewEvento'])->name('preview-evento');
    Route::post('/guardar', [InscripcionController::class, 'store']);

});

Route::get('/actividades', [ActividadController::class, 'actividadesWeb'])->name('actividades-web');
Route::get('/eventos', [EventoController::class, 'eventosWeb'])->name('eventos-web');

require __DIR__ . '/auth.php';
