<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\AdminPropertiesController;
use App\Http\Controllers\admin\AdminReportsController;
use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\admin\AdminComplaintsController;
use App\Http\Controllers\admin\AdminPaymentsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisterLandlordsController;
use App\Http\Controllers\Auth\RegisterTenantsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\LandlordDashboardController;
use App\Http\Controllers\Dashboard\Landlord\ComplaintController;
use App\Http\Controllers\Dashboard\Landlord\PaymentController;
use App\Http\Controllers\Dashboard\Landlord\PropertiesController;
use App\Http\Controllers\Dashboard\Landlord\SettingsController;
use App\Http\Controllers\Dashboard\Landlord\TenantController;
use App\Http\Controllers\Dashboard\TenantDashboardController;
use App\Http\Controllers\Dashboard\Tenant\TenantComplaintsController;
use App\Http\Controllers\Dashboard\Tenant\TenantPropertiesController;
use App\Http\Controllers\Dashboard\Tenant\TenantSettingsController;
use App\Http\Controllers\Dashboard\Tenant\TenantMaintenanceController;
use App\Http\Controllers\Dashboard\Tenant\TenantPaymentController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/contact', 'contact')->name('home.contact');
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/','index')->name('index');
    });

    Route::controller(AdminUsersController::class)->prefix('/users')->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/{type}/{id}','show')->name('users.show');
    });

    Route::controller(AdminReportsController::class)->prefix('/reports')->group(function () {
        Route::get('/', 'index')->name('reports.index');
    });

    Route::controller(AdminSettingsController::class)->prefix('/settings')->group(function () {
        Route::get('/', 'index')->name('settings.index');
    });
    Route::controller(AdminPropertiesController::class)->prefix('/properties')->group(function () {
        Route::get('/', 'index')->name('properties.index');
    });
    
    Route::controller(AdminComplaintsController::class)->prefix('/complaints')->group(function () {
        Route::get('/', 'index')->name('complaints.index');
    });
    Route::controller(AdminPaymentsController::class)->prefix('/payments')->group(function () {
        Route::get('/', 'index')->name('payments.index');
    });

});


Route::controller(RegisterController::class)->prefix('auth/register')->group(function () {
    Route::get('/', 'showRegistrationForm')->name('register.show');
    Route::post('/', 'register')->name('register.submit');
});

Route::controller(RegisterLandlordsController::class)->prefix('auth/register/landlords')->group(function () {
    Route::get('/', 'RegisterLandlordForm')->name('register.landlords.show');
    Route::post('/', 'register')->name('register.landlords.submit');
});

Route::controller(RegisterTenantsController::class)->prefix('auth/register/tenants')->group(function () {
    Route::get('/', 'RegisterTenantsForm')->name('register.tenants.show');
    Route::post('/', 'register')->name('register.tenants.submit');
});

Route::controller(LoginController::class)->prefix('auth/login')->group(function () {
    Route::get('/', 'showLoginForm')->name('auth.login');
    Route::post('/', 'login')->name('login.submit');
});

Route::prefix('dashboard/landlord')->name('dashboard.landlord.')->group(function(){
    Route::controller(LandlordDashboardController::class)->group(function(){
        Route::get('/','index')->name('index');
    });
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::controller(PropertiesController::class)->prefix('/properties')->group(function(){
        Route::get('/','index')->name('properties.index');
    });
    Route::controller(SettingsController::class)->prefix('/settings')->group(function(){
        Route::get('/','index')->name('settings.index');
    });
    Route::controller(TenantController::class)->prefix('/tenants')->group(function(){
        Route::get('/','index')->name('tenants.index');
    });
    Route::controller(ComplaintController::class)->prefix('/complaint')->group(function(){
        Route::get('/','index')->name('complaints.index');
    });
});

Route::prefix('dashboard/tenant')->name('dashboard.tenant.')->group(function(){
    Route::controller(TenantDashboardController::class)->group(function(){
        Route::get('/','index')->name('index');
    });
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::controller(TenantPropertiesController::class)->prefix('/properties')->group(function(){
        Route::get('/','index')->name('properties.index');
    });
    Route::controller(TenantSettingsController::class)->prefix('/settings')->group(function(){
        Route::get('/','index')->name('settings.index');
    });
    Route::controller(TenantComplaintsController::class)->prefix('/complaints')->group(function(){
        Route::get('/','index')->name('complaints.index');
    });
    Route::controller(TenantMaintenanceController::class)->prefix('/maintenance')->group(function(){
        Route::get('/','index')->name('maintenance.index');
    });
    Route::controller(TenantPaymentController::class)->prefix('/payments')->group(function(){
        Route::get('/','index')->name('payments.index');
    });
});