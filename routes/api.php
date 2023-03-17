<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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




//api routes:

Route::apiResource('categories', CategoryController::class); 
Route::apiResource('books', BookController::class );
Route::get('categories/filter/{category_id}', [CategoryController::class, 'filterByCategory']);


//authentication Routes:

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::put('user/updatePassword',[UserController::class,'updatePassword']);
    Route::put('user/updateName',[UserController::class,'updateName']);
    Route::put('user/updateEmail',[UserController::class,'updateEmail']);
});

