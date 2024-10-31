<?php

use App\Http\Controllers\Fornec;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fornec', [Fornec::class, 'index'])->name('fornec.index');
