<?php

use App\Http\Controllers\Admin\BooksController as AdminBooks;
use Illuminate\Support\Facades\Route;




Route::get('/admin/dashboard', function () {
    return view('admin.adminDashboard');
})->middleware(['auth', 'role:adminRole'])->name('admin.dashboard');



Route::controller(\App\Http\Controllers\Admin\CommentsController::class)
    ->middleware(['auth', 'role:adminRole'])
    ->prefix("/admin")->group(function () {
    Route::get('/comments', 'index')->name("admin.comment.index");
    Route::post('/comments', 'store')->name("admin.comment.store");
    Route::get('/comments/{id}', 'show')->name("admin.comment.show");
});



Route::controller(\App\Http\Controllers\Admin\LikesController::class)
    ->middleware(['auth', 'role:adminRole'])
    ->prefix("/admin")->group(function () {
    Route::post('/likes', 'like')->name("admin.like.likeBook");
    Route::post('/dislikes', 'dislike')->name("admin.like.dislikeBook");
});

Route::controller(\App\Http\Controllers\Admin\UsersController::class)
    ->middleware(['auth', 'role:adminRole'])
    ->prefix("/admin")->group(function () {
    Route::get('/users', 'index')->name("admin.user.index");
    Route::get('/users/{user}', 'show')->name("admin.user.show");
    Route::get('/users/{user}/edit', 'edit')->name("admin.user.edit");
    Route::patch('/users/{user}', 'update')->name("admin.user.update");
    Route::delete('/users/{user}', 'destroy')->name("admin.user.delete");
});



Route::prefix('/admin')
    ->middleware(['auth', 'role:adminRole'])
    ->group(function () {
    Route::get('/books',  [AdminBooks::class, 'index'])->name("admin.book.index");
    Route::get('/books/create', [AdminBooks::class, 'create'])->name("admin.book.create");
    Route::post('/books', [AdminBooks::class, 'store'])->name("admin.book.store");
    Route::get('/books/{book}', [AdminBooks::class, 'show'])->name("admin.book.show");
    Route::delete('/book/{book}', [AdminBooks::class, 'destroy'])->name('admin.book.delete');
    Route::get('/book/{book}', [AdminBooks::class, 'edit'])->name('admin.book.edit');
    Route::patch('/book/{book}', [AdminBooks::class, 'update'])->name('admin.book.update');
});


?>