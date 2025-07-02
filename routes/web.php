<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\GuestChecker;
use App\Http\Middleware\LoginChecker;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::middleware([GuestChecker::class])->group(function () {
    Route::get('/login',[HomeController::class,'LoginUi'])->name('LoginUi');
    Route::post('/login', [HomeController::class, 'LoginUser'])->name('Login');
    Route::get('/register',[HomeController::class,'RegisterUi'])->name('RegisterUi');
    Route::post('/register', [HomeController::class, 'RegisterUser'])->name('Register');
});
Route::middleware([LoginChecker::class])->group(function()
{
    Route::get('/dashboard',[DashboardController::class, 'DashboardUi'])->name('Dashboard');
    Route::get('/product',[DashboardController::class, 'ProductUi'])->name('ProductUi');
    Route::get('/product/{count}',[DashboardController::class, 'NextPage'])->name('NextPage');
    Route::get('/product/back/{count}',[DashboardController::class, 'BackPage'])->name('BackPage');
    Route::get('/sales',[DashboardController::class, 'SoldUi'])->name('SalesUi');
    Route::get('/delete/{id}',[DashboardController::class, 'DeleteConfirm'])->name('DeleteConfirm');
    Route::get('/delete-sold/{id}',[DashboardController::class, 'DeleteConfirmSold'])->name('DeleteConfirmSold');
    Route::post('/delete/{id}',[DashboardController::class, 'DeleteProduct'])->name('DeleteProduct');
    Route::post('/edit/{id}',[DashboardController::class, 'EditProduct'])->name('EditProduct');
    Route::get('/edit/{id}',[DashboardController::class, 'EditProductUi'])->name('EditProductUi');
    Route::post('/add-product',[DashboardController::class, 'AddProduct'])->name('AddProduct');
    Route::post('/search',[DashboardController::class, 'SearchName'])->name('SearchName');
    Route::post('/search-product',[DashboardController::class, 'SearchProduct'])->name('SearchProduct');
    Route::get('/kasir',[DashboardController::class, 'CashierUi'])->name('CashierUi');
    Route::get('/addkeranjang/{id}',[DashboardController::class, 'AddToCart'])->name('AddToCart');
    Route::get('/clear-cart',[DashboardController::class, 'ClearCart'])->name('ClearCart');
    Route::get('/place-order',[DashboardController::class, 'PlaceOrder'])->name('PlaceOrder');
    Route::get('/sold',[DashboardController::class, 'SoldUi'])->name('SoldUi');
    Route::get('/next-sold/{count}',[DashboardController::class, 'NextSold'])->name('NextSold');
    Route::get('/back-sold/{count}',[DashboardController::class, 'BackSold'])->name('BackSold');
}

);