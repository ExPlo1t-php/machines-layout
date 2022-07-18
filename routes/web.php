<?php

use Illuminate\Support\Facades\Route;
// controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SearchController;

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
// home routers
Route::get('/', function () {
    return view('pages.home');
});
Route::get('/home', function () {
    return view('pages.home');
})->name('home');
// search bar routes
Route::get('/index',[SearchController::class, 'index'])->name('index');
Route::get('/search',[SearchController::class, 'search'])->name('search');

// pages router
Route::get('/assembly', function(){
    return view('pages.assembly');
})->name('assembly');

Route::get('/injection', function(){
    return view('pages.injection');
})->name('injection');

// admin routers
// network cabinet
Route::get('/cabinet', [AdminController::class, 'showCab'])->name('cabinet')->middleware(['auth']);
Route::post('/addCabinet', [AdminController::class, 'addCabinet'])->name('addCabinet');
// switch
Route::get('/switch', [AdminController::class, 'showSw'])->name('switch')->middleware(['auth']);
Route::post('/addSwitch', [AdminController::class, 'addSwitch'])->name('addSwitch');
// Assembly lines
Route::get('/lines', [AdminController::class, 'showLn'])->name('lines')->middleware(['auth']);
Route::post('/addLine', [AdminController::class, 'addLine'])->name('addLine');
// Station 
Route::get('/station', [AdminController::class, 'showStation'])->name('station')->middleware(['auth']);
Route::post('/addStation', [AdminController::class, 'addStation'])->name('addStation');
// Station Type
Route::get('/station-type', [AdminController::class, 'showStationType'])->name('station-type')->middleware(['auth']);
Route::post('/addStationType', [AdminController::class, 'addStationType'])->name('addStationType');
// Equipment
Route::get('/equipment', [AdminController::class, 'showEquipment'])->name('equipment')->middleware(['auth']);
Route::post('/addEquipment', [AdminController::class, 'addEquipment'])->name('addEquipment');
// Equipment Type
Route::get('/equipment-type', [AdminController::class, 'showEquipmentType'])->name('equipment-type')->middleware(['auth']);
Route::post('/addEquipmentType', [AdminController::class, 'addEquipmentType'])->name('addEquipmentType');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
