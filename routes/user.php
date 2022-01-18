<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\StudentMarkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login', [LoginController::class, 'loginFormShow'])->name('login');
    Route::post('check', [LoginController::class, 'check'])->name('check');

    Route::get('/register', [RegisterController::class, 'registerFormShow'])->name('register');
    Route::post('/create', [RegisterController::class, 'register'])->name('create');
});

Route::group(['middleware' => 'auth:user'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //Change Password
    Route::get('/changePassword',      [DashboardController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePasswordPost',     [DashboardController::class, 'changePasswordPosts'])->name('user.changePasswordPost');

    //Profile
    Route::get('/profile/{id}',      [DashboardController::class, 'showProfile'])->name('profile');
    Route::post('/edit-profile',      [DashboardController::class, 'editProfile'])->name('edit_profile');

    //addminssion
    Route::resource('addmission','AddmissionController');

    //student marks
    Route::resource('marks','StudentMarkController')->except('destroy');
    Route::post('delete',     [StudentMarkController::class, 'destroy'])->name('delete');



});
