<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::resource('rooms', RoomController::class);

Route::resource('bookings', BookingController::class);

Route::resource('users', UserController::class);
