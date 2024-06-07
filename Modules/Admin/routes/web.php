<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\AdminController;

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

Route::get('/login', 'AdminController@login')->name('login');
Route::group(['middleware' => 'AuthAdmin'], function() {
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/logout', 'AdminController@logout')->name('logout');
    Route::get('/info', 'AdminController@show')->name('info');
    
    // Route::resource('/register','UsersController@create');
});