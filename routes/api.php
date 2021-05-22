<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('wishlist')->group(function () {
    Route::get('/check','WishlistController@check');
    Route::post('/add','WishlistController@add');
    Route::post('/bulk-check','WishlistController@bulkCheck');

    Route::post('/remove','WishlistController@remove');
    Route::get('/get-products/{customer_id}','WishlistController@getAllProduct');

});

Route::prefix('review')->group(function () {
    Route::get('/get-review','ReviewController@getReview');
});
