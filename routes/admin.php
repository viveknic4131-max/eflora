<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\TaxonController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;





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

    Route::resource('family', App\Http\Controllers\admin\FamilyController::class);
    Route::resource('volume', App\Http\Controllers\admin\VolumeController::class);


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', function () {
        return view('admin.dashboard');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard.index');
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
