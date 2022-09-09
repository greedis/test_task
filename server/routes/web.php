<?php

use App\Controllers\PostController;
use App\Controllers\MainController;
use App\Controllers\CommentController;
use DolgoyAudiopunk\Framework\Route;

Route::add('/', [MainController::class, 'index']);

Route::add('/list', [PostController::class, 'posts']);
Route::add('/posts', [PostController::class, 'viewPosts']);
Route::add('/user/articles', [PostController::class, 'posts']);
Route::add('/post/create', [PostController::class, 'create']);
Route::add('/comment/create', [CommentController::class, 'create']);
Route::add('/comment/show', [CommentController::class, 'extracted']);

