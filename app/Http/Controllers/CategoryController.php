<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $categories = Category::all();
        return new CategoryResource($categories);


            return response()->json([
                'message' => "error",
            ], 403);


    }



    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->save();
        return response()->json([
            'message' => "با موفقیت ثبت شد",
            'category' => Category::latest()->first()
        ], 200);
    }


    public function edit(Category $category)
    {

        return response()->json([
            'message' => 'success',
            'category' => $category
        ]);
    }
    public function show(Category $category)
    {
        return response()->json([
            'message' => 'success',
            'category' => $category
        ]);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->save();
        return response()->json([
            'message' => "با موفقیت بروزرسانی شد",
            "category" => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'با موفقیت حذف شد',

        ], 200);
    }
}
