<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\TutorialController;
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

Route::prefix('admin')->group(function () {
    // Login Routes...
    Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login',[LoginController::class,'login']);
    
    Route::middleware('auth')->group(function(){
        Route::post('logout', [LoginController::class,'logout'])->name('logout');
    });


    Route::middleware('auth')->name('admin.')->group(function(){    
        Route::get('/', DashboardController::class)->name('index');
        Route::resource('topics',TopicController::class);
        Route::post('topics/{topic}/up',[TopicController::class,'up'])->name('topics.up');
        Route::post('topics/{topic}/down',[TopicController::class,'down'])->name('topics.down');
    });

});    



Route::get('/', HomeController::class);
Route::get('/{topic:name}/{tutorialName?}', [TutorialController::class,'show'])->name('home.tutorial');