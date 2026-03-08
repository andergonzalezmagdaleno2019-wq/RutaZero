<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller {

    public function me(Request $request) {
        return response()->json(Auth::user(), 200);
    }

    public function updateMe(Request $request) {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user->name = $request->nombre_completo;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status'  => 'success',
            'message' => '¡Tus datos han sido actualizados!',
            'data'    => $user
        ], 200);
    }

// CRUD ADMIN

    public function index() {
        $usuarios = User::all();
        return response()->json([
            'status' => 'success',
            'data'   => $usuarios
        ], 200);
    }

    public function show($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
        }
        return response()->json([
            'status' => 'success',
            'data'   => $user
        ], 200);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'required|string|max:255',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name'     => $request->nombre_completo,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario creado correctamente',
            'data'    => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Formato de correo inválido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return response()->json([
                'status' => 'success',
                'message' => '¡Bienvenido de nuevo!',
                'user' => Auth::user()
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'El correo o la contraseña son incorrectos.'
        ], 401);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'No encontrado'], 404);

        $user->name = $request->nombre_completo ?? $request->name;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario actualizado',
            'data'    => $user
        ], 200);
    }

    public function destroy($id) {
        $user = User::find($id);
        if (!$user) return response()->json(['status' => 'error', 'message' => 'No encontrado'], 404);
        
        $user->delete();
        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario eliminado'
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}