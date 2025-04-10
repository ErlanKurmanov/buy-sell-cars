<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarSearchController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Provides with data to fill main menu
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');




// --------- Car operation routes

// Search
// Route to display the initial search form (if needed separately)
Route::get('/cars', [CarSearchController::class, 'showForm'])->name('cars.showSearch');
// Route to handle the search submission
Route::get('/cars/search', [CarSearchController::class, 'search'])->name('cars.search');

// Fetching model for js ajax
Route::get('models/{makerId}', [CarSearchController::class, 'getCarModel']);
Route::get('/cities/{regionId}', [CarSearchController::class, 'getCitiesByRegionId']);


// My favorite cars section
Route::get('car/watchlist', [CarController::class, 'watchlist'])->name('car.watchlist');



Route::resource('car', CarController::class);
//Route::get('/', [CarController::class, 'index'])->name('car.index');


// Registration
Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup');

//Login & logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

