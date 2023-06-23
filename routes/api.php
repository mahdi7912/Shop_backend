<?php

use App\Http\Controllers\Admin\PremissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RregisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





/*
authentication routes
*/
Route::prefix('register')->group(function () {
    Route::get('/', [RregisterController::class, 'index']);
    Route::post('register', [RregisterController::class, 'register']);
});

    Route::post('login', [LoginController::class, 'login']);

    Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

    Route::middleware('auth:sanctum')->get('admin/user', [UserController::class , 'show']);




/*
home outes
*/

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/posts', [HomeController::class, 'index']);
Route::get('/posts/show/{post}', [PostController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('change-lang', [HomeController::class, 'change_lang']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('products/show/{product}', [ProductController::class, 'show']);
Route::get('/agencies', [AgencyController::class, 'index']);
Route::get('agencies/show/{agency}', [AgencyController::class, 'show']);

Route::get('/search-post' , [HomeController::class , 'searchPosts']);

Route::get('/search-product' , [HomeController::class , 'searchProducts']);


/*
admin routes
*/
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->middleware('role:boss');
        Route::get('create', [ProductController::class, 'create'])->middleware('role:boss');
        Route::post('store', [ProductController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->middleware('role:boss');
        Route::get('show/{product}', [ProductController::class, 'show'])->middleware('role:boss');
        Route::post('update/{product}', [ProductController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{product}', [ProductController::class, 'destroy'])->middleware('role:boss');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->middleware('role:boss');
        Route::post('store', [SliderController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{slider}', [SliderController::class, 'edit'])->middleware('role:boss');
        Route::get('show/{slider}', [SliderController::class, 'show'])->middleware('role:boss');
        Route::post('update/{slider}', [SliderController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{slider}', [SliderController::class, 'destroy'])->middleware('role:boss');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->middleware('role:boss');
        Route::post('store', [PostController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{post}', [PostController::class, 'edit'])->middleware('role:boss');
        Route::get('show/{post}', [PostController::class, 'show'])->middleware('role:boss');
        Route::post('update/{post}', [PostController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{post}', [PostController::class, 'destroy'])->middleware('role:boss');
        Route::post('post-tags/{post}', [PostController::class, 'storeTags'])->middleware('role:boss');
    });


    Route::prefix('agencies')->group(function () {
        Route::get('/', [AgencyController::class, 'index'])->middleware('role:boss');
        Route::post('store', [AgencyController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{agency}', [AgencyController::class, 'edit'])->middleware('role:boss');
        Route::post('update/{agency}', [AgencyController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{agency}', [AgencyController::class, 'destroy'])->middleware('role:boss');
    });


    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('role:boss');
        Route::post('store', [UserController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{user}', [UserController::class, 'edit'])->middleware('role:boss');
        Route::put('update/{user}', [UserController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{user}', [UserController::class, 'destroy'])->middleware('role:boss');
    });


    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->middleware('role:boss');
        Route::post('store', [CategoryController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->middleware('role:boss');
        Route::get('show/{category}', [CategoryController::class, 'show'])->middleware('role:boss');
        Route::put('update/{category}', [CategoryController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->middleware('role:boss');
    });


    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('role:boss');
        Route::get('create', [RoleController::class, 'create'])->middleware('role:boss');
        Route::post('store', [RoleController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{role}', [RoleController::class, 'edit'])->middleware('role:boss');
        Route::put('update/{role}', [RoleController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{role}', [RoleController::class, 'destroy'])->middleware('role:boss');
    });


    Route::prefix('premissions')->group(function () {
        Route::get('/', [PremissionController::class, 'index'])->middleware('role:boss');
        Route::get('create', [PremissionController::class, 'create'])->middleware('role:boss');
        Route::post('store', [PremissionController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{premission}', [PremissionController::class, 'edit'])->middleware('role:boss');
        Route::put('update/{premission}', [PremissionController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{premission}', [PremissionController::class, 'destroy'])->middleware('role:boss');
    });


    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->middleware('role:boss');
        Route::get('create', [TagController::class, 'create'])->middleware('role:boss');
        Route::post('store', [TagController::class, 'store'])->middleware('role:boss');
        Route::get('edit/{premission}', [TagController::class, 'edit'])->middleware('role:boss');
        Route::put('update/{premission}', [TagController::class, 'update'])->middleware('role:boss');
        Route::delete('delete/{premission}', [TagController::class, 'destroy'])->middleware('role:boss');

    });

});
