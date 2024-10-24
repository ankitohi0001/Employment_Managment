<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendancesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployesController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TotalSalaryController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
	Route::resource('users', UsersController::class)->middleware('auth');
Route::resource('attendances', \App\Http\Controllers\AttendanceController::class)->middleware('auth');
Route::post('/attendances/checkin/{user}', [AttendanceController::class, 'checkIn'])->name('attendances.checkin');
Route::post('/attendances/checkout/{user}', [AttendanceController::class, 'checkOut'])->name('attendances.checkout');
Route::get('/attendances/absent/{user}', [AttendanceController::class, 'markAbsent'])->name('attendances.absent');
Route::get('/attendances/view/{user}', [AttendanceController::class, 'viewAttendance'])->name('attendances.view');
Route::post('/attendances/{user}/leave', [AttendanceController::class, 'markLeave'])->name('attendances.leave');
Route::get('totalsalary', [TotalSalaryController::class, 'index'])->middleware('auth')->name('totalsalary');
Route::resource('positions', PositionController::class)->middleware('role:admin');
Route::resource('salary_types', SalaryTypeController::class)->middleware('auth');
Route::post('salary_types/{salary_type}', [SalaryTypeController::class, 'update'])->middleware('auth');
Route::resource('employes',EmployesController::class)->middleware('auth');
Route::get('employees', [StatusController::class, 'index'])->middleware('auth')->name('employees');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'role:user'], function () {
	Route::get('attendancess', [AttendancesController::class, 'index'])->name('attendancess');
	Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


});
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});