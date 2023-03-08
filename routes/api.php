<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::get('/posts', [PostController::class ,'index']);
route::get('/posts/{id}', [PostController::class ,'show']);
route::get('/posts2/{id}', [PostController::class ,'show2']);