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

Route::post('/activities/savesort', [\App\Http\Controllers\api\v1\Activities::class, 'savesort']);
Route::resource('activities', \App\Http\Controllers\api\v1\Activities::class);

Route::get('/trainings/{y}/{m}/{d}', [\App\Http\Controllers\api\v1\TrainingController::class, 'index']);
Route::post('/trainings/addset', [\App\Http\Controllers\api\v1\TrainingController::class, 'addset']);
Route::resource('trainings', \App\Http\Controllers\api\v1\TrainingController::class);

Route::resource('trainings/activities', \App\Http\Controllers\api\v1\trainings\ActivitiesController::class);

Route::get('/days/{y?}/{m?}', [\App\Http\Controllers\api\v1\Days::class, 'index']);
