<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\EspecificacionController; // Importación correcta
use App\Models\Equipo;
use App\Models\Moto;

// --- 1. RAMPAS PÚBLICAS ---
Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/modelos', function () { 
    $motos = Moto::all(); 
    return view('frontend.modelos', compact('motos')); 
})->name('modelos.publico');

// Esta ruta es para cuando NO han seleccionado una moto
Route::get('/especificaciones', function () {
    return view('frontend.especificaciones_info');
})->name('especificaciones.info');

// Ruta simplificada gracias al 'use' de arriba
Route::get('/modelos/detalle/{id}', [EspecificacionController::class, 'show'])->name('especificaciones.show');

Route::get('/contacto', function () { return view('frontend.contacto'); })->name('contacto.create');
Route::get('/equipo', function () { return view('frontend.equipo'); })->name('equipo.publico');
Route::view('/terminos', 'auth.terms')->name('terms.index');

Route::post('/login-manual', [UserController::class, 'login'])->name('login.manual');

// --- 2. AUTENTICACIÓN ---
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/registro', function () { return view('auth.register'); })->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/registro', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// --- 3. ÁREA PRIVADA (Usuario Normal) ---
Route::get('/home', function () { 
    $equipos = Equipo::all(); 
    return view('home', compact('equipos')); 
})->name('home')->middleware('auth');

// --- 4. ÁREA PRIVADA (Gestión Admin) ---
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');

    // CRUD ESPECIFICACIONES (COMPLETO: Las 4 funciones + index y show)
    Route::get('/especificaciones', [EspecificacionController::class, 'index'])->name('admin.especificaciones.index');
    Route::get('/especificaciones/create', [EspecificacionController::class, 'create'])->name('admin.especificaciones.create');
    Route::post('/especificaciones', [EspecificacionController::class, 'store'])->name('admin.especificaciones.store');
    Route::get('/especificaciones/{id}/edit', [EspecificacionController::class, 'edit'])->name('admin.especificaciones.edit');
    Route::put('/especificaciones/{id}', [EspecificacionController::class, 'update'])->name('admin.especificaciones.update');
    Route::delete('/especificaciones/{id}', [EspecificacionController::class, 'destroy'])->name('admin.especificaciones.destroy');

    // CRUD USUARIOS
    Route::get('/usuarios', function () { return view('admin.dashboard'); })->name('admin.usuarios.index');
    Route::get('/usuarios/create', function () { return view('usuarios.create'); })->name('admin.usuarios.create');
    Route::get('/usuarios/{id}/edit', function ($id) { return view('usuarios.edit'); })->name('admin.usuarios.edit');

    // MENSAJES DE CONTACTO 
    Route::get('/contacto', function () { return view('contacto.index'); })->name('admin.contactos.index');

    // CRUD EQUIPO
    Route::get('/equipo', function () { return view('equipo.equipo'); })->name('admin.equipo.index');
    Route::get('/equipo/create', function () { return view('equipo.create'); })->name('admin.equipo.create');
    Route::get('/equipo/{id}/edit', function ($id) { return view('equipo.edit'); })->name('admin.equipo.edit');

    // CRUD MODELOS / MOTOS
    Route::get('/modelos', function () { 
        $motos = Moto::all(); 
        return view('modelos.index', compact('motos')); 
    })->name('admin.modelos.index');

    Route::get('/modelos/create', function () { return view('modelos.create'); })->name('admin.modelos.create');

    Route::get('/modelos/{id}/edit', function ($id) { 
        $moto = Moto::findOrFail($id);
        return view('modelos.edit', compact('moto')); 
    })->name('admin.modelos.edit');
});

Route::get('/mis-datos', function () { return view('frontend.edit_datos'); })->name('perfil.editar');

// --- 5. COMODÍN ---
Route::get('/{any}', function () { return view('welcome'); })->where('any', '.*');