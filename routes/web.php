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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/my-wishlist', App\Http\Controllers\MyWishListController::class);
    Route::resource('/group', App\Http\Controllers\GroupController::class);
    Route::get('/group-wishlist/{group}', [App\Http\Controllers\GroupController::class, 'groupWishlist'])->name('group.wishlist');

    Route::post('/mark-brought', [App\Http\Controllers\MyWishListController::class, 'markBrought']);
});
