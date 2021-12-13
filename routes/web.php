<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HabitacionesController;
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


Route::get('/habitaciones', [HabitacionesController::class, 'listar'])->name('habitaciones');
