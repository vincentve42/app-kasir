<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\GuestChecker;
use App\Http\Middleware\LoginChecker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::middleware([GuestChecker::class])->group(function () {
    Route::get('/login',[HomeController::class,'LoginUi'])->name('LoginUi');
    Route::get('/register',[HomeController::class,'RegisterUi'])->name('RegisterUi');
    Route::post('/register', [HomeController::class, 'RegisterUser'])->name('Register');
});