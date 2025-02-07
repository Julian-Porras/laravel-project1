<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


Route::get('/', function () {
    $posts = [];
    if (auth()->guard()->check()){
        $posts = auth()->guard()->user()->usersPost()->latest()->get();
        // $userDetails = auth()->guard()->user()->get();
    }
    // $posts = Post::where('user_id', auth()->guard()->id())->get();
    return view('index', ['posts' => $posts]);
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [RegisterController::class, 'logout']);
Route::post('/login', [RegisterController::class, 'login']);

Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}',[PostController::class, 'editScreen']);
Route::put('/edit-post/{post}',[PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}',[PostController::class, 'deletePost']);