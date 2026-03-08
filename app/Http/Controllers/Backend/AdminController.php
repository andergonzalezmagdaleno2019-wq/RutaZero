<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <--- PASO 1: Importar el modelo de Usuarios

class AdminController extends Controller
{
    public function dashboard()
    {
        // PASO 2: Consultar todos los usuarios de la base de datos
        $usuarios = User::all(); 

        // PASO 3: Enviar la variable 'usuarios' a la vista
        return view('admin.dashboard', compact('usuarios'));
    }
}