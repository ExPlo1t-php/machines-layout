<?php

use Illuminate\Support\Facades\Route;
// controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UpdateController;

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
// general
// home routers
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('pages.home');
});
Route::get('/home', function () {
    return view('pages.home');
})->name('home');
// end of general


// @everyone
// pages router
Route::get('/assembly', function(){
    return view('pages.assembly');
})->name('assembly');

Route::get('/injection', function(){
    return view('pages.injection');
})->name('injection');

// admin routes
// network cabinet
Route::get('/cabinet', [AdminController::class, 'showCab'])->name('cabinet')->middleware(['auth']);
Route::get('/searchCabinet',[SearchController::class, 'searchCabinet'])->name('searchCabinet');
Route::post('/addCabinet', [AdminController::class, 'addCabinet'])->name('addCabinet');
Route::delete('/deleteCabinet/{name}',[DeleteController::class, 'deleteCabinet'])->name('deleteCabinet');
// switch
Route::get('/switch', [AdminController::class, 'showSw'])->name('switch')->middleware(['auth']);
Route::get('/searchSwitch',[SearchController::class, 'searchSwitch'])->name('searchSwitch');
Route::post('/addSwitch', [AdminController::class, 'addSwitch'])->name('addSwitch');
Route::delete('/deleteSwitch/{switchId}',[DeleteController::class, 'deleteSwitch'])->name('deleteSwitch');
// Assembly lines
Route::get('/lines', [AdminController::class, 'showLn'])->name('lines')->middleware(['auth']);
Route::get('/searchLine',[SearchController::class, 'searchLine'])->name('searchLine');
Route::post('/addLine', [AdminController::class, 'addLine'])->name('addLine');
Route::delete('/deleteLine/{name}',[DeleteController::class, 'deleteLine'])->name('deleteLine');
Route::get('/showLine/{name}', [UpdateController::class, 'showLine'])->name('showLine');
Route::post('/updateLine/{name}', [UpdateController::class, 'updateLine'])->name('updateLine');
// Station 
Route::get('/station', [AdminController::class, 'showStation'])->name('station')->middleware(['auth']);
Route::get('/searchStation',[SearchController::class, 'searchStation'])->name('searchStation');
Route::post('/addStation', [AdminController::class, 'addStation'])->name('addStation');
Route::delete('/deleteStation/{SN}',[DeleteController::class, 'deleteStation'])->name('deleteStation');
// Station Type
Route::get('/station-type', [AdminController::class, 'showStationType'])->name('station-type')->middleware(['auth']);
Route::get('/searchStationType',[SearchController::class, 'searchStationType'])->name('searchStationType');
Route::post('/addStationType', [AdminController::class, 'addStationType'])->name('addStationType');
Route::delete('/deleteStationType/{name}', [DeleteController::class, 'deleteStationType'])->name('deleteStationType');
// Equipment
Route::get('/equipment', [AdminController::class, 'showEquipment'])->name('equipment')->middleware(['auth']);
Route::get('/searchEquipment',[SearchController::class, 'searchEquipment'])->name('searchEquipment');
Route::post('/addEquipment', [AdminController::class, 'addEquipment'])->name('addEquipment');
Route::delete('/deleteEquipment/{SN}',[DeleteController::class, 'deleteEquipment'])->name('deleteEquipment');
// Equipment Type
Route::get('/equipment-type', [AdminController::class, 'showEquipmentType'])->name('equipment-type')->middleware(['auth']);
Route::get('/searchEquipmentType',[SearchController::class, 'searchEquipmentType'])->name('searchEquipmentType');
Route::post('/addEquipmentType', [AdminController::class, 'addEquipmentType'])->name('addEquipmentType');
Route::delete('/deleteEquipmentType/{name}', [DeleteController::class, 'deleteEquipmentType'])->name('deleteEquipmentType');
// end of admin routes