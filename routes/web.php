<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OfficeController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\BuildingController;
use App\Http\Controllers\CronjobController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleSocialiteController;
use App\Http\Controllers\MttController;


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
Route::get('/clear-config', function () {
    Artisan::call('config:cache');
    echo '<h1>config cache Success</h1>';
});

Route::get('/clear-route', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear Success")</script>';
});
Route::get('mail_test', function () {
    \Mail::raw('Mail Successfully Sent', function($msg) {$msg->to('arora.monika1783@gmail.com')->subject('Test Email'); });
          dd('mail send');
});



Route::get('/mtt', 'App\Http\Controllers\MttController@index');
