<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{



    public function login(Request $request)
    {

        $login = $this->validate($request, [
            'phone' => 'required|string|max:11|min:11|exists:users,phone',
            'password' => 'required|min:8|string',
        ]);


        if (auth()->attempt($login)) {

            $user = Auth::user();
            $token = $user->createToken('Login')->plainTextToken;

            return response([
                'data' => [
                    'message' => "success data",
                    'user' => auth()->user(),
                    'token' => $token
                ]
            ], 200);
        } else {
            return response()->json([
                'message' => 'invalid data',
                'status' => 'error'

            ], 403);
        }        // return new LoginResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful.']);
    }
}
