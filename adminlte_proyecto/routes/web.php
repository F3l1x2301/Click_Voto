<?php

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

//Rutas de Welcome
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'view_welcome'])->name('welcome');

//Rutas para AboutUS
Route::get('/about', [App\Http\Controllers\AboutUSController::class, 'view_aboutus']);

//Rutas para el tarjeton
Route::get('tarjeton', [App\Http\Controllers\TarjetonController::class, 'view_design']);

//Autenticacion
Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Inscripcion de candidatos
Route::get('inscribirCandidatos/{id}', [App\Http\Controllers\InscribirCandidatoController::class, 'view_inscribirCandidato'])->name('inscribirCandidatos');

Route::post('inscribir', [App\Http\Controllers\InscribirCandidatoController::class, 'inscribirCandidatoEstudiante'])->name('CandidatoEstudiante');

//Estudiantes
Route::get('estudiante', [App\Http\Controllers\Estudiantes::class, 'view_Estudiante'])->name('estudiante');

Route::post('estudiante', [App\Http\Controllers\Estudiantes::class, 'guardar_estudiantes'])->name('guardar_estudiantes');

//Guardar Imagenes
Route::post('store{id}', [App\Http\Controllers\FileControllers::class, 'store_file'])->name('store_file');
