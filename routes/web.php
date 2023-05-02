<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;


//route to show the home page (all posts)
Route::get('/', [PostController::class, 'index']);
// route to show the post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

//route to save  the comment form
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

//route to show the register page(form)
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
//route for send data to database by using post method
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


// route to show the login page(form)
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
//route to send data of  user to database to check if user exist or not
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

//route to go SessionController::class and destroy function to destroy the session (logout)
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');


// Admin Routes

Route::middleware('can:admin')->group(function () {

    // route resources to admin
    Route::resource('admin/posts', AdminPostController::class)->except(['show']);
    // OR

    // route to show all posts
    // Route::get('admin/posts', [AdminPostController::class, 'index']);
    //route to get admin form create post
    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    //route to send data of new post to database
    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    //route to get admin form edit post
    //Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    //route to send data of edit post to database
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // route to delete post
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
