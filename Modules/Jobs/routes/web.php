<?php

use Illuminate\Support\Facades\Route;
use Modules\Jobs\App\Http\Controllers\JobsController;
use Modules\Jobs\App\Http\Controllers\TypesController;
use Modules\Jobs\App\Http\Controllers\DetailController;
use Modules\Jobs\App\Http\Controllers\ReportController;

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

Route::group(['middleware'=>'AuthAdmin'], function () {
    Route::resource('jobs', JobsController::class)->names('jobs');
    Route::resource('jobs-detail', DetailController::class)->names('jobs-detail');
    Route::resource('types', TypesController::class)->names('types');
    Route::resource('report-jobs', ReportController::class)->names('reportJobs');

});
