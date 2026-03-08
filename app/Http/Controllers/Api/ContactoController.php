<?php

namespace App\Http\Controllers\Api;

use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    // Listar todos los mensajes (Panel Admin)
    public function index()
    {
        $contactos = Contacto::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'count'  => $contactos->count(),
            'data'   => $contactos
        ], 200);
    }

    // Guardar nuevo mensaje (Formulario Público)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'required|string|max:255',
            'correo'          => 'required|email',
            'asunto'          => 'required|string|max:100',
            'mensaje'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $contacto = Contacto::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Mensaje enviado correctamente',
            'data'    => $contacto
        ], 201);
    }

    // Ver un mensaje específico
    public function show($id)
    {
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $contacto
        ], 200);
    }

    // Eliminar un mensaje
    public function destroy($id)
    {
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado'
            ], 404);
        }

        $contacto->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Mensaje eliminado correctamente'
        ], 200);
    }
}