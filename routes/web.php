<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', \App\Livewire\Counter::class)->name('index');
Route::get('/', \App\Livewire\Svo\Page::class)->name('index');
//Route::get('/trebs', \App\Livewire\Svo\Trebs::class)->name('trebs');
Route::get('/trebs', \App\Livewire\Svo\TrebsDataTable::class)->name('trebs');
Route::get('/fin', \App\Livewire\Svo\FinDataTable::class)->name('fin');
Route::get('/i/{page?}', \App\Livewire\Svo\Page::class)->name('page');



//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/contact', function () {
//    return view('contact')->layout('layouts.base');
//});
