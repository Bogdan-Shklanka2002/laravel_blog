<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\PostController::class, 'index']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('post/index-by-author', [PostController::class, 'indexByAuthor'])->name('post.index.by.author');
Route::get('post/unpublished-posts', [PostController::class, 'indexByUnpublished'])->name('post.index.by.unpublished');
Route::get('post/index-by-admin', [PostController::class, 'indexByAdmin'])->name('post.index.by.admin');
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);

