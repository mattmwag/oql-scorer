<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FixtureController;

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

Route::get('/', [TeamController::class, 'index']);

Route::get('teams/rankings', 'App\Http\Controllers\TeamController@rankings')
    ->name('rankings');

Route::resource('teams', TeamController::class);

Route::resource('players', PlayerController::class);

Route::resource('fixtures', FixtureController::class);

