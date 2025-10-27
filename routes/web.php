<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('theme.home');
// });

Route::get('/', [HomeController::class ,'index'])->name('/');

Route::get('/about', function () {
    return view('theme.about');
})->name('about');




Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search-suggest', [HomeController::class, 'suggest'])->name('search.suggest');




include 'admin.php';
