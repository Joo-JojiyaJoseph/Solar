<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/about', [HomeController::class, 'about'])->name('about');
// Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
// Route::post('/contact', [HomeController::class, 'contactPost'])->name('contact');

Route::get('/link', function() {
    $fromFolder = storage_path("app/public");
    $toFolder = $_SERVER['DOCUMENT_ROOT'].'../storage';
    if(!File::exists($toFolder)) {
        symlink($fromFolder, $toFolder);
        return redirect(route('index'));
    }
    return ('Storage folder already exist in public_html, delete Storage folder and refresh');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
       Artisan::call('key:generate');
       echo  $exitCode;
    // return what you want
});

Route::get('/admin', [Admin\AdminController::class, 'index'])->name('admin.login');
Route::post('/admin', [Admin\AdminController::class, 'login'])->name('admin.login');
Route::get('/admin-logout', [Admin\AdminController::class, 'logout'])->name('admin.logout');
Route::get('subservices/{serviceId}', [Admin\SubServiceController::class, 'getSubServices']);

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
    Route::resource('profile', Admin\ProfileController::class, ['names' => 'profile']);
    Route::get('home/{type?}', [Admin\AdminHomeController::class, 'index'])->name('dashboard');
    Route::resource('branch', Admin\BranchController::class, ['names' => 'branch']);
    Route::resource('technician', Admin\TechnicianController::class, ['names' => 'technician']);
    Route::resource('marketting', Admin\MarkettingController::class, ['names' => 'marketting']);
    Route::resource('leads', Admin\LeadsController::class, ['names' => 'lead']);
    Route::resource('callleads', Admin\CallLeadsController::class, ['names' => 'calllead']);
    Route::resource('services', Admin\ServiceController::class, ['names' => 'services']);
    Route::resource('subservices', Admin\SubServiceController::class, ['names' => 'subservices']);






    ///////////////////////////////////////////////////////////////////////////////

    // Route::get('orders', [Admin\AdminHomeController::class, 'orders'])->name('orders');
    Route::resource('seo', Admin\SeoController::class, ['names' => 'seo']);
    // Route::resource('testimonial', Admin\TestimonialController::class, ['names' => 'testimonial']);
    // Route::resource('slider', Admin\SliderController::class, ['names' => 'slider']);
    Route::resource('logo', Admin\LogoController::class, ['names' => 'logo']);
    Route::get('/admin-home', [Admin\AdminHomeController::class, 'home'])->name('home.index');

    ////////////////////////////////////////////////////////////////////////////////////////
  });


require __DIR__.'/auth.php';
