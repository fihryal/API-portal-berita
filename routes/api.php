<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

route::get('/posts', [PostController::class ,'index'])->middleware(['auth:sanctum']);
route::get('/posts/{id}', [PostController::class ,'show'])->middleware(['auth:sanctum']);
route::get('/posts2/{id}', [PostController::class ,'show2']);

route::post('/login',[AuthenticationController::class, 'login']);