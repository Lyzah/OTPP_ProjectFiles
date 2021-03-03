<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
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

/* My original index that installed with Laravel/Breeze
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', function () {
    return view('main');
});



/*
Route::get('/pay-failed?reason=userCancelled', function () {
    return view('paymentCancelled');
});
*/

Route::post('/api/paypal-capture-payment', [\App\Http\Controllers\paypalController::class, 'capturePayment']);



/*
Route::view('/pay-failed{reason?}', 'payFailed');
*/
Route::get('/pay-failed{reason?}', [\App\Http\Controllers\paypalController::class, 'fail']);

Route::view('/pay-success', 'paymentSucess');