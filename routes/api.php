<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTokenContoller;
use App\Http\Controllers\carsContoller;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/api/tokens/create', [ApiTokenContoller::class, 'createToken']);

Route::apiResource('/cars', carsContoller::class)->middleware('auth:sanctum');
