<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RamfAppController;
use App\Http\Controllers\RamfAppVersionController;
use App\Http\Controllers\STBController;
use App\Http\Controllers\STBVersionController;
use App\Models\STBVersion;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [STBController::class, 'create'])->name('stb.create');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
    
//     // Add other protected routes here
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::controller(STBController::class)->group(function(){
        Route::get('stb/index','index')->name('stb.index');
        Route::get('stb/create','create')->name('stb.create');
        Route::post('stb/store', 'storeWeb')->name('stb.storeWeb');
        Route::get('stb/{id}/edit', 'edit')->name('stb.edit');
        Route::put('stb/{id}', 'update')->name('stb.update');
        Route::delete('stb/{id}', 'destroy')->name('stb.destroy');
    });
    
    Route::controller(STBVersionController::class)->group(function(){
        Route::get('stb/version/index','index')->name('stb.version.index');
        Route::get('stb/version/create','create')->name('stb.version.create');
        Route::post('stb/version/store', 'storeWeb')->name('stb.version.storeWeb');
        Route::get('stb/version/{id}/edit', 'edit')->name('stb.version.edit');
        Route::put('stb/version/{id}', 'update')->name('stb.version.update');
        Route::delete('stb/version/{id}', 'destroy')->name('stb.version.destroy');
    });



    Route::controller(RamfAppController::class)->group(function(){
        Route::get('ramfapp/index','index')->name('ramfapp.index');
        Route::get('ramfapp/create','create')->name('ramfapp.create');
        Route::post('ramfapp/store', 'storeWeb')->name('ramfapp.storeWeb');
        Route::get('ramfapp/{id}/edit', 'edit')->name('ramfapp.edit');
        Route::put('ramfapp/{id}', 'update')->name('ramfapp.update');
        Route::delete('ramfapp/{ixd}', 'destroy')->name('ramfapp.destroy');
    });
    
    Route::controller(RamfAppVersionController::class)->group(function(){
        Route::get('ramfapp/version/index','index')->name('ramfapp.version.index');
        Route::get('ramfapp/version/create','create')->name('ramfapp.version.create');
        Route::post('ramfapp/version/store', 'storeWeb')->name('ramfapp.version.storeWeb');
        Route::get('ramfapp/version/{id}/edit', 'edit')->name('ramfapp.version.edit');
        Route::put('ramfapp/version/{id}', 'update')->name('ramfapp.version.update');
        Route::delete('ramfapp/version/{id}', 'destroy')->name('ramfapp.version.destroy');
    });
    
    // Route::post('/stb', [STBController::class, 'storeWeb'])->name('stb.storeWeb');
    // Route::post('/stb-version', [STBVersionController::class, 'store'])->name('stb_version.store');

});    

require __DIR__.'/auth.php';
