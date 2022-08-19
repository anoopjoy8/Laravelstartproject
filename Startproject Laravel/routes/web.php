<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Middleware\CustomAuth;

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
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {

    Route::get('admin/',[AdminuserController::class, 'index']);
    Route::match(['get','post'],'login',[AdminuserController::class,'index']);
    //Menu 
    Route::get('dashboard',[MenuController::class,'home']);
    Route::match(['get','post'],'list-menu',[MenuController::class,'index']);
    Route::match(['get','post'],'add-menu',[MenuController::class,'Add']);
    Route::match(['get','post'],'update-menu',[MenuController::class,'Update']);
    Route::match(['get','post'],'delete-menu',[MenuController::class,'Delete']);

    //Admin Users
    Route::match(['get','post'],'list-admin',[AdminuserController::class,'users']);
    Route::get('logout',[AdminuserController::class,'Logout']);
    Route::match(['get','post'],'add-admin',[AdminuserController::class,'Add']);
    Route::match(['get','post'],'update-admin',[AdminuserController::class,'Update']);
    Route::get('delete-admin',[AdminuserController::class,'Delete']);

    //Pages
    Route::match(['get','post'],'list-page',[PageController::class,'index']);
    Route::match(['get','post'],'add-page',[PageController::class,'Add']);
    Route::match(['get','post'],'update-page',[PageController::class,'Update']);
    Route::get('delete-page',[PageController::class,'Delete']);

    //General Settings
    Route::match(['get','post'],'change-password',[MenuController::class,'changePassword']);

    //Ajax
    Route::get('delete-image',[AjaxController::class,'DeleteImage']);

});
