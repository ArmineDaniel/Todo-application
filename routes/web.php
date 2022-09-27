<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
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

Route::get('/dashboard',[ToDoController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('task')->group(function (){
    Route::get('/',[ToDoController::class, 'add']);
    Route::post('/',[ToDoController::class, 'create']);
    Route::get('/{task}', [ToDoController::class, 'edit']);
    Route::post('/{task}', [ToDoController::class, 'update']);
    Route::post('delete/{task}', [ToDoController::class, 'delete']);
    Route::post('complete/{task}', [ToDoController::class, 'complete']);
});

require __DIR__.'/auth.php';
