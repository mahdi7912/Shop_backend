<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RregisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
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


Route::post('home', [HomeController::class , 'change_lang']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('users', [UserController::class , 'index']);

Route::prefix('register')->group(function() {
Route::get('index', [RregisterController::class , 'index']);
Route::post('register', [RregisterController::class , 'register']);
});


Route::prefix('login')->group(function() {
Route::get('index', [LoginController::class , 'index']);
Route::post('login', [LoginController::class , 'login']);
});


Route::prefix('agencies')->group(function() {
Route::post('store', [AgencyController::class , 'store']);
});


Route::prefix('role')->group(function() {
Route::get('index', [RoleController::class , 'index']);
Route::get('create', [RoleController::class , 'create']);
Route::post('store', [RoleController::class , 'store']);
Route::get('edit/{role}', [RoleController::class , 'edit']);
Route::put('update/{role}', [RoleController::class , 'update']);
Route::put('update-primission/{role}', [RoleController::class , 'updatePremission'])->name('role.premission.update');
Route::delete('delete/{role}', [RoleController::class , 'destroy']);
});

Route::prefix('premissions')->group(function() {
    Route::get('index', [RoleController::class , 'index']);
    Route::get('create', [RoleController::class , 'create']);
    Route::post('store', [RoleController::class , 'store']);
    Route::get('edit/{role}', [RoleController::class , 'edit']);
    Route::put('update/{role}', [RoleController::class , 'update'])->name('role.update');
    Route::post('delete/{role}', [RoleController::class , 'destroy']);
    });


