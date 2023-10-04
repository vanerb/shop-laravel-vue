<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa, el usuario ha iniciado sesión
            $user = Auth::user();

            return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'user_id'=>$user->id]);
        } else {
            // Autenticación fallida, las credenciales no son válidas
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }
}
