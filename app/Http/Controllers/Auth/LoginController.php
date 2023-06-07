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


    public function index()
    {
        # code...
    }

    public function login(Request $request)
    {

        $login = $this->validate($request , [
            'phone' => 'required|string|max:11|min:11|exists:users,phone',
            'password' => 'required|min:8|string',
        ]);


        if (!auth()->attempt($login)) {
            return response([
                'data'=> [
                'Message' => "invalid data",
                'status' => 'error',
                ]
            ], 403);
        }

        return new LoginResource(auth()->user());
    }
}
