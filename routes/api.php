<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EquipoController;
use App\Http\Controllers\Api\MotoController;
use App\Http\Controllers\Api\ContactoController;

// --- 1. AUTENTICACIÓN Y REGISTRO (JSON) ---
Route::post('/login', [UserController::class, 'login']);
Route::post('/registro', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);

// --- 2. ENDPOINTS PÚBLICOS (Para la web principal) ---
    Route::prefix('public')->group(function () {
    Route::get('/equipo', [App\Http\Controllers\Api\EquipoController::class, 'index']);
    Route::post('/contacto', [ContactoController::class, 'store']);
    Route::get('/modelos', [MotoController::class, 'index']); 
});

// --- 3. RUTAS PROTEGIDAS (CRUD COMPLETO) ---

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    
    // Rutas para el perfil del usuario logueado
    Route::get('/user/me', [UserController::class, 'me']);
    Route::put('/user/me/update', [UserController::class, 'updateMe']);

    // Tus recursos de Admin (ahora protegidos también)
    Route::apiResource('usuarios', UserController::class);
    Route::apiResource('equipos', EquipoController::class);
    Route::apiResource('motos', MotoController::class);
    Route::apiResource('contactos', ContactoController::class);
});