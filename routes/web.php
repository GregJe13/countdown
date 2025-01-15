<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('countdown');
})->name('countdown');

Route::get('/stopwatch', function () {
    return view('stopwatch');
})->name('stopwatch');

Route::get('/clock', function () {
    return view('clock');
})->name('clock');



