<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('blog/posts', [\App\Http\Controllers\Blog\Api\PostControllerApi::class, 'index']);
Route::get('blog/posts/{id}', [\App\Http\Controllers\Blog\Api\PostControllerApi::class, 'show']);
