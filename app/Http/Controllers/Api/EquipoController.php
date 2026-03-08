<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipo; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all()->map(function($item) {
            // Ahora la ruta es directa desde public
            $item->imagen_full_url = $item->imagen_url ? asset($item->imagen_url) : null;
            return $item;
        });

        return response()->json([
            'status' => 'success',
            'data'   => $equipos
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            $pathParaBD = null;
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $nombreImagen = time() . '_' . $file->getClientOriginalName();
                
                // Definimos la ruta en public/assets/img/equipos
                $rutaDestino = public_path('assets/img/equipos');

                // Aseguramos que la carpeta exista
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }

                // Movemos el archivo físicamente
                $file->move($rutaDestino, $nombreImagen);
                
                // Lo que guardamos en la base de datos
                $pathParaBD = 'assets/img/equipos/' . $nombreImagen;
            }

            $equipo = Equipo::create([
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen_url'  => $pathParaBD, 
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Miembro del equipo guardado correctamente',
                'data'    => $equipo
            ], 201);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error interno: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $equipo = Equipo::find($id);
        
        if (!$equipo) {
            return response()->json(['status' => 'error', 'message' => 'Miembro no encontrado'], 404);
        }

        $equipo->imagen_full_url = $equipo->imagen_url ? asset($equipo->imagen_url) : null;

        return response()->json([
            'status' => 'success',
            'data'   => $equipo
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $equipo = Equipo::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nombre'      => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }

            if ($request->hasFile('imagen')) {
                // Borramos la imagen física anterior si existe
                if ($equipo->imagen_url && file_exists(public_path($equipo->imagen_url))) {
                    @unlink(public_path($equipo->imagen_url));
                }

                // Guardamos la nueva físicamente
                $file = $request->file('imagen');
                $nombreImagen = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/equipos'), $nombreImagen);
                
                $equipo->imagen_url = 'assets/img/equipos/' . $nombreImagen;
            }

            $equipo->nombre = $request->nombre;
            $equipo->descripcion = $request->descripcion;
            $equipo->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Equipo actualizado correctamente',
                'data'    => $equipo
            ], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al actualizar: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
        
            // Borrado físico
            if ($equipo->imagen_url && file_exists(public_path($equipo->imagen_url))) {
                @unlink(public_path($equipo->imagen_url));
            }

            $equipo->delete();

            return response()->json(['status' => 'success', 'message' => 'Registro eliminado'], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }
}
