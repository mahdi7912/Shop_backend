<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdatePremissionRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Premission;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use function PHPSTORM_META\type;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $role = Role::all();

        return new RoleResource($role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $premission = Premission::all();

        return response()->json([
            'message' => 'success',
            'premission' => $premission
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        // dd($request);

        $input = $request -> all();
        $role = Role::create($input);
        $input['premissions'] = $input['premissions'] ?? [];
        $role->premissions()->sync($input['premissions']);

        return response()->json([
            'message' => 'added successfuly',
        ],200);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // $roles = Role::findorfail($role->id);

        return response()->json([

            'message' => 'success',
            'role' => $role,
            'premissions' => $role->premissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        // $role['premissions'] = $role['premissions'] ?? [];
        // $role['premissions']->update($request['premissions']);



        // $role->update([
        //     'name' => $request->name,
        //     'description' => $request->description
        // ]);
        $role->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json([

            'message' => 'updated successfuly',
            'role' => $role,
        ]);
    }


    public function updatePremission(UpdatePremissionRequest $request , Role $role)
    {
        // $role['premissions'] = $role['premissions'] ?? [];
        dd($request->premissions);
        $role['premissions']->update($request['premissions']);
        return response()->json([

            'message' => 'updated successfuly',
            'role' => $role,
            'premission' => $role->premissions
        ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $role->delete();
        return response()->json([

            'message' => 'deleted successfuly',
        ],200);
    }
}
