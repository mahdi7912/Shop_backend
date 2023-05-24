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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePremissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePremissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function show(Premission $premission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function edit(Premission $premission)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premission  $premission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premission $premission)
    {
        //
    }
}
