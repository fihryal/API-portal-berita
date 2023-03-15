<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

route::middleware(['auth:sanctum'])->group(function(){
    route::get('/posts', [PostController::class ,'index']);
    route::get('/posts/{id}', [PostController::class ,'show']);
    route::post('/posts',[PostController::class , 'store']);
    route::get('/logout',[AuthenticationController::class, 'logout']);
    route::get('/me',[AuthenticationController::class, 'me']);
});

route::get('/posts2/{id}', [PostController::class ,'show2']);
route::post('/login',[AuthenticationController::class, 'login']);