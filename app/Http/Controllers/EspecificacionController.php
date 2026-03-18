<?php

namespace App\Http\Controllers;

use App\Models\Moto;
use App\Models\Especificacion;
use Illuminate\Http\Request;

class EspecificacionController extends Controller
{
    // 1. READ: Listado (Opcional, pero útil para el Admin)
    public function index() {
        $especificaciones = Especificacion::with('moto')->get();
        return view('especificaciones.index', compact('especificaciones'));
    }

    // 2. CREATE: Formulario y Guardado
    public function create() {
        $motos = Moto::doesntHave('especificacion')->get();
        return view('especificaciones.create', compact('motos'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'moto_id' => 'required|exists:motos,id|unique:especificaciones,moto_id',
            'motor' => 'required|string',
            'cilindrada' => 'required|string',
            'transmision' => 'required|string',
            'frenos' => 'required|string',
            'potencia' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        Especificacion::create($data);
        return redirect()->route('admin.especificaciones.index')->with('success', 'Ficha creada.');
    }

    // 3. UPDATE: Formulario de edición y Actualización
    public function edit($id) {
        $especificacion = Especificacion::findOrFail($id);
        return view('especificaciones.edit', compact('especificacion'));
    }

    public function update(Request $request, $id) {
        $especificacion = Especificacion::findOrFail($id);
        $data = $request->validate([
            'motor' => 'required|string',
            'cilindrada' => 'required|string',
            'transmision' => 'required|string',
            'frenos' => 'required|string',
            'potencia' => 'required|string',
            'descripcion' => 'required|string',
        ]);
        $especificacion->update($data);
        return redirect()->route('admin.modelos.index')->with('success', 'Ficha actualizada.');
    }

    // 4. DELETE: Eliminar la ficha técnica
    public function destroy($id) {
        $especificacion = Especificacion::findOrFail($id);
        $especificacion->delete();
        return redirect()->back()->with('success', 'Ficha eliminada.');
    }

    // Función para el público (Ver más)
public function show($id) {
    $moto = Moto::with(['especificacion', 'marca'])->findOrFail($id);
    
    // Si la moto no tiene especificación, mandamos de vuelta con un mensaje
    if (!$moto->especificacion) {
        return redirect()->route('modelos.publico')->with('error', 'Esta moto aún no tiene ficha técnica.');
    }

    return view('frontend.show', compact('moto'));
}
}