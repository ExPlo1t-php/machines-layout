<?php

use Illuminate\Support\Facades\Route;
// controllers
use App\Http\Controllers\Admin\AdminController;

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

// pages router
Route::get('/assembly', function(){
    return view('pages.assembly');
})->name('assembly');

Route::get('/injection', function(){
    return view('pages.injection');
})->name('injection');

// admin routers
Route::get('/addCabinet', [AdminController::class, 'cabinetForm'])->name('addCabinet');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
