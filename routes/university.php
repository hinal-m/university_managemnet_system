<?php

use App\Http\Controllers\University\DashboardController;
use App\Http\Controllers\University\CollegeController;
use App\Http\Controllers\University\CommonSettingController;
use App\Http\Controllers\University\LoginController;
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

    Route::get('login', [LoginController::class, 'loginShow'])->name('university.login');

    Route::post('check', [LoginController::class, 'check'])->name('university.check');
});

Route::group(['middleware' => 'auth:university'], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('university.logout');


    //Change Password
    Route::get('/changePassword',      [DashboardController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',     [DashboardController::class, 'changePasswordPost'])->name('changePasswordPost');

    //COLLEG
    Route::resource('college',          'CollegeController')->except('destroy');
    Route::post('delete',               [CollegeController::class, 'destroy'])->name('delete');
    Route::get('status',          [CollegeController::class, 'status'])->name('status');

    //Common Setting
    Route::get('/index', [CommonSettingController::class, 'index'])->name('index');

});
