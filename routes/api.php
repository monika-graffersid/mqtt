<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/clear-config', function () {
    Artisan::call('config:cache');
    echo '<h1>config cache Success</h1>';
});

Route::get('/clear-route', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear Success")</script>';
});

