<?php

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view_order/{id}', 'HomeController@viewOrder')->name('home.view_order');

Route::group(['middleware' => 'auth'], function () {

	Route::post('/order', 'OrderController@newOrder')->name('order.newOrder');
	Route::get('/order_details', 'OrderController@orderDetails')->name('order.orderDetails');
	Route::post('/upload', 'OrderController@upload')->name('upload');
	Route::get('/shoppingcart', 'OrderController@getCart')->name('shoppingCart');
	Route::post('/addToCart/{id}', 'OrderController@getAddToCart')->name('order.getAddToCart');
	Route::post('/updateItem/{id}', 'OrderController@getUpdateItem')->name('order.getUpdateItem');
	Route::get('/reducebyone/{id}', 'OrderController@getReduceByOne')->name('reduceByOne');
	Route::get('/remove/{id}', 'OrderController@getRemoveItem')->name('removeItem');
	Route::get('/clear', 'OrderController@clearCart')->name('clearCart');
	
	Route::get('/checkout', 'OrderController@getCheckout')->name('order.getCheckout');

	Route::get('contact', 'OrderController@create')->name('order.create');
	Route::post('contact', 'OrderController@store')->name('order.store');

	Route::get('/pick/{id}', 'WriterController@pick')->name('writer.pick');
	Route::get('/deffer/{id}', 'WriterController@deffer')->name('writer.deffer');
	Route::get('/complete/{id}', 'WriterController@complete')->name('writer.complete');
	Route::post('/complete/{id}', 'WriterController@completeJob')->name('writer.completeJob');
	Route::get('/payments', 'WriterController@payments')->name('writer.payments');
	Route::get('/view_job/{id}', 'WriterController@viewJob')->name('writer.view_job');
	
});


Route::get('clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('view:clear');

   return "Cleared!";

});
