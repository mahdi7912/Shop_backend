<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserApi;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $user = User::query()->limit(1)->first();W
        // return response()->json($user);
        $user = User::all();

        return new UserApi($user);
        // $user = User::factory(100)->create();
        // return $user;
    }



    public function store(StoreUserRequest $request)
    {
        $user = new User;

        $input = $request->all();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();

        $input['roles'] = $input['roles'] ?? [];
        $user->roles()->sync($input['roles']);

        return response()->json([
            'message' => "با موفقیت ثبت شد",
            'user' => User::latest()->first()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        return response()->json([
            'message' => "success",
            'user' => $request->user(),
            'roles' => $request->user()->roles,
            'premissions' => $request->user()->premissions
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        return response()->json([
            'message' => "success",
            'user' => $user,
            'roles' => $user->roles,
            'premissions' => $user->premissions
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $input = $request->all();

        $user = User::findorfail($id);

        if (!empty($request->password)) {

            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);

            //cheking if roles and premissions exist
            $input['roles'] = $input['roles'] ?? [];
            $input['premissions'] = $input['premissions'] ?? [];


            //syncing roles and premissions
            $user->roles()->sync($input['roles']);
            $user->premissions()->sync($input['premissions']);

            return response()->json([
                'message' => "با موفقیت ثبت شد",
                'product' => $user
            ], 200);

        } else {

            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email
            ]);

            $input['roles'] = $input['roles'] ?? [];
            $input['premissions'] = $input['premissions'] ?? [];

            $user->roles()->sync($input['roles']);
            $user->premissions()->sync($input['premissions']);

            return response()->json([
                'message' => "با موفقیت ثبت شد",
                'product' => $user
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findorfail($id);
        $user->delete();
        return response()->json([
            'message' => "با موفقیت حذف شد"
        ], 200);
    }
}
