<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/business', [App\Http\Controllers\HomeController::class, 'create'])->name('home.create');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('home.store');
Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('home.edit');
Route::post('/update', [App\Http\Controllers\HomeController::class, 'update'])->name('home.update');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('home.delete');

Route::get('/branch', [App\Http\Controllers\BranchController::class, 'index'])->name('branch.index');
Route::get('branch/create', [App\Http\Controllers\BranchController::class, 'create'])->name('branch.create');
Route::post('branch/store', [App\Http\Controllers\BranchController::class, 'store'])->name('branch.store');
Route::get('branch/edit/{id}', [App\Http\Controllers\BranchController::class, 'edit'])->name('branch.edit');
Route::post('branch/update', [App\Http\Controllers\BranchController::class, 'update'])->name('branch.update');
Route::get('branch/delete/{id}', [App\Http\Controllers\BranchController::class, 'destroy'])->name('branch.delete');
Route::get('branch/view/{id}', [App\Http\Controllers\BranchController::class, 'view'])->name('branch.view');