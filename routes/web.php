<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('theme.home');
// });

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/about', function () {
    return view('theme.about');
})->name('about');




Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search-suggest', [HomeController::class, 'suggest'])->name('search.suggest');

Route::get('/get-family', [HomeController::class, 'getFamily'])->name('get.family');
Route::get('/get-genus', [HomeController::class, 'getGenus'])->name('get.genus');
Route::get('/get-species', [HomeController::class, 'getSpecies'])->name('get.species');

include 'admin.php';
