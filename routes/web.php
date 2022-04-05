<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/register/verify/{token}', [\App\Http\Controllers\SpaController::class, 'index'])->name('register.verify');

Route::get('/{any}', [\App\Http\Controllers\SpaController::class, 'index'])->where('any', '.*');
