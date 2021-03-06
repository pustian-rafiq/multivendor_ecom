<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    
    //Get child catgeory by using child category id
    Route::post('/category/{id}/child',[CategoryController::class, 'getChildByParentID']);

    //Brand routes
    Route::resource('/brand', 'BrandController');
    Route::post('/brand/status',[BrandController::class,'ChangeStatus'])->name('brand.status');

    //Product routes
    Route::resource('/product', 'ProductController');
    Route::post('/product/status',[ProductController::class,'ChangeStatus'])->name('product.status');

    //User routes
    Route::resource('/user', 'UserController');
    Route::post('/user/status',[UserController::class,'ChangeStatus'])->name('user.status');
});