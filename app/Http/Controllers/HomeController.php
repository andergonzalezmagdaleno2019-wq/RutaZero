<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    // Buscamos todos los registros de la tabla equipos
    $equipos = \App\Models\Equipo::all(); 

    // Los pasamos a la vista. El nombre 'equipos' aquí 
    // debe coincidir con el del @foreach
    return view('home', compact('equipos'));
    }
}
