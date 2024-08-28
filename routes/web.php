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
Route::get('/home', function () {
    return view('pages.home');
})->name('home');
Route::get('/', function () {
    return view('pages.home');
});
// ---------------------test-----------------------
Route::get('/test', [Controller::class, 'test'])->name('test');
// @everyone -----------------------------------------------------------
// pages router
// ⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️
Route::get('/assembly', [Controller::class, 'assembly'])->name('assembly');
Route::get('/injection', [Controller::class, 'injection'])->name('injection');
Route::get('/fetchFreePorts', [Controller::class, 'fetchFreePorts'])->name('fetchFreePorts');
// stationinfo
Route::get('/stationInfo/{SN}', [StationsController::class, 'stationInfo'])->name('stationInfo');
//assembly line inner layout
Route::get('/lineInfo/{type}', [LineController::class, 'lineInfo'])->name('lineInfo');
// routes that require authentication
// auth routes
require __DIR__.'/auth.php';
// auth routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/users', [UserController::class, 'showUsers'])->name('users');
    Route::get('/user/{id}', [UserController::class, 'showUser'])->name('user');
    Route::post('/editUser/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
    Route::delete('/deleteUse/{id}r', [UserController::class, 'deleteUser'])->name('deleteUser');
    // end of general



    Route::post('/stationPos/{SN}', [StationsController::class, 'stationPos'])->name('stationPos');
    Route::post('/linePos/{id}', [StationsController::class, 'linePos'])->name('linePos');
    Route::post('/cabinetPos/{id}', [StationsController::class, 'cabinetPos'])->name('cabinetPos');


    // admin routes ------------------------------------------------------------------------------------------------------------------
    // data showing routes


    // data management routes add - delete - update - search ------------------------------------------------------------------------ 
    // network cabinet
    Route::get('/searchCabinet',[SearchController::class, 'searchCabinet'])->name('searchCabinet');
    Route::get('/cabinet', [AdminController::class, 'showCab'])->name('cabinet');
    Route::post('/addCabinet', [AdminController::class, 'addCabinet'])->name('addCabinet');
    Route::delete('/deleteCabinet/{id}',[DeleteController::class, 'deleteCabinet'])->name('deleteCabinet');
    Route::get('/showCabinet/{id}', [UpdateController::class, 'showCabinet'])->name('showCabinet');
    Route::post('/updateCabinet/{id}', [UpdateController::class, 'updateCabinet'])->name('updateCabinet');
    // switch
    Route::get('/searchSwitch',[SearchController::class, 'searchSwitch'])->name('searchSwitch');
    Route::get('/switch', [AdminController::class, 'showSw'])->name('switch');
    Route::post('/addSwitch', [AdminController::class, 'addSwitch'])->name('addSwitch');
    Route::delete('/deleteSwitch/{id}',[DeleteController::class, 'deleteSwitch'])->name('deleteSwitch');
    Route::get('/showSwitch/{id}', [UpdateController::class, 'showSwitch'])->name('showSwitch');
    Route::post('/updateSwitch/{id}', [UpdateController::class, 'updateSwitch'])->name('updateSwitch');
    // Assembly lines
    Route::get('/searchLine',[SearchController::class, 'searchLine'])->name('searchLine');
    Route::get('/lines', [AdminController::class, 'showLn'])->name('lines');
    Route::post('/addLine', [AdminController::class, 'addLine'])->name('addLine');
    Route::delete('/deleteLine/{id}',[DeleteController::class, 'deleteLine'])->name('deleteLine');
    Route::get('/showLine/{id}', [UpdateController::class, 'showLine'])->name('showLine');
    Route::post('/updateLine/{id}', [UpdateController::class, 'updateLine'])->name('updateLine');
    // Station 
    Route::get('/searchStation',[SearchController::class, 'searchStation'])->name('searchStation');
    Route::get('/station', [AdminController::class, 'showStation'])->name('station');
    Route::get('/station/{SN}', [AdminController::class, 'showSpecificStation'])->name('stationSpecific');
    Route::post('/addStation', [AdminController::class, 'addStation'])->name('addStation');
    Route::post('/addStation/{id}', [AdminController::class, 'addSpecificStation'])->name('addSpecificStation');
    Route::delete('/deleteStation/{SN}',[DeleteController::class, 'deleteStation'])->name('deleteStation');
    Route::get('/showStation/{name}', [UpdateController::class, 'showStation'])->name('showStation');
    Route::post('/updateStation/{SN}', [UpdateController::class, 'updateStation'])->name('updateStation');
    // Station Type
    Route::get('/searchStationType',[SearchController::class, 'searchStationType'])->name('searchStationType');
    Route::get('/station-type', [AdminController::class, 'showStationType'])->name('station-type');
    Route::post('/addStationType', [AdminController::class, 'addStationType'])->name('addStationType');
    Route::delete('/deleteStationType/{id}', [DeleteController::class, 'deleteStationType'])->name('deleteStationType');
    Route::get('/showStationType/{id}', [UpdateController::class, 'showStationType'])->name('showStationType');
    Route::post('/updateStationType/{id}', [UpdateController::class, 'updateStationType'])->name('updateStationType');
    // Equipment
    Route::get('/searchEquipment',[SearchController::class, 'searchEquipment'])->name('searchEquipment');
    Route::get('/equipment', [AdminController::class, 'showEquipment'])->name('equipment');
    Route::get('/equipment/{SN}', [AdminController::class, 'showSpecificEquipment'])->name('equipmentSpecific');
    Route::post('/addEquipment', [AdminController::class, 'addEquipment'])->name('addEquipment');
    Route::post('/addEquipment/{SN}', [AdminController::class, 'addSpecificEquipment'])->name('addSpecificEquipment');
    Route::delete('/deleteEquipment/{SN}',[DeleteController::class, 'deleteEquipment'])->name('deleteEquipment');
    Route::get('/showEquipment/{name}', [UpdateController::class, 'showEquipment'])->name('showEquipment');
    Route::post('/updateEquipment/{name}', [UpdateController::class, 'updateEquipment'])->name('updateEquipment');
    // Equipment Type
    Route::get('/searchEquipmentType',[SearchController::class, 'searchEquipmentType'])->name('searchEquipmentType');
    Route::get('/equipment-type', [AdminController::class, 'showEquipmentType'])->name('equipment-type');
    Route::post('/addEquipmentType', [AdminController::class, 'addEquipmentType'])->name('addEquipmentType');
    Route::delete('/deleteEquipmentType/{name}', [DeleteController::class, 'deleteEquipmentType'])->name('deleteEquipmentType');
    Route::get('/showEquipmentType/{name}', [UpdateController::class, 'showEquipmentType'])->name('showEquipmentType');
    Route::post('/updateEquipmentType/{name}', [UpdateController::class, 'updateEquipmentType'])->name('updateEquipmentType');
    // end of admin routes
    Route::post('/station/store', [StationsController::class, 'store'])->name('station.store');
    // API routes for interacting with PLC
    Route::post('/variables/update/{id}', [PlcController::class, 'update'])->name('variables.update');
    Route::post('/plc/tracking/{id}',[ PlcController::class, 'setTrackingValue'])->name('plc.tracking');
    Route::get('/plcUsers', [PlcController::class, 'showPlcUsers'])->name('plcUsers');
    Route::post('/addPlcUser', [PlcController::class, 'addPlcUser'])->name('addPlcUser');
    route::get('/plcUser/{id}', [PlcController::class, 'showPlcUser'])->name('plcUser');
    route::post('/editPlcUser/{id}', [PlcController::class, 'editPlcUser'])->name('editPlcUser');
    route::delete('/deletePlcUser/{id}', [PlcController::class, 'deletePlcUser'])->name('deletePlcUser');
});


// API routes for interacting with PLC
Route::get('/traceability', [PlcController::class, 'show'])->name('traceability');
Route::get('/traceability/{id}', [PlcController::class, 'viewTraceability'])->name('traceability.view');
Route::get('/variable/{id}', [PlcController::class, 'getVariableData'])->name('variable.data');
Route::post('/plc/login', [PlcController::class, 'login'])->name('plc.login');
Route::get('/plc/logout', [PlcController::class, 'logout'])->name('plc.logout');




