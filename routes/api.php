<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/access/token', 'PaymentController@generateAccessToken');
Route::post('v1/hlab/stk/push', 'PaymentController@customerMpesaSTKPush')->name('stk-push');
Route::post('v1/hlab/validation', 'PaymentController@mpesaValidation')->name('payment_validation'); // SafCallback
Route::post('v1/hlab/transaction/confirmation', 'PaymentController@mpesaConfirmation');
Route::post('v1/hlab/register/url', 'PaymentController@mpesaRegisterUrls');