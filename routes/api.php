<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('categories', CategoryController::class); 
Route::apiResource('books', BookController::class );


Route::get('categories/filter/{category_id}', [CategoryController::class, 'filterByCategory']);


//authentication Routes:
// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');

//     Route::post('logout', 'logout')->middleware('auth:sanctum');
// });


Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);