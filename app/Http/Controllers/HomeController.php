<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([

            'message' => 'success',
            'posts' => $posts

        ], 200);
    }

    public function searchProducts(Request $request)
    {

        $product = Product::where('name', 'LIKE', '%' . $request->search . '%')->get();


            return response()->json([

                'message' => 'success',
                'product' => $product

            ], 200);

    }

    public function searchPosts(Request $request)
    {
        $posts = Post::where('name', 'LIKE', '%' . $request->search . '%')->get();

        return response()->json([

            'message' => 'success',
            'product' => $posts

        ], 200);
    }

    public function change_lang(Request $request)
    {


        session()->put('lang', $request->lang);
        $lang = session()->get('lang');

        App::setLocale($lang);

        return response()->json([
            'message' => 'success',
            'lang' => session()->get('lang'),
            'language' => App::getLocale()
        ]);
    }
}
