<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('assignment')->group(function(){
    Route::get('/all', [ToDoController::class, 'allAssignment']);
    Route::get('/id/{uniqueID}', [ToDoController::class, 'assignmentById']);
    Route::post('/add', [ToDoController::class, 'createToDo']);
    Route::delete('/delete', [ToDoController::class, 'deleteToDo']);
    Route::patch('/update', [ToDoController::class, 'updateTodo']);
});
