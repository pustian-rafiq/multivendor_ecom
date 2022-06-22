<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
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

Route::get('/home', 'HomeController@index')->name('home');

//Admin dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

    Route::get('/',[AdminController::class,'Dashboard'])->name('admin');

    //Banner routes
    Route::resource('/banner', 'BannerController');
    Route::post('/banner/status',[BannerController::class,'ChangeStatus'])->name('banner.status');

    //Category routes
    Route::resource('/category', 'CategoryController');
    Route::post('/category/status',[CategoryController::class,'ChangeStatus'])->name('category.status');

    //Brand routes
    Route::resource('/brand', 'BrandController');
    Route::post('/brand/status',[BrandController::class,'ChangeStatus'])->name('brand.status');
});