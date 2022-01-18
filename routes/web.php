<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\IncidenciasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TipoHabitacionesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\Acceso;
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
Route::get('/dashboard', [DashboardController::class, 'mostrar'])->name('dashboard');


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

Route::get('/servicios', [ServiciosController::class, 'listar'])->name('servicios');
Route::post('/servicios', [ServiciosController::class, 'listarAJAX']);
Route::post('/servicios/guardar', [ServiciosController::class, 'guardar']);
Route::post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

Route::get('/usuarios', [UsuariosController::class, 'listar'])->name('usuarios');
Route::post('/usuarios', [UsuariosController::class, 'listarAJAX']);
Route::post('/usuarios/guardar', [UsuariosController::class, 'guardar']);
Route::post('/usuarios/eliminar', [UsuariosController::class, 'eliminar']);

Route::get('/personal', [PersonalController::class, 'listar'])->name('personal');
Route::post('/personal', [PersonalController::class, 'listarAJAX']);
Route::post('/personal/guardar', [PersonalController::class, 'guardar']);
Route::post('/personal/eliminar', [PersonalController::class, 'eliminar']);

Route::get('/login', [LoginController::class, 'mostrar'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->withoutMiddleware(Acceso::class);

Route::get('/incidencias', [IncidenciasController::class, 'listar'])->name('incidencias');
Route::post('/incidencias', [IncidenciasController::class, 'listarAJAX']);
Route::post('/incidencias/guardar', [IncidenciasController::class, 'guardar']);
Route::post('/incidencias/eliminar', [IncidenciasController::class, 'eliminar']);
