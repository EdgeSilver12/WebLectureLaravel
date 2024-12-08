<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\TownController;

Route::get('/', function () {
    return view('welcome');
});


//Models Controllers
route::get('/home',[AdminController::class,'index'])->name('home');


Route::resource('counties', CountyController::class);

Route::resource('populations', PopulationController::class);

Route::resource('towns', TownController::class);

