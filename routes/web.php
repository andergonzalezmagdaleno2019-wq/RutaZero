<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Models\Equipo;
use App\Models\Moto; // Importamos el modelo Moto

// --- 1. RAMPAS PÚBLICAS ---
Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/modelos', function () { 
    $motos = Moto::all(); 
    return view('frontend.modelos', compact('motos')); 
})->name('modelos.publico');

Route::get('/contacto', function () { return view('frontend.contacto'); })->name('contacto.create');
Route::get('/equipo', function () { return view('frontend.equipo'); })->name('equipo.publico');
Route::view('/terminos', 'auth.terms')->name('terms.index');

// Login manual para que la sesión se guarde correctamente
Route::post('/login-manual', [App\Http\Controllers\Api\UserController::class, 'login'])->name('login.manual');

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

    // CRUD USUARIOS
    Route::get('/usuarios', function () { return view('admin.dashboard'); })->name('admin.usuarios.index');
    Route::get('/usuarios/create', function () { return view('usuarios.create'); })->name('admin.usuarios.create');
    Route::get('/usuarios/{id}/edit', function ($id) { return view('usuarios.edit'); })->name('admin.usuarios.edit');

    // MENSAJES DE CONTACTO 
    Route::get('/contacto', function () { 
        return view('contacto.index'); 
    })->name('admin.contactos.index');

    // CRUD EQUIPO
    Route::get('/equipo', function () { return view('equipo.equipo'); })->name('admin.equipo.index');
    Route::get('/equipo/create', function () { return view('equipo.create'); })->name('admin.equipo.create');
    Route::get('/equipo/{id}/edit', function ($id) { return view('equipo.edit'); })->name('admin.equipo.edit');

    // MODIFICADO: CRUD MODELOS / MOTOS para ver todas las motos
    Route::get('/modelos', function () { 
        $motos = Moto::all(); 
        return view('modelos.index', compact('motos')); 
    })->name('admin.modelos.index');

    Route::get('/modelos/create', function () { 
        return view('modelos.create'); 
    })->name('admin.modelos.create');

    Route::get('/modelos/{id}/edit', function ($id) { 
        $moto = Moto::findOrFail($id);
        return view('modelos.edit', compact('moto')); 
    })->name('admin.modelos.edit');
});

Route::get('/mis-datos', function () {
    return view('frontend.edit_datos');
})->name('perfil.editar');

// --- 5. COMODÍN (SIEMPRE AL FINAL) ---
Route::get('/{any}', function () { 
    return view('welcome'); 
})->where('any', '.*');