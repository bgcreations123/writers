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

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Http\Request;

use App\{OrderDetail, CompletedJob};

Route::get('/', 'WelcomeController@welcome')->name('welcome');

// determine product price through ajax
Route::get('/getProduct/{cid}/{pid}', 'WelcomeController@getProduct')->name('welcome.getProduct');

// Admin routes for voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('completed-jobs/review/{id}', '\App\Http\Controllers\Voyager\CompletedJobController@review')->name('review-completed-jobs');

    Route::get('reviews/approve/{id}', '\App\Http\Controllers\Voyager\ReviewController@approve')->name('approve');

    Route::get('reviews/reject/{id}', '\App\Http\Controllers\Voyager\ReviewController@reject')->name('reject');

    Route::get('payables/pay/{id}', '\App\Http\Controllers\Voyager\PayableController@getPay')->name('pay');
});

Auth::routes();

// Public home routes
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/view_order/{id}', 'HomeController@viewOrder')->name('home.view_order');

// Dynamic Public Page route
Route::get('/home/{slug}', 'PageController@index')->name('home.page');

// Dynamic Public Post route
Route::get('/post', 'PostController@index')->name('home.post');

Route::get('/post/{slug}', 'PostController@index')->name('home.post');



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
	Route::get('stats', 'OrderController@getStats')->name('order.stats');
	Route::get('jobDetails/{id}', 'OrderController@getJobDetails')->name('order.jobDetails');

	Route::get('/jobs', 'WriterController@jobs')->name('writer.jobs');
	Route::get('/my_jobs', 'WriterController@my_jobs')->name('writer.my_jobs');
	Route::get('/deffered_jobs', 'WriterController@deffered_jobs')->name('writer.deffered_jobs');
	Route::get('/completed_jobs', 'WriterController@completed_jobs')->name('writer.completed_jobs');
	Route::get('/pick/{id}', 'WriterController@pick')->name('writer.pick');
	Route::get('/deffer/{id}', 'WriterController@deffer')->name('writer.deffer');
	Route::get('/complete/{id}', 'WriterController@complete')->name('writer.complete');
	Route::post('/complete/{id}', 'WriterController@completeJob')->name('writer.completeJob');
	Route::get('/my_account', 'WriterController@my_account')->name('writer.my_account');
	Route::get('/payments', 'WriterController@payments')->name('writer.payments');
	Route::get('/unpaid', 'WriterController@unpaid')->name('writer.unpaid');
	Route::get('/view_job/{id}', 'WriterController@viewJob')->name('writer.view_job');
	
	Route::post('/paypal', 'PaymentController@paypal')->name('paypal');
	Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');

	Route::get('/inbox', 'MessagesController@inbox')->name('messages.inbox');
	Route::get('/sent', 'MessagesController@sent')->name('messages.sent');
	Route::get('/messages/{id}', 'MessagesController@show')->name('messages.show');
	Route::post('/messages', 'MessagesController@store')->name('messages.store');
});


// Download File From Route
Route::get('download/{type}/{filename}', function($type, $filename)
{
    if($type == 'ref'):
    	// Look for the file owner
	    $owner = OrderDetail::with('order')->where('files', $filename)->first();
	    // dd($owner->order->user_id);

	    // Check if file exists in app/storage/file folder
	    $file_path = storage_path() .'/app/files/'.(int)$owner->order->user_id.'/'. $filename;
	    // dd($file_path);

    elseif($type == 'job'):
    	// Look for the file owner
	    $owner = CompletedJob::with('orderDetail')->where('files', $filename)->first();
	    // dd($owner->orderDetail->order->user_id);

	    // Check if file exists in app/storage/file folder
	    $file_path = storage_path() .'/app/files/'.(int)$owner->orderDetail->order->user_id.'/'. $filename;
	    // dd($file_path);

    endif;
    
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
