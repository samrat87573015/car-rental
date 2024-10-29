<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/', [PageController::class, 'homePage'])->name('homePage');


Route::post('/user-register',[UserController::class,'register']);

//Route::post('/otp-validation',[UserController::class,'otpValidation']);

Route::post('/user-login',[UserController::class,'userLogin']);


// page routes
Route::get('/logout',[UserController::class,'logout']);
Route::get('/register', [UserController::class, 'registerPage'])->name('registerPage');
Route::get('/user-check', [UserController::class, 'userCheck'])->name('userCheck')->middleware(UserMiddleware::class);
Route::get('/about', [PageController::class, 'aboutPage'])->name('aboutPage');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contactPage');



Route::group(['prefix' => 'admin', 'middleware' => [AdminMiddleware::class]], function () {
    //car routes
    Route::post('/car-store',[CarController::class,'store']);
    Route::post('/car-update',[CarController::class,'update']);
    Route::post('/car-delete',[CarController::class,'destroy']);
    Route::get('/car-list', [CarController::class, 'index'])->name('carList');
    Route::get('/cars/{car_id}', [CarController::class, 'show'])->name('carDetail');
    Route::get('car-edit/{car_id}', [CarController::class, 'edit'])->name('carEdit');

    // Route::resource('cars', CarController::class);


    //rental routes
    Route::post('/rental-store',[RentalController::class,'store']);
    Route::post('/rental-update',[RentalController::class,'update']);
    Route::get('/rental-delete/{rental_id}',[RentalController::class,'destroy']);
    Route::get('rentals/{rental_id}', [RentalController::class, 'show'])->name('rentalDetail');
    Route::get('/rental-list', [RentalController::class, 'index'])->name('rentalList');
    Route::get('/rental-create', [RentalController::class, 'create'])->name('createrentalPage');
    Route::get('/rental-edit/{rental_id}', [RentalController::class, 'edit'])->name('editrentalPage');

    //customer routes
    Route::post('/customer-store',[CustomerController::class,'store']);
    Route::post('/customer-update',[CustomerController::class,'update']);
    Route::get('/customer-delete/{customer_id}',[CustomerController::class,'destroy']);
    Route::get('/customer-list', [CustomerController::class, 'index'])->name('customerList');
    Route::get('customers/{customer_id}', [CustomerController::class, 'show'])->name('customerDetail');
    Route::get('/customer-edit/{customer_id}', [CustomerController::class, 'edit'])->name('customerEdit');
    Route::get('/customers/{customer_id}', [CustomerController::class, 'show'])->name('customerDetail');


    //dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

});



Route::get('/car-list', [App\Http\Controllers\Frontend\CarController::class, 'carList'])->name('carList');

Route::get('/cars/{car_id}', [App\Http\Controllers\Frontend\CarController::class, 'carDetail'])->name('carDetail');

Route::get('/rentals', [PageController::class, 'rentalPage'])->name('rentalPage');




Route::group(['middleware' => [UserMiddleware::class]], function () {
    //booking routes
    Route::post('/car-booking', [App\Http\Controllers\Frontend\RentalController::class, 'carBooking']);

    Route::post('/cancel-booking', [App\Http\Controllers\Frontend\RentalController::class, 'cancelBooking']);

    Route::get('/rentals-history', [PageController::class, 'rentalHistory']);


});








Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);