<?php

use App\Http\Controllers\AuthController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/verify', [AuthController::class, 'verify']);
});

//Route::group([
//    'middleware' => 'verified',
//], function ($router) {
    Route::get('/activities/all', [\App\Http\Controllers\api\v1\Activities::class, 'all']);
    Route::post('/activities/savesort', [\App\Http\Controllers\api\v1\Activities::class, 'savesort']);
    Route::resource('activities', \App\Http\Controllers\api\v1\Activities::class);

    Route::get('/trainings/{y}/{m}/{d}', [\App\Http\Controllers\api\v1\TrainingController::class, 'index']);

    Route::resource('trainings', \App\Http\Controllers\api\v1\TrainingController::class);
    Route::resource('trainings/sets', \App\Http\Controllers\api\v1\trainings\SetsController::class);
    Route::resource('trainings/activities', \App\Http\Controllers\api\v1\trainings\ActivitiesController::class);

    Route::get('/days/{y?}/{m?}', [\App\Http\Controllers\api\v1\Days::class, 'index']);


    Route::get('/profile', [\App\Http\Controllers\api\v1\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\api\v1\ProfileController::class, 'store']);
//});
