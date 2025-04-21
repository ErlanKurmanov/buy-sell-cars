<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarSearchController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    //Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//    ->middleware('auth');


// --------- Car operation routes

    //Cars
//My cars page
Route::get('/cars', [CarController::class, 'index'])->name('car.index');

//Route::middleware('auth')->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store')->withoutMiddleware(VerifyCsrfToken::class);
    //Route::post('/cars', function(Request $request){
    //    dd($request->all());
    //})->name('cars.store');
//});
Route::get('/cars/{car}', [CarController::class, 'show'])->name('car.show');


// My favorite cars section
Route::get('/car/watchlist', [CarController::class, 'watchlist'])->name('car.watchlist');




    // Car Search
// Route to display the initial search form (if needed separately)
Route::get('/cars', [CarSearchController::class, 'showForm'])->name('cars.showSearch');
// Route to handle the search submission
Route::get('/cars/search', [CarSearchController::class, 'search'])->name('cars.search');

// Fetching model for js ajax
Route::get('models/{makerId}', [CarSearchController::class, 'getCarModel']);
Route::get('/cities/{regionId}', [CarSearchController::class, 'getCitiesByRegionId']);

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    dd($token);
    $token = csrf_token();

    // ...
});





    // Registration
Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup');

    //Login & logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

