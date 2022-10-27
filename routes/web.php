<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BooksController as AdminBooks;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::controller(\App\Http\Controllers\Admin\CommentsController::class)->group(function () {
    Route::get('/admin/comments', 'index');
    Route::get('/admin/comments/{id}', 'show');
});


Route::prefix('/admin')->group(function () {
    Route::get('/books',  [AdminBooks::class, 'index'])->name("admin.book.index");
    Route::get('/books/create', [AdminBooks::class, 'create'])->name("admin.book.create");
    Route::post('/books', [AdminBooks::class, 'store'])->name("admin.book.store");
    Route::get('/books/{book}', [AdminBooks::class, 'show'])->name("admin.book.show");
    Route::delete('/book/{book}', [AdminBooks::class, 'destroy'])->name('admin.book.delete');
    Route::get('/book/{book}', [AdminBooks::class, 'edit'])->name('admin.book.edit');
    Route::patch('/book/{book}', [AdminBooks::class, 'update'])->name('admin.book.update');
});



require __DIR__.'/auth.php';
