<?php

use App\Http\Controllers\ListgroupController;
use App\Http\Controllers\TodolistController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/{id?}', [TodolistController::class, 'index'])->name('dashboard');

    Route::post('/task/create', [TodolistController::class, 'create'])->name('task.create');

    Route::post('/task/update/{id}', [TodolistController::class, 'update'])->name('task.update');

    Route::get('/task/complete/{id}', [TodolistController::class, 'complete'])->name('task.complete');

    Route::get('/task/delete/{id}', [TodolistController::class, 'delete'])->name('task.delete');

    Route::post('/list/create', [ListgroupController::class, 'create'])->name('list.create');

    Route::get('/list/delete/{id}', [ListgroupController::class, 'delete'])->name('list.delete');

    Route::post('/list/update/{id}', [ListgroupController::class, 'update'])->name('list.update');

    Route::get('/list/theme/{id}', [ListgroupController::class, 'theme'])->name('list.theme');
});
