<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Premission;
use App\Http\Requests\StorePremissionRequest;
use App\Http\Requests\UpdatePremissionRequest;

class PremissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $premission  = Premission::all();
        return response()->json([
            'message' => 'success',
            'premission' => $premission
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePremissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePremissionRequest $request)
    {
        $premission = new Premission;

        $premission->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json([
            'message' => 'success',
        ], 200);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function edit(Premission $premission)
    {
        return response()->json([
            'message' => 'success',
            'premission' => $premission
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePremissionRequest  $request
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePremissionRequest $request, Premission $premission)
    {
        $premission->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json([
            'message' => 'success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premission $premission)
    {
        $premission->delete();
        return response()->json([
            'message' => 'deleted successfully',

        ], 200);
    }
}
