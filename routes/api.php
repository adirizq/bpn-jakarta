<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\PhysicalStatusController;
use App\Http\Controllers\RightTypeController;
use App\Http\Controllers\ScanStatusController;
use App\Http\Controllers\TypeController;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function(Request $request){
    $credentials  = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        $user->tokens()->delete();
        $token = $user->createToken('user-token');

        return ['status' => 'success', 'user_id' => $user->id, 'user_name' => $user->name, 'token' => $token->plainTextToken];
    } else {
        return ['status' => 'fail', 'user_id' => 0, 'user_name' => "", 'token' => ""];
    }
});

Route::get('/archive', [ArchiveController::class, 'apiIndex'])->middleware('auth:sanctum');

Route::get('/archive/{archive}', [ArchiveController::class, 'apiShow'])->middleware('auth:sanctum');

Route::post('/archive', [ArchiveController::class, 'apiStore'])->middleware('auth:sanctum');

Route::delete('/archive/{archive}', [ArchiveController::class, 'apiDestroy'])->middleware('auth:sanctum');

Route::get('/type', [TypeController::class, 'apiIndex']);
Route::get('/right', [RightTypeController::class, 'apiIndex']);
Route::get('/scan', [ScanStatusController::class, 'apiIndex']);
Route::get('/physical', [PhysicalStatusController::class, 'apiIndex']);
Route::get('/condition', [ConditionController::class, 'apiIndex']);

Route::get('/area/provinces', [AreaController::class, 'apiProvinces']);
Route::get('/area/cities', [AreaController::class, 'apiCities']);
Route::get('/area/districts', [AreaController::class, 'apiDistricts']);
Route::get('/area/villages', [AreaController::class, 'apiVillages']);



