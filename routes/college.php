<?php

use App\Http\Controllers\College\CollegeCourseController;
use App\Http\Controllers\College\CollegeMeritController;
use App\Http\Controllers\College\DashboardController;
use App\Http\Controllers\College\LoginController;
use App\Http\Controllers\College\RegisterController;
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

Route::get('login', [LoginController::class,'loginShow'])->name('college.login');
Route::post('check', [LoginController::class,'check'])->name('college.check');



    Route::get('register',[RegisterController::class,'registerFormShow'])->name('college.register');
    Route::post('/create', [RegisterController::class, 'register'])->name('college.create');
});

Route::group(['middleware' => 'auth:college'], function () {

    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('college.logout');

     //Change Password
     Route::get('/changePassword',      [DashboardController::class, 'showChangePasswordGet'])->name('changePasswordGet');
     Route::post('/changePassword',     [DashboardController::class, 'changePasswordPost'])->name('changePasswordPost');

     //Profile
    Route::get('/profile/{id}',      [DashboardController::class, 'showProfile'])->name('profile');
    Route::post('/edit-profile',      [DashboardController::class, 'editProfile'])->name('edit_profile');

    //College Courses
    Route::resource('course','CollegeCourseController');
    Route::post('delete',     [CollegeCourseController::class, 'destroy'])->name('delete');

    //College Merit
    Route::resource('merit','CollegeMeritController');
    Route::post('round', [CollegeMeritController::class,'getRound'])->name('round');
    Route::post('merit-delete',     [CollegeMeritController::class, 'destroy'])->name('merit_delete');









});




