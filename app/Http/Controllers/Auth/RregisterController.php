<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class RregisterController extends Controller
{

    public function index()
    {
        # code...
    }

    public function register(StoreUserRequest $request)
    {
        $user = new User;

        $user->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        return response()->json([
            'lang'  => App::getLocale(),
            'message' => "با موفقیت ثبت شد"
        ] ,200 );

    }
}
