<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\app\Http\Controllers\BlogController;
use Modules\Blog\app\Http\Controllers\CategoryBlogController;
use Modules\Blog\app\Http\Controllers\TagController;

Route::prefix('admin')->middleware('auth')->group(function () {
    // Blogs routes
    Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/edit/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/update/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::get('/delete/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });



    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryBlogController::class, 'index'])->name('blogs.categories');
        Route::post('/store', [CategoryBlogController::class, 'store'])->name('blogs.categories.store');
        Route::put('/update/{categoryBlog}', [CategoryBlogController::class, 'update'])->name('blogs.categories.update');
        Route::get('/delete/{categoryBlog}', [CategoryBlogController::class, 'destroy'])->name('blogs.categories.destroy');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('blogs.tags');
        Route::post('/store', [TagController::class, 'store'])->name('blogs.tags.store');
        Route::put('/update/{tagBlog}', [TagController::class, 'update'])->name('blogs.tags.update');
        Route::get('/delete/{tagBlog}', [TagController::class, 'destroy'])->name('blogs.tags.destroy');
    });
});
