<?php

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/city/{name}/{country}', [App\Http\Controllers\WeatherController::class, 'index']);
Route::get('/city/{name}', [App\Http\Controllers\WeatherController::class, 'index1']);
Route::get('/allcities', [App\Http\Controllers\CityController::class, 'dispCities']);
Route::get('/deletecity/{name}/{country}', [App\Http\Controllers\CityController::class, 'delete']);
Route::get('/list', [App\Http\Controllers\CityController::class, 'list']);
Route::get('/add/{name}/{country}', [App\Http\Controllers\CityController::class, 'add']);