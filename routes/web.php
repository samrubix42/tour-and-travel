<?php

use App\Livewire\Category\CategoryList;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
   Route::get('/',Dashboard::class)->name('dashboard');
   Route::get('/category',CategoryList::class)->name('category.list');
});
