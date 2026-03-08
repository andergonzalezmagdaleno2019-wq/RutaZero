<?php

namespace App\Http\Controllers\Api;

use App\Models\Moto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MotoController extends Controller
{
    public function index(Request $request)
    {
        $marca = $request->query('marca');

        $query = Moto::query();

        if ($marca) {
            $query->where('marca', 'LIKE', '%' . $marca . '%');
        }

        $motos = $query->get()->map(function($moto) {
            // Generamos la URL para que el frontend la use directamente
            $moto->imagen_url = $moto->imagen ? asset($moto->imagen) : null;
            return $moto;
        });

        return response()->json([
            'status' => 'success',
            'count'  => $motos->count(),
            'data'   => $motos
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modelo' => 'required|string',
            'marca'  => 'required|string',
            'cilindrada' => 'required|numeric',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/modelos'), $nombreImagen);
            $data['imagen'] = 'assets/img/modelos/' . $nombreImagen;
        }

        $moto = Moto::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Modelo registrado con éxito',
            'data'    => $moto
        ], 201);
    }

    public function show($id)
    {
        $moto = Moto::find($id);

        if (!$moto) {
            return response()->json(['status' => 'error', 'message' => 'Moto no encontrada'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $moto
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $moto = Moto::find($id);
        if (!$moto) {
            return response()->json(['status' => 'error', 'message' => 'No encontrada'], 404);
        }

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe físicamente
            if ($moto->imagen && file_exists(public_path($moto->imagen))) {
                unlink(public_path($moto->imagen));
            }

            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/modelos'), $nombreImagen);
            $data['imagen'] = 'assets/img/modelos/' . $nombreImagen;
        }

        $moto->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Moto actualizada con éxito',
            'data'    => $moto
        ], 200);
    }

    public function destroy($id)
    {
        $moto = Moto::find($id);
        if (!$moto) return response()->json(['status' => 'error', 'message' => 'No encontrada'], 404);

        if ($moto->imagen && file_exists(public_path($moto->imagen))) {
            unlink(public_path($moto->imagen));
        }

        $moto->delete();
        return response()->json(['status' => 'success', 'message' => 'Moto eliminada'], 200);
    }
}