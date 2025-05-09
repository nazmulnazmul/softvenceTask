<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\CourseController;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [CourseController::class, 'index']);
Route::post('/store', [CourseController::class, 'store'])->name('store');


// ->name('store')