<?php

use App\Http\Controllers\RamfAppVersionController;
use App\Http\Controllers\RamfAppController;
use App\Http\Controllers\STBController;
use App\Http\Controllers\STBVersionController;


use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/ramfapp/create', [RamfAppController::class, 'storeApi']);
Route::get('/ramfapp/index', [RamfAppController::class, 'index'])->name('api.ramfapp.index');

Route::post('/ramfapp/version/create', [RamfAppVersionController::class, 'storeApi']);

Route::get('ramfapp/show',[RamfAppController::class,'getVersion']);


Route::post('/stb/create', [STBController::class, 'storeApi']);
Route::get('/stb/index', [STBController::class, 'index'])->name('api.stb.index');

Route::post('/stb/version/create', [STBVersionController::class, 'storeApi']);

Route::get('stb/show',[STBController::class,'getVersion']);
