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
Auth::routes([
    'reset' => false,
]);

Route::middleware('auth')->group(function(){

    Route::middleware('manager')->namespace('Manager')->prefix('manager')->name('manager.')->group(function(){
        Route::resource('/tickets', 'ManagerTicketController')->only([
            'index', 'show'
        ]);
    });
    Route::prefix('user')->name('user.')->group(function(){
        Route::resource('/tickets', 'TicketsController')->only([
            'index', 'show','create', 'store', 'destroy', 'update'
        ]);
    });
    Route::get('/', 'HomeController@index')->name('home');

});
