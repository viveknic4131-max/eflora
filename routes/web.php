<?php

use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('theme.home');
// });

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/about', function () {
    return view('theme.about');
})->name('about');


 Route::get('news-list', [NewsController::class, 'newsList'])->name('news.list');

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search-suggest', [HomeController::class, 'suggest'])->name('search.suggest');

Route::get('/flora', [HomeController::class, 'getFamilyOrVolume'])->name('get.family');

// Route::get('/get-family', [HomeController::class, 'getFamily'])->name('get.family');
Route::get('/get-genus', [HomeController::class, 'getGenus'])->name('get.genus');
Route::get('/get-species', [HomeController::class, 'getSpecies'])->name('get.species');

Route::get('/checklist-volume', [HomeController::class, 'getPlantChecklistVolume'])->name('checklist.volume');
Route::get('/flora-of-india-volume', [HomeController::class, 'getFloraOfIndiaVolumes'])->name('flora.india.volume');

// Route::get('/plant-checklist-volumes', [HomeController::class, 'getPlantChecklistVolumes'])->name('plant.checklist.volumes');
// Route::get('/flora-of-india-volumes', [HomeController::class, 'getFloraVolumes'])->name('flora.checklist.volumes');

include 'admin.php';
