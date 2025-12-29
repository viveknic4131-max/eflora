<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\TaxonController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\admin\GenusController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\admin\SpeciesController;
use App\Http\Controllers\Admin\VolumeController;
use App\Models\Family;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Volume;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    // Roles & Permissions
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);

    Route::resource('family', FamilyController::class);
    Route::resource('volume', VolumeController::class);

    Route::resource('news', NewsController::class);


    Route::get('assign-volume-family', [VolumeController::class, 'assignVolumeFamily'])->name('assign-volume-family');
    Route::get('create-volume-family', [VolumeController::class, 'createVolumeFamily'])->name('create-volume-family');
    Route::post('store-volume-family', [VolumeController::class, 'storeVolumeFamily'])->name('store-volume-family');

    Route::get('/ajax/families', [FamilyController::class, 'searchFamilies'])->name('ajax.families');
    Route::get('/ajax/volumes', [VolumeController::class, 'searchVolumes'])->name('ajax.volumes');

    Route::get('/state-list', [SpeciesController::class, 'getStateList'])->name('state.list');



    Route::resource('genera', GenusController::class);
    Route::resource('species', SpeciesController::class);
    Route::get('/ajax/genus-by-family', [GenusController::class, 'ajaxByFamily'])
        ->name('ajax.genus.by.family');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/species/synonyms', [SpeciesController::class, 'synonyms'])->name('species.synonyms.store');

    Route::get('/home', function () {
        return view('admin.dashboard');
    })->name('home');

    Route::get('/dashboard', function () {

        // dd("lkhj");

        $volumes = Volume::count();
        // dd($volumes);
        $families = Family::count();
        $genera = Genus::count();
        $species = Species::count();
        return view('dashboard.index', compact('volumes', 'families', 'genera', 'species'));
    })->name('dashboard');

    Route::get('/user-profile', function () {
        return view('pages.laravel-examples.user-profile');
    })->name('user-profile');

    Route::get('/user-management', function () {
        return view('pages.laravel-examples.user-management');
    })->name('user-management');




    Route::resource('taxon', TaxonController::class);

    Route::get('/static-sign-up', function () {
        return view('pages.static-sign-up');
    })->name('static-sign-up');

    Route::get('/static-sign-in', function () {
        return view('pages.static-sign-in');
    })->name('static-sign-in');

    Route::get('/rtl', function () {
        return view('pages.rtl');
    })->name('rtl');

    Route::get('/virtual-reality', function () {
        return view('pages.virtual-reality');
    })->name('virtual-reality');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');

    Route::get('/notifications', function () {
        return view('pages.notifications');
    })->name('notifications');

    Route::get('/billing', function () {
        return view('pages.billing');
    })->name('billing');

    Route::get('/tables', function () {
        return view('pages.tables');
    })->name('tables');

    Route::get('/icons', function () {
        return view('dashboard.index');
    })->name('icons');

    Route::get('/maps', function () {
        return view('dashboard.index');
    })->name('maps');
});
