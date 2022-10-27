<?php


use Illuminate\Support\Facades\Route;

use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BooksController;



Route::controller(\App\Http\Controllers\CommentsController::class)
    ->middleware(['auth', 'role:userRole'])
    ->group(function () {
    Route::get('/comments', 'index')->name("comment.index");
    Route::post('/comments', 'store')->name("comment.store");
    Route::get('/comments/{id}', 'show')->name("comment.show");
});


Route::controller(\App\Http\Controllers\LikesController::class)
    ->middleware(['auth', 'role:userRole'])
    ->group(function () {
        Route::post('/likes', 'like')->name("like.likeBook");
        Route::post('/dislikes', 'dislike')->name("like.dislikeBook");
    });

Route::controller(\App\Http\Controllers\FavouriatesController::class)
    ->middleware(['auth', 'role:userRole'])
    ->group(function () {
    Route::get('/favourites',  'index')->name('favourites.index');
    Route::post('/addToFavourite', 'addToFavourite')->name("favorite.add");
    Route::post('/removeFromFavorite', 'removeFromFavorite')->name("favorite.remove");
});


Route::prefix('/')
    ->middleware(['auth', 'role:userRole'])
    ->group(function () {
    Route::get('books',  [BooksController::class, 'index'])->name("book.index");
//    Route::get('books/create', [BooksController::class, 'create'])->name("book.create");
//    Route::post('books', [BooksController::class, 'store'])->name("book.store");
   Route::get('books/{book}', [BooksController::class, 'show'])->name("book.show");
//    Route::delete('book/{book}', [BooksController::class, 'destroy'])->name('book.delete');
//    Route::get('book/{book}', [BooksController::class, 'edit'])->name('book.edit');
//    Route::patch('book/{book}', [BooksController::class, 'update'])->name('book.update');
});

?>