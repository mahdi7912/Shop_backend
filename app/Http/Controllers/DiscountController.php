<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discount = Discount::all();
        return new DiscountResource($discount);
    }


    public function store(StoreDiscountRequest $request)
    {
        $discount = new Discount;

        $discount->create($request->all());
        return response()->json([
            'message' => "با موفقیت ثبت شد",
        ] ,200 );
    }

    public function edit(Discount $discount)
    {
        return response()->json([
            'message' => 'success',
            'category' => $discount
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->create($request->all());
        return response()->json([
            'message' => 'success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return response()->json([
         'message' => 'deleted successfully',

     ]);
    }
}
