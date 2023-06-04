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
use App\Http\Controllers\TagController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/*
authentication routes
*/
// Route::prefix('register')->group(function () {
//     Route::get('/', [RregisterController::class, 'index']);
//     Route::post('register', [RregisterController::class, 'register']);
// });
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('login', [LoginController::class, 'login']);
});




/*
home outes
*/
Route::get('/posts', [HomeController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('change-lang', [HomeController::class, 'change_lang']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('products/show/{product}', [ProductController::class, 'show']);
Route::get('/discounts', [DiscountController::class, 'index']);
Route::get('/agencies', [AgencyController::class, 'index']);
Route::get('agencies/show/{agency}', [AgencyController::class, 'show']);


/*
admin routes
*/
Route::prefix('admin')->group(function () {

    Route::prefix('discounts')->group(function () {
        Route::get('/', [DiscountController::class, 'index']);
        Route::get('create', [DiscountController::class, 'create']);
        Route::post('store', [DiscountController::class, 'store']);
        Route::get('edit/{discount}', [DiscountController::class, 'edit']);
        Route::put('update/{discount}', [DiscountController::class, 'update']);
        Route::delete('delete/{discount}', [DiscountController::class, 'destroy']);
    });


    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('create', [ProductController::class, 'create']);
        Route::post('store', [ProductController::class, 'store']);
        Route::get('edit/{product}', [ProductController::class, 'edit']);
        Route::get('show/{product}', [ProductController::class, 'show']);
        Route::put('update/{product}', [ProductController::class, 'update']);
        Route::delete('delete/{product}', [ProductController::class, 'destroy']);
    });


    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('store', [PostController::class, 'store']);
        Route::get('edit/{post}', [PostController::class, 'edit']);
        Route::get('show/{post}', [PostController::class, 'show']);
        Route::put('update/{post}', [PostController::class, 'update']);
        Route::delete('delete/{post}', [PostController::class, 'destroy']);
        Route::post('post-tags/{post}', [PostController::class, 'storeTags']);
    });


    Route::prefix('agencies')->group(function () {
        Route::get('/', [AgencyController::class, 'index']);
        Route::post('store', [AgencyController::class, 'store']);
        Route::get('edit/{agency}', [AgencyController::class, 'edit']);
        Route::put('update/{agency}', [AgencyController::class, 'update']);
        Route::delete('delete/{agency}', [AgencyController::class, 'destroy']);
    });


    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('edit/{user}', [UserController::class, 'edit']);
        Route::put('update/{user}', [UserController::class, 'update']);
        Route::delete('delete/{user}', [UserController::class, 'destroy']);
    });


    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('store', [CategoryController::class, 'store']);
        Route::get('edit/{category}', [CategoryController::class, 'edit']);
        Route::get('show/{category}', [CategoryController::class, 'show']);
        Route::put('update/{category}', [CategoryController::class, 'update']);
        Route::delete('delete/{category}', [CategoryController::class, 'destroy']);
    });


    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('create', [RoleController::class, 'create']);
        Route::post('store', [RoleController::class, 'store']);
        Route::get('edit/{role}', [RoleController::class, 'edit']);
        Route::put('update/{role}', [RoleController::class, 'update']);
        Route::delete('delete/{role}', [RoleController::class, 'destroy']);
    });


    Route::prefix('premissions')->group(function () {
        Route::get('/', [PremissionController::class, 'index']);
        Route::get('create', [PremissionController::class, 'create']);
        Route::post('store', [PremissionController::class, 'store']);
        Route::get('edit/{premission}', [PremissionController::class, 'edit']);
        Route::put('update/{premission}', [PremissionController::class, 'update']);
        Route::post('delete/{premission}', [PremissionController::class, 'destroy']);
    });


    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index']);
        Route::get('create', [TagController::class, 'create']);
        Route::post('store', [TagController::class, 'store']);
        Route::get('edit/{premission}', [TagController::class, 'edit']);
        Route::put('update/{premission}', [TagController::class, 'update']);
        Route::delete('delete/{premission}', [TagController::class, 'destroy']);
    });
});



















/*
other site routes

categories index = /categories
posts index = /posts
discounts index = /discounts
products index = /products


admin panel routes
/admin(
    /user(
   index =  /
    create(openning the create form page) = /create
    store(creating new user) = /store
    edit(openning the update form page) = /edit/{}
    update (updating user) = /update/{}
    delete = /delete/{}
    )
    /discounts(
    index =  /
    create(openning the create form page) = /create
    store(creating new discount) = /store
    edit(openning the update form page) = /edit/{}
    update (updating discount) = /update/{}
    delete = /delete/{}
    )
    /products(
    index =  /
    create(openning the create form page) = /create
    store(creating new product) = /store
    edit(openning the update form page) = /edit/{}
    update (updating product) = /update/{}
    delete = /delete/{}
    )
    /categories(
    index =  /
    create(openning the create form page) = /create
    store(creating new product) = /store
    edit(openning the update form page) = /edit/{}
    update (updating product) = /update/{}
    delete = /delete/{}
    )
    /agencies(
    index =  /
    create(openning the create form page) = /create
    store(creating new agency) = /store
    edit(openning the update form page) = /edit/{}
    update (updating agency) = /update/{}
    delete = /delete/{}
    )
    /posts(
    index =  /
    create(openning the create form page) = /create
    store(creating new post) = /store
    edit(openning the update form page) = /edit/{}
    update (updating post) = /update/{}
    delete = /delete/{}
    )
    /roles(
    index =  /
    create(openning the create form page) = /create
    store(creating new role) = /store
    edit(openning the update form page) = /edit/{}
    update (updating role) = /update/{}
    update-premission (updating roles premissions) = /update-premissions/
    delete = /delete/{}
    )
    /premissions(
    index =  /
    create(openning the create form page) = /create
    store(creating new premissions) = /store
    edit(openning the update form page) = /edit/{}
    update (updating premissions) = /update/{}
    delete = /delete/{}
    )

)



*/
