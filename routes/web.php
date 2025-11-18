<?php

use App\Livewire\Admin\Blog\Category\BlogCategoryList;
use App\Livewire\Admin\Category\CategoryList;
use App\Livewire\Admin\Destination\DestinationList;
use App\Livewire\Admin\Hotel\Category\HotelCategoryList;
use App\Livewire\Admin\Hotel\Hotel\HotelList;
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\Experience\ExperinceList;
use App\Livewire\Admin\Hotel\Hotel\AddHotel;
use App\Livewire\Admin\Hotel\Hotel\UpdateHotel;
use App\Livewire\Public\About;
use App\Livewire\Public\Blog\Blog;
use App\Livewire\Public\Blog\BlogView;
use App\Livewire\Public\Contact;
use App\Livewire\Public\Destination\Destination;
use App\Livewire\Public\Home\Home;
use App\Livewire\Public\Tour\TourView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/tour', TourView::class)->name('tour');
Route::get('/tour-view', TourView::class)->name('tour.view');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog-view', BlogView::class)->name('blog.view');
Route::get('destination', Destination::class)->name('destination');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    //tour and travel routes
    Route::prefix('tour')->name('tour.')->group(function () {
        Route::get('/category', CategoryList::class)->name('category.list');
        Route::get('/destination', DestinationList::class)->name('destination.list');
        Route::get('/experience', ExperinceList::class)->name('experience.list');
    });
    //blog routes
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/category', BlogCategoryList::class)->name('category.list');
    });
    //hotel routes
    Route::prefix('hotel')->name('hotel.')->group(function () {
        Route::get('/category', HotelCategoryList::class)->name('category.list');
        Route::get('/', HotelList::class)->name('list');
        Route::get('/create', AddHotel::class)->name('create');
        Route::get('/{id}/edit', UpdateHotel::class)->name('edit');
    });
});

Route::get('/login', AdminLogin::class)->name('login');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
