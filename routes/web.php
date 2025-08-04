<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\AdminLandlordController;
use App\Http\Controllers\admin\AdminTenantsController;
use App\Http\Controllers\admin\AdminPropertiesController;
use App\Http\Controllers\admin\AdminReportsController;
use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\admin\AdminComplaintsController;
use App\Http\Controllers\admin\AdminPaymentsController;
use App\Http\Controllers\Auth\RegisterController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/contact', 'contact')->name('home.contact');
});

Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/','index')->name('admin.index');
    Route::get('/complaints','complaint')->name('admin.complaints');
});

Route::controller(AdminUsersController::class)->prefix('admin/users')->group(function () {
    Route::get('/', 'index')->name('admin.users.index');
});

Route::controller(AdminLandlordController::class)->prefix('admin/landlords')->group(function () {
    Route::get('/', 'index')->name('admin.landlords.index');
});

Route::controller(AdminTenantsController::class)->prefix('admin/tenants')->group(function () {
    Route::get('/', 'index')->name('admin.tenants.index');
});

Route::controller(AdminReportsController::class)->prefix('admin/reports')->group(function () {
    Route::get('/', 'index')->name('admin.reports.index');
});

Route::controller(AdminSettingsController::class)->prefix('admin/settings')->group(function () {
    Route::get('/', 'index')->name('admin.settings.index');
});

Route::controller(AdminPropertiesController::class)->prefix('admin/properties')->group(function () {
    Route::get('/', 'index')->name('admin.properties.index');
});

Route::controller(AdminPaymentsController::class)->prefix('admin/payments')->group(function () {
    Route::get('/', 'index')->name('admin.payments.index');
});


Route::controller(RegisterController::class)->prefix('auth/register')->group(function () {
    Route::get('/', 'showRegistrationForm')->name('register.show');
    Route::post('/', 'register')->name('register.submit');
});