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
        Route::resource('/tickets', 'ManagerTicketController');
        Route::get('/tickets/{slug}/solve', 'ManagerTicketController@solveTicket')->name('ticket.solve');
        Route::get('/tickets/index/{sortby}', 'ManagerTicketController@sortTicket')->name('ticket.sort');
        Route::post('/tickets/{slug}/comment', 'ManagerTicketController@postComment')->name('ticket.post.comment');

    });
    Route::middleware('user')->prefix('user')->name('user.')->group(function(){
        Route::resource('/tickets', 'TicketsController');
        Route::post('/tickets/{slug}/comment', 'TicketsController@postComment')->name('ticket.post.comment');
        Route::get('/tickets/{slug}/close', 'TicketsController@closeTicket')->name('ticket.close');
    });
    Route::get('/', 'HomeController@index')->name('home');

});
