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

// Public home routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/view_order/{id}', 'HomeController@viewOrder')->name('home.view_order');

// Public service route
Route::get('/ourServices', function(){
	return view('home.ourServices');
});

// determine product through ajax
Route::get('/getProduct/{cid}/{pid}', 'HomeController@getProduct')->name('home.getProduct');

// Private pages
Route::group(['middleware' => 'auth'], function () {

	Route::get('/profile/{id}', 'HomeController@profile')->name('user.profile');

	Route::post('/order', 'OrderController@newOrder')->name('order.newOrder');
	Route::get('/order_details', 'OrderController@orderDetails')->name('order.orderDetails');
	Route::post('/upload', 'OrderController@upload')->name('upload');
	Route::get('/shoppingcart', 'OrderController@getCart')->name('shoppingCart');
	Route::get('/paymentMethod', 'OrderController@paymentMethod')->name('order.paymentMethod');
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
	
	Route::post('/paypal', 'PaymentController@paypal')->name('paypal');
	Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');

});


// Download File From Route
Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    $file_path = storage_path() .'/app/files/5/'. $filename;
    // dd($file_path);
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.\ ]+')
->name('download');
