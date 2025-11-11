<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\AdminPropertiesController;
use App\Http\Controllers\admin\AdminReportsController;
use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\admin\AdminComplaintsController;
use App\Http\Controllers\admin\AdminPaymentsController;
use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\AdminAuthController;
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
use App\Http\Controllers\Dashboard\Landlord\LandlordProfileController;
use App\Http\Controllers\Dashboard\Landlord\LandlordNotificationController;
use App\Http\Controllers\Dashboard\Landlord\ApplicationController;
use App\Http\Controllers\Dashboard\TenantDashboardController;
use App\Http\Controllers\Dashboard\Tenant\TenantComplaintsController;
use App\Http\Controllers\Dashboard\Tenant\MyPropertiesController;
use App\Http\Controllers\Dashboard\Tenant\TenantPropertiesController;
use App\Http\Controllers\Dashboard\Tenant\TenantSettingsController;
use App\Http\Controllers\Dashboard\Tenant\TenantPaymentController;
use App\Http\Controllers\Dashboard\Tenant\TenantProfileController;
use App\Http\Controllers\Dashboard\Tenant\TenantNotificationController;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/properties', 'properties')->name('home.properties');
    Route::get('/properties/{property}', 'show')->name('home.property.show');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/contact', 'contact')->name('home.contact');
});

Route::post('/properties/{property}/apply', [PropertyApplicationController::class, 'apply'])->name('property.apply')->middleware('auth:tenant');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.submit');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::middleware('admin.auth')->group(function () {
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
            Route::post('/{id}/resolve', 'resolve')->name('complaints.resolve');
        });
        Route::controller(AdminPaymentsController::class)->prefix('/payments')->group(function () {
            Route::get('/', 'index')->name('payments.index');
        });

        Route::controller(AnnouncementController::class)->prefix('/announcements')->group(function () {
            Route::get('/', 'index')->name('announcements.index');
            Route::get('/create', 'create')->name('announcements.create');
            Route::post('/store', 'store')->name('announcements.store');
            Route::get('/{id}/edit', 'edit')->name('announcements.edit');
            Route::put('/{id}/update', 'update')->name('announcements.update');
            Route::delete('/{id}/delete', 'destroy')->name('announcements.destroy');
        });
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

Route::middleware('auth:landlord')->prefix('dashboard/landlord')->name('dashboard.landlord.')->group(function(){
    Route::controller(LandlordDashboardController::class)->group(function(){
        Route::get('/','index')->name('index');
    });
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::controller(PropertiesController::class)->prefix('/properties')->group(function(){
        Route::get('/','index')->name('properties.index');
        Route::get('/create','create')->name('properties.create');
        Route::post('/store','store')->name('properties.store');
        Route::get('/search','search')->name('properties.search');
        Route::get('/{id}','show')->name('properties.show');
        Route::get('/{id}/edit','edit')->name('properties.edit');
        Route::put('/{id}/update','update')->name('properties.update');
        Route::delete('/{id}/delete','destroy')->name('properties.delete');
    });
    Route::controller(ApplicationController::class)->prefix('/application')->group(function(){
        Route::get('/','index')->name('application.index');
        Route::get('/{id}/show','show')->name('application.show');
        Route::post('/{id}/accept','accept')->name('application.accept');
        Route::post('/{id}/decline','decline')->name('application.decline');
        Route::post('/{id}/cancel','cancel')->name('application.cancel');
    });
    Route::controller(LandlordNotificationController::class)->prefix('/notifications')->group(function(){
        Route::get('/','index')->name('notifications.index');
        Route::get('/{id}','notificationShow')->name('notifications.show');
    });
     Route::controller(PaymentController::class)->prefix('/payment')->group(function(){
        Route::get('/','index')->name('payments.index');
    });
    Route::controller(SettingsController::class)->prefix('/settings')->group(function(){
        Route::get('/','index')->name('settings.index');
    });
    Route::controller(TenantController::class)->prefix('/tenants')->group(function(){
        Route::get('/','index')->name('tenants.index');
    });

    Route::controller(LandlordProfileController::class)->prefix('/profile')->group(function(){
        Route::get('/','index')->name('profile.index');
        Route::get('/edit','edit')->name('profile.edit');
        Route::put('/{id}/update','update')->name('profile.update');
    });
    Route::controller(ComplaintController::class)->prefix('/complaint')->group(function(){
        Route::get('/','index')->name('complaints.index');
        Route::get('/{id}/show','show')->name('complaints.show');
        Route::post('/{id}/resolve','resolve')->name('complaints.resolve');
        Route::post('/{id}/revert','revert')->name('complaints.revert');
    });
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth:tenant')->prefix('dashboard/tenant')->name('dashboard.tenant.')->group(function(){
    Route::controller(TenantDashboardController::class)->group(function(){
        Route::get('/','index')->name('index');
    });
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::controller(MyPropertiesController::class)->prefix('/my_properties')->group(function(){
        Route::get('/','index')->name('my_properties.index');
        Route::get('/{id}','show')->name('my_properties.show');
        Route::get('/create','create')->name('my_properties.create');
        Route::post('/store','store')->name('my_properties.store');
        Route::get('/{id}/edit','edit')->name('my_properties.edit');
        Route::put('/{id}/update','update')->name('my_properties.update');
        Route::delete('/{id}/delete','destroy')->name('my_properties.delete');
    });

    Route::controller(TenantPropertiesController::class)->prefix('properties')->group(function(){
        Route::get('/','index')->name('properties.index');
        Route::get('/{id}/show','show')->name('properties.show');
    });
    Route::controller(TenantSettingsController::class)->prefix('/settings')->group(function(){
        Route::get('/','index')->name('settings.index');
    });
    Route::controller(TenantComplaintsController::class)->prefix('/complaints')->group(function(){
        Route::get('/','index')->name('complaints.index');
        Route::get('/create','create')->name('complaints.create');
        Route::post('/store','store')->name('complaints.store');
        Route::get('/{id}/show','show')->name('complaints.show');
        Route::post('/{id}/acknowledge','acknowledge')->name('complaints.acknowledge');
        Route::post('/{id}/response/revert','revertResponse')->name('complaints.response.revert');
    });
    Route::controller(TenantPaymentController::class)->prefix('/payments')->group(function(){
        Route::get('/','index')->name('payments.index');
        Route::get('/{id}','show')->name('payments.show');
        Route::post('/{id}/pay','pay')->name('payments.pay');
    });
    Route::controller(TenantProfileController::class)->prefix('/profile')->group(function(){
        Route::get('/','index')->name('profile.index');
        Route::get('/edit','edit')->name('profile.edit');
        Route::put('/{id}/update','update')->name('profile.update');
    });
    // Tenant notifications
    Route::controller(TenantNotificationController::class)->prefix('/notifications')->group(function(){
        Route::get('/','index')->name('notifications.index');
        Route::get('/{id}','notificationShow')->name('notifications.show');
    });
    Route::post('/properties/{property}/apply', [PropertyApplicationController::class, 'apply'])
        ->name('property.apply');
});