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
    return redirect('http://mangitmaharjan.com.np/');
});
// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth.shopify'])->name('home');


// Route::middleware(['auth.shopify'])->group(function () {
//     Route::get('/products', 'ProductController@index' )->name('product');
// });

Route::get('/p', 'ExtraController@index' );
Route::post('/pd', 'ExtraController@submit' )->name('form-submit');
Route::get('/review','ReviewController@review');
