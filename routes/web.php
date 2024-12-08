<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});



route::get('/home',[AdminController::class,'index'])->name('home');

use App\Http\Controllers\ContentController;

Route::middleware(['auth'])->group(function () {
    // Display all contents
    Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
    // Show form to create new content
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    // Store new content
    Route::post('/contents', [ContentController::class, 'store'])->name('contents.store');
    // Show form to edit content
    Route::get('/contents/{id}/edit', [ContentController::class, 'edit'])->name('contents.edit');
    // Update existing content
    Route::put('/contents/{id}', [ContentController::class, 'update'])->name('contents.update');
    // Delete content
    Route::delete('/contents/{id}', [ContentController::class, 'destroy'])->name('contents.destroy');
});

// Allow guests to view all contents
Route::get('/contents/public', [ContentController::class, 'publicIndex'])->name('contents.public');
