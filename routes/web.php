<?php

use App\Livewire\Auth\AdminLogin;
use App\Livewire\Category\CategoryList;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Destination\DestinationList;
use App\Livewire\Hotel\Category\HotelCategoryList;
use App\Livewire\Hotel\Hotel\HotelList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
   Route::get('/',Dashboard::class)->name('dashboard');
   Route::get('/category',CategoryList::class)->name('category.list');
   Route::get('/destination',DestinationList::class)->name('destination.list');
   Route::get('/hotel-category',HotelCategoryList::class)->name('hotel-category.list');
   Route::get('/hotel',HotelList::class)->name('hotel.list');
    Route::get('/hotel/create',\App\Livewire\Hotel\Hotel\AddHotel::class)->name('hotel.create');
    Route::get('/hotel/{id}/edit',\App\Livewire\Hotel\Hotel\UpdateHotel::class)->name('hotel.edit');
});

Route::get('/login',AdminLogin::class)->name('login');

Route::get('logout',function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');