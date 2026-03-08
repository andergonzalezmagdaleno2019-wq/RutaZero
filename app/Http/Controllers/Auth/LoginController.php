<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Este método se ejecuta justo después de que el usuario se loguea con éxito.
     */
    protected function authenticated(Request $request, $user)
    {
        // Si la petición viene de un fetch (JSON)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => $user->is_admin == 1 ? route('admin.dashboard') : route('home'),
                'message' => 'Login correcto'
            ]);
        }

        // Para peticiones normales de formulario
        return redirect()->intended($user->is_admin == 1 ? '/admin/dashboard' : '/home');
    }
}