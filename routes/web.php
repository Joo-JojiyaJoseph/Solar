<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


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
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactPost'])->name('contact');

Route::get('/admin', [Admin\AdminController::class, 'index'])->name('admin.login');
Route::post('/admin', [Admin\AdminController::class, 'login'])->name('admin.login');
Route::get('/admin-logout', [Admin\AdminController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
    Route::resource('profile', Admin\ProfileController::class, ['names' => 'profile']);
    Route::get('home/{type?}', [Admin\AdminHomeController::class, 'index'])->name('dashboard');
    Route::get('orders', [Admin\AdminHomeController::class, 'orders'])->name('orders');
    Route::resource('seo', Admin\SeoController::class, ['names' => 'seo']);
    Route::resource('testimonial', Admin\TestimonialController::class, ['names' => 'testimonial']);
    Route::resource('slider', Admin\SliderController::class, ['names' => 'slider']);
    Route::resource('logo', Admin\LogoController::class, ['names' => 'logo']);
    Route::get('/admin-home', [Admin\AdminHomeController::class, 'home'])->name('home.index');
  });


require __DIR__.'/auth.php';
