<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDosController;

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

Route::get('/', [ToDosController::class, 'index'])->middleware('auth');

Auth::routes();

// create new todo
Route::post('/todos', [ToDosController::class, 'store'])->middleware('auth');

// Show to do
Route::get('/{id}', [ToDosController::class, 'show'])->middleware('auth');

// Show edit form
Route::get('/{id}/edit', [ToDosController::class, 'edit'])->middleware('auth');

// Update status
Route::put('/todos', [ToDosController::class, 'updateStatus'])->middleware('auth');

// Update to do
Route::put("/{id}", [ToDosController::class, 'update'])->middleware('auth');

// delete todo
Route::delete('/todos', [ToDosController::class, 'destroy'])->middleware('auth');

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/todo', [HomeController::class, 'index']);