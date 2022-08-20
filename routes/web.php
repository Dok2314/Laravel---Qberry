<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;

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
    return view('welcome');
});

Auth::routes();

Route::get('home', [C\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth','as' => 'calculate.'], function(){
    Route::group(['prefix' => '{location:slug}'], function(){
        Route::get('calculate', [C\LocationController::class, 'calculateView'])
            ->name('view');
        Route::get('calculate-preview', [C\LocationController::class, 'calculatePreview'])
            ->name('calculate-preview');

        Route::post('order', [C\LocationController::class, 'orderCreate'])
            ->name('makeOrder');
    });

    Route::get('orders', [C\LocationController::class, 'orders'])
        ->name('orders');
});
