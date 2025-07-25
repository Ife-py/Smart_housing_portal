<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('index');
});

Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/','index')->name('admin.index');
    Route::get('/users', 'users')->name('admin.users');
    Route::get('/landlords', 'landlords')->name('admin.landlords');
    Route::get('/tenants', 'tenants')->name('admin.tenants');
});