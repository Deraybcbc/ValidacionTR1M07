<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorizacionController extends Controller
{
    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        if (Auth::attempt($data)) {
            //$request->session()->regenerate();
            $user = Auth::user();

            $token = $user->createToken('auth-token')->plainTextToken;


            return response()->json(['status' => 'success', 'token' => $token, 'usuario' => $user]);
        }

        return response()->json(['status' => 'success', 'message' => 'Usuario no encontrado']);
    }

    public function logout(Request $request)
    {

    }
}
