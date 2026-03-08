<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Necesario para manejar el JSON

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja el registro de nuevos usuarios, la validación
    | y la creación. Se ha modificado para responder con JSON.
    |
    */

    use RegistersUsers;

    /**
     * Dónde redirigir a los usuarios después del registro (para peticiones no-AJAX).
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
        // MENSAJES PERSONALIZADOS EN ESPAÑOL
        'name.required'     => 'El nombre es obligatorio.',
        'email.required'    => 'El correo electrónico es obligatorio.',
        'email.unique'      => 'Este correo ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed'=> 'Las contraseñas no coinciden.', // <--- 
    ]);
}

    /**
     * Crea una nueva instancia de usuario tras un registro válido.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => '¡Usuario registrado correctamente!',
                'redirect' => $user->is_admin ? route('admin.dashboard') : '/home'
            ], 201);
        }

        return redirect($this->redirectPath());
    }
}