<?php

use Algolia\AlgoliaSearch\Http\Psr7\Request;
use Illuminate\Support\Facades\Route;
// controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlcController;
use App\Models\Equipment;
use App\Models\Coordinates;
use App\Models\Line;
use App\Models\Station;
use App\Models\StationType;
use Illuminate\Contracts\Pagination\Paginator;

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

Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::get('/', function () {
    return view('pages.home');
});

// auth routes
require __DIR__.'/auth.php';
// auth routes

// ---------------------test-----------------------
Route::get('/test', [Controller::class, 'test'])->name('test');
Route::get('/users', [UserController::class, 'showUsers'])->name('users');
Route::get('/user/{id}', [UserController::class, 'showUser'])->name('user');
Route::post('/editUser/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
Route::delete('/deleteUse/{id}r', [UserController::class, 'deleteUser'])->name('deleteUser');
// ---------------------test-----------------------
// end of general


// @everyone -----------------------------------------------------------
// pages router
// ⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️
Route::get('/assembly', [Controller::class, 'assembly'])->name('assembly');
Route::get('/injection', [Controller::class, 'injection'])->name('injection');
Route::post('/stationPos/{SN}', [StationsController::class, 'stationPos'])->name('stationPos');
Route::post('/linePos/{id}', [StationsController::class, 'linePos'])->name('linePos');
Route::post('/cabinetPos/{id}', [StationsController::class, 'cabinetPos'])->name('cabinetPos');
Route::get('/fetchFreePorts', [Controller::class, 'fetchFreePorts'])->name('fetchFreePorts');

// admin routes ------------------------------------------------------------------------------------------------------------------
// data showing routes
// stationinfo
Route::get('/stationInfo/{SN}', [StationsController::class, 'stationInfo'])->name('stationInfo');
//assembly line inner layout
Route::get('/lineInfo/{type}', [LineController::class, 'lineInfo'])->name('lineInfo');

// data management routes add - delete - update - search ------------------------------------------------------------------------ 
// network cabinet
Route::get('/searchCabinet',[SearchController::class, 'searchCabinet'])->name('searchCabinet')->middleware(['auth']);
Route::get('/cabinet', [AdminController::class, 'showCab'])->name('cabinet')->middleware(['auth']);
Route::post('/addCabinet', [AdminController::class, 'addCabinet'])->name('addCabinet')->middleware(['auth']);
Route::delete('/deleteCabinet/{id}',[DeleteController::class, 'deleteCabinet'])->name('deleteCabinet')->middleware(['auth']);
Route::get('/showCabinet/{id}', [UpdateController::class, 'showCabinet'])->name('showCabinet')->middleware(['auth']);
Route::post('/updateCabinet/{id}', [UpdateController::class, 'updateCabinet'])->name('updateCabinet')->middleware(['auth']);
// switch
Route::get('/searchSwitch',[SearchController::class, 'searchSwitch'])->name('searchSwitch')->middleware(['auth']);
Route::get('/switch', [AdminController::class, 'showSw'])->name('switch')->middleware(['auth']);
Route::post('/addSwitch', [AdminController::class, 'addSwitch'])->name('addSwitch')->middleware(['auth']);
Route::delete('/deleteSwitch/{id}',[DeleteController::class, 'deleteSwitch'])->name('deleteSwitch')->middleware(['auth']);
Route::get('/showSwitch/{id}', [UpdateController::class, 'showSwitch'])->name('showSwitch')->middleware(['auth']);
Route::post('/updateSwitch/{id}', [UpdateController::class, 'updateSwitch'])->name('updateSwitch')->middleware(['auth']);
// Assembly lines
Route::get('/searchLine',[SearchController::class, 'searchLine'])->name('searchLine')->middleware(['auth']);
Route::get('/lines', [AdminController::class, 'showLn'])->name('lines')->middleware(['auth']);
Route::post('/addLine', [AdminController::class, 'addLine'])->name('addLine')->middleware(['auth']);
Route::delete('/deleteLine/{id}',[DeleteController::class, 'deleteLine'])->name('deleteLine')->middleware(['auth']);
Route::get('/showLine/{id}', [UpdateController::class, 'showLine'])->name('showLine')->middleware(['auth']);
Route::post('/updateLine/{id}', [UpdateController::class, 'updateLine'])->name('updateLine')->middleware(['auth']);
// Station 
Route::get('/searchStation',[SearchController::class, 'searchStation'])->name('searchStation')->middleware(['auth']);
Route::get('/station', [AdminController::class, 'showStation'])->name('station')->middleware(['auth']);
    Route::get('/station/{SN}', [AdminController::class, 'showSpecificStation'])->name('stationSpecific')->middleware(['auth']);
Route::post('/addStation', [AdminController::class, 'addStation'])->name('addStation')->middleware(['auth']);
Route::post('/addStation/{id}', [AdminController::class, 'addSpecificStation'])->name('addSpecificStation')->middleware(['auth']);
    Route::delete('/deleteStation/{SN}',[DeleteController::class, 'deleteStation'])->name('deleteStation')->middleware(['auth']);
Route::get('/showStation/{name}', [UpdateController::class, 'showStation'])->name('showStation')->middleware(['auth']);
Route::post('/updateStation/{SN}', [UpdateController::class, 'updateStation'])->name('updateStation')->middleware(['auth']);
// Station Type
Route::get('/searchStationType',[SearchController::class, 'searchStationType'])->name('searchStationType')->middleware(['auth']);
Route::get('/station-type', [AdminController::class, 'showStationType'])->name('station-type')->middleware(['auth']);
Route::post('/addStationType', [AdminController::class, 'addStationType'])->name('addStationType')->middleware(['auth']);
Route::delete('/deleteStationType/{id}', [DeleteController::class, 'deleteStationType'])->name('deleteStationType')->middleware(['auth']);
Route::get('/showStationType/{id}', [UpdateController::class, 'showStationType'])->name('showStationType')->middleware(['auth']);
Route::post('/updateStationType/{id}', [UpdateController::class, 'updateStationType'])->name('updateStationType')->middleware(['auth']);
// Equipment
Route::get('/searchEquipment',[SearchController::class, 'searchEquipment'])->name('searchEquipment')->middleware(['auth']);
Route::get('/equipment', [AdminController::class, 'showEquipment'])->name('equipment')->middleware(['auth']);
    Route::get('/equipment/{SN}', [AdminController::class, 'showSpecificEquipment'])->name('equipmentSpecific')->middleware(['auth']);
Route::post('/addEquipment', [AdminController::class, 'addEquipment'])->name('addEquipment')->middleware(['auth']);
    Route::post('/addEquipment/{SN}', [AdminController::class, 'addSpecificEquipment'])->name('addSpecificEquipment')->middleware(['auth']);
Route::delete('/deleteEquipment/{SN}',[DeleteController::class, 'deleteEquipment'])->name('deleteEquipment')->middleware(['auth']);
Route::get('/showEquipment/{name}', [UpdateController::class, 'showEquipment'])->name('showEquipment')->middleware(['auth']);
Route::post('/updateEquipment/{name}', [UpdateController::class, 'updateEquipment'])->name('updateEquipment')->middleware(['auth']);
// Equipment Type
Route::get('/searchEquipmentType',[SearchController::class, 'searchEquipmentType'])->name('searchEquipmentType')->middleware(['auth']);
Route::get('/equipment-type', [AdminController::class, 'showEquipmentType'])->name('equipment-type')->middleware(['auth']);
Route::post('/addEquipmentType', [AdminController::class, 'addEquipmentType'])->name('addEquipmentType')->middleware(['auth']);
Route::delete('/deleteEquipmentType/{name}', [DeleteController::class, 'deleteEquipmentType'])->name('deleteEquipmentType')->middleware(['auth']);
Route::get('/showEquipmentType/{name}', [UpdateController::class, 'showEquipmentType'])->name('showEquipmentType')->middleware(['auth']);
Route::post('/updateEquipmentType/{name}', [UpdateController::class, 'updateEquipmentType'])->name('updateEquipmentType')->middleware(['auth']);
// end of admin routes


// API routes for interacting with PLC
Route::post('/station/store', [StationsController::class, 'store'])->name('station.store');
Route::get('/variable/{id}', [PlcController::class, 'getVariableData'])->name('variable.data');
Route::post('/variables/update/{id}', [PlcController::class, 'update'])->name('variables.update');
