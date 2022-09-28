<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\DashboardController;
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

Route::group(['prefix' => 'admin',  'middleware' => ['auth','isAdmin']], function()
{
    Route::post('/actividad',[ActividadController::class, 'show']);
});

require __DIR__.'/auth.php';
