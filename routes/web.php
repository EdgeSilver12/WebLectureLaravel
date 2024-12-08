<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\TownController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

Route::get('/', function () {
    return view('welcome');
});


//Models Controllers
route::get('/home',[AdminController::class,'index'])->name('home');


Route::resource('counties', CountyController::class);

Route::resource('populations', PopulationController::class);

Route::resource('towns', TownController::class);

// Display the form to retrieve data
Route::get('/retrieve-data', [DataController::class, 'showForm'])->name('retrieve-data.form');

// Handle the form submission and display the result
Route::post('/retrieve-data', [DataController::class, 'handleForm'])->name('retrieve-data.handle');
