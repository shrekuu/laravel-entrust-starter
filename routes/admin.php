<?php



Route::get('/home', function () {
    return view('admin.home');
})->name('admin.home');

