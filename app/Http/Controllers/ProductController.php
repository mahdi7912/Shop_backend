<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\Image\ImageService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product  = Product::all();
        return new ProductResource($product);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ImageService $imageService)
    {
        $product = new Product;

        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');

            $result = $imageService->save($request->file('image'));
            if ($result === false) {

                return response()->json([
                    'message' => 'error loading image',
                ],403);
            }
            $input['image'] = $result;
        }

        $product->create([
            'name' => $input['name'],
            'price' => $input['price'],
            'description' => $input['description'],
            'remaining' => $input['remaining'],
            'image' => $input['image'],
            'category_id' => $input['category_id']
        ]);
        return response()->json([
            'message' => 'success',
            'product' => Product::latest()->first()
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'message' => 'success',
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->json([
            'message' => 'success',
            'product' => $product
        ]);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->create($request->all());
        return response()->json([
            'message' => 'success',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'deleted successfully',

        ]);
    }
}
