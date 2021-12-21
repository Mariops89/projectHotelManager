<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\TipoHabitacionesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [ClientesController::class, 'listar'])->name('clientes');
Route::post('/clientes', [ClientesController::class, 'listarAJAX']);
Route::post('/clientes/guardar', [ClientesController::class, 'guardar']);
Route::post('/clientes/eliminar', [ClientesController::class, 'eliminar']);

Route::get('/tipo_habitaciones', [TipoHabitacionesController::class, 'listar'])->name('tipo_habitaciones');
Route::post('/tipo_habitaciones', [TipoHabitacionesController::class, 'listarAJAX']);
Route::post('/tipo_habitaciones/guardar', [TipoHabitacionesController::class, 'guardar']);
Route::post('/tipo_habitaciones/eliminar', [TipoHabitacionesController::class, 'eliminar']);

Route::get('/habitaciones', [HabitacionesController::class, 'listar'])->name('habitaciones');
Route::post('/habitaciones', [HabitacionesController::class, 'listarAJAX']);
Route::post('/habitaciones/guardar', [HabitacionesController::class, 'guardar']);
Route::post('/habitaciones/eliminar', [HabitacionesController::class, 'eliminar']);
