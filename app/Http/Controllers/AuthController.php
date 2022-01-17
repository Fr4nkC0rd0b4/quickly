<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authenticate user by API.
     * @param  \Illuminate\Http\Request  $request
     * @return JSON $response
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Credenciales no encontradas en nuestros registros.'
            ], 401);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        $user->role->id;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response);
    }

    /**
     * Destroy session and token
     * 
     * @return JSON $response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'Logged out'
        ];

        return response()->json($response);
    }
}
