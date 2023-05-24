<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RregisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Language;
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


Route::post('home', [HomeController::class, 'change_lang']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('register')->group(function () {
    Route::get('index', [RregisterController::class, 'index']);
    Route::post('register', [RregisterController::class, 'register']);
});


Route::prefix('login')->group(function () {
    Route::get('index', [LoginController::class, 'index']);
    Route::post('login', [LoginController::class, 'login']);
});






Route::prefix('admin')->group(function () {

    Route::prefix('discounts')->group(function () {
        Route::get('index', [DiscountController::class, 'index']);
        Route::get('create', [DiscountController::class, 'create']);
        Route::post('store', [DiscountController::class, 'store']);
        Route::get('edit/{discount}', [DiscountController::class, 'edit']);
        Route::put('update/{discount}', [DiscountController::class, 'update']);
        Route::delete('delete/{discount}', [DiscountController::class, 'destroy']);
    });


    Route::prefix('products')->group(function () {
        Route::get('index', [ProductController::class, 'index']);
        Route::get('create', [ProductController::class, 'create']);
        Route::post('store', [ProductController::class, 'store']);
        Route::get('edit/{product}', [ProductController::class, 'edit']);
        Route::put('update/{product}', [ProductController::class, 'update']);
        Route::delete('delete/{product}', [ProductController::class, 'destroy']);
    });


    Route::prefix('posts')->group(function () {
        Route::get('index', [PostController::class, 'index']);
        Route::get('create', [PostController::class, 'create']);
        Route::post('store', [PostController::class, 'store']);
        Route::get('edit/{post}', [PostController::class, 'edit']);
        Route::put('update/{post}', [PostController::class, 'update']);
        Route::delete('delete/{post}', [PostController::class, 'destroy']);
    });


    Route::prefix('agencies')->group(function () {
        Route::get('index', [AgencyController::class, 'index']);
        Route::get('show/{agency}', [AgencyController::class, 'show']);
        Route::post('store', [AgencyController::class, 'store']);
        Route::get('edit/{agency}', [AgencyController::class, 'edit']);
        Route::put('update/{agency}', [AgencyController::class, 'update']);
        Route::delete('delete/{agency}', [AgencyController::class, 'destroy']);
    });


    Route::prefix('users')->group(function () {
        Route::get('index', [UserController::class, 'index']);
        Route::get('create', [UserController::class, 'create']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('edit/{user}', [UserController::class, 'edit']);
        Route::put('update/{user}', [UserController::class, 'update']);
        Route::delete('delete/{user}', [UserController::class, 'destroy']);
    });


    Route::prefix('categories')->group(function () {
        Route::get('index', [CategoryController::class, 'index']);
        Route::get('create', [CategoryController::class, 'create']);
        Route::post('store', [CategoryController::class, 'store']);
        Route::get('edit/{category}', [CategoryController::class, 'edit']);
        Route::put('update/{category}', [CategoryController::class, 'update']);
        Route::delete('delete/{category}', [CategoryController::class, 'destroy']);
    });


    Route::prefix('role')->group(function () {
        Route::get('index', [RoleController::class, 'index']);
        Route::get('create', [RoleController::class, 'create']);
        Route::post('store', [RoleController::class, 'store']);
        Route::get('edit/{role}', [RoleController::class, 'edit']);
        Route::put('update/{role}', [RoleController::class, 'update']);
        Route::put('update-primission/{role}', [RoleController::class, 'updatePremission'])->name('role.premission.update');
        Route::delete('delete/{role}', [RoleController::class, 'destroy']);
    });


    Route::prefix('premissions')->group(function () {
        Route::get('index', [PremissionController::class, 'index']);
        Route::get('create', [PremissionController::class, 'create']);
        Route::post('store', [PremissionController::class, 'store']);
        Route::get('edit/{premission}', [PremissionController::class, 'edit']);
        Route::put('update/{premission}', [PremissionController::class, 'update']);
        Route::post('delete/{premission}', [PremissionController::class, 'destroy']);
    });
});
