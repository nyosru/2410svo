<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', \App\Livewire\Counter::class)->name('index');
Route::get('/', \App\Livewire\Svo\Page::class)->name('index');

//Route::get('/trebs', \App\Livewire\Svo\Trebs::class)->name('trebs');
Route::get('/trebs', \App\Livewire\Svo\TrebsDataTable::class)->name('trebs');
Route::get('/scan77', \App\Livewire\Svo\DataScan::class)->name('scan');


$d = function () {
    Route::get('/shop', \App\Livewire\Svo\Shop::class)->name('shop');
    Route::get('/shop/scan',[\App\Http\Controllers\Svo\ShopScanDatafileController::class,'scan'])->name('shop.scan');
    Route::get('/shop/cart', \App\Livewire\Svo\Cart::class)->name('cart');
    Route::get('/shop/cart/ok', \App\Livewire\Svo\CartOk::class)->name('cart.ok');
};

Route::get('/fin', \App\Livewire\Svo\FinDataTable::class)->name('fin');

Route::get('/i/{page?}', \App\Livewire\Svo\Page::class)->name('page');

Route::group([
    'as' => 'svo.',
//    'domain' => (env('APP_ENV', 'local') == 'local') ? 'php-cat.local' : 'php-cat.com'
], $d );


//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/contact', function () {
//    return view('contact')->layout('layouts.base');
//});
