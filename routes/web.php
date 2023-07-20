<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/', [TaskController::class, 'showTasks'])->middleware(['auth']);

Route::get('/home',[TaskController::class, 'showTasks'])->middleware(['auth']);

Route::post('/add-task',[TaskController::class, 'addTask'])->middleware(['auth']);


Route::get('/user-profile', function () { return view('user-profile'); })->middleware(['auth']);