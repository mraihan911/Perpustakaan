<?php

use Illuminate\Support\Facades\Route;
use Modules\Library\Controllers\AuthorController;
use Modules\Library\Controllers\BookController;

Route::name('library.')->group(function () {
    Route::resource('authors', AuthorController::class)->except('show');
    Route::resource('books', BookController::class)->except('show');
    Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
});