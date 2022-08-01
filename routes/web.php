<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PhysicalStatusController;
use App\Http\Controllers\RightTypeController;
use App\Http\Controllers\ScanStatusController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', function () {
    return redirect('login');
});

Route::any('/register', function () {
    return redirect('login');
});

Route::any('/password/{any}', function () {
    return redirect('login');
})->where('any', '(.*)?');

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	Route::get('/getCities/{id}', [AreaController::class, 'getCities']);
	Route::get('/getDistricts/{id}', [AreaController::class, 'getDistricts']);
	Route::get('/getVillages/{id}', [AreaController::class, 'getVillages']);

	Route::resource('archive', ArchiveController::class)->except('create', 'show');
	Route::get('json-archives', [ArchiveController::class, 'jsonArchives'])->name('json_archive');
	Route::get('json-archives-member', [HomeController::class, 'jsonArchives'])->name('json_archive_member');
});

Route::group(['middleware' => 'admin'], function () {
	Route::get('json-logs', [LogController::class, 'jsonLogs'])->name('json_logs');

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::resource('user', UserController::class)->except('show', 'update', 'create', 'edit');
	Route::put('/user/cp', [UserController::class, 'changePass'])->name('user.change_password');
	Route::put('/user/cr', [UserController::class, 'changeRole'])->name('user.change_role');

	Route::resource('type', TypeController::class)->except('create', 'edit', 'show');
	Route::resource('rightType', RightTypeController::class)->except('create', 'edit', 'show');
	Route::resource('scanStatus', ScanStatusController::class)->except('create', 'edit', 'show');
	Route::resource('physicalStatus', PhysicalStatusController::class)->except('create', 'edit', 'show');
	Route::resource('condition', ConditionController::class)->except('create', 'edit', 'show');
	Route::resource('log', LogController::class)->except('create', 'show', 'edit', 'update', 'destroy');
});



