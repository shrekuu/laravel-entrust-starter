<?php

Route::get('/home', function () {
    return view('user.home');
})->name('user.home');

