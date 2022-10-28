<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountriesController;
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

// public routes
Route::post('/register', [AuthController::class, 'register' ]);
Route::get('/users', [AuthController::class, 'index']);


// protected routes
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::controller(\App\Http\Controllers\Api\BooksController::class)
    ->middleware(['auth:sanctum'])
    ->group(function () {
    Route::get('/books',  'index')->name('books.index');
    Route::get('/books/popular',  'getPopularBooks')->name('books.popular');
});
