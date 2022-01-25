<?php

use App\Http\Controllers\University\AddmissionController;
use App\Http\Controllers\University\DashboardController;
use App\Http\Controllers\University\CollegeController;
use App\Http\Controllers\University\CommonSettingController;
use App\Http\Controllers\University\CourseController;
use App\Http\Controllers\University\LoginController;
use App\Http\Controllers\University\MaritRoundController;
use App\Http\Controllers\University\StudentController;
use App\Http\Controllers\University\SubjectController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
    Route::get('/create', [CommonSettingController::class, 'create'])->name('create');
    Route::post('/store', [CommonSettingController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CommonSettingController::class, 'edit'])->name('edit');
    Route::post('update', [CommonSettingController::class, 'update'])->name('update');

    //Sudent
    Route::get('/list', [StudentController::class, 'index'])->name('list');
    Route::post('delete', [StudentController::class, 'delete'])->name('delete');

    //Course
    Route::get('/course-list', [CourseController::class, 'index'])->name('course_list');
    Route::get('course-status',[CourseController::class, 'status'])->name('course_status');

    //marit round
    Route::resource('marit','MaritRoundController');
    Route::post('merit-delete', [MaritRoundController::class, 'destroy'])->name('merit_delete');
    Route::get('merit-status',[MaritRoundController::class, 'status'])->name('merit_status');

    //admission
    Route::get('admission',[AddmissionController::class,'index'])->name('admission_list');

    //subject
    Route::get('subject',[SubjectController::class,'index'])->name('subject_list');





});
