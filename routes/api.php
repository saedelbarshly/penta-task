<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Queries\JobController;
use App\Http\Controllers\Queries\TaskController;
use App\Http\Controllers\Queries\AccountController;
use App\Http\Controllers\Queries\ProjectController;
use App\Http\Controllers\Api\Hierarchical\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Hierarchical task

Route::get('categories', [CategoryController::class, 'index']);

// Queries task

Route::apiResource('accounts', AccountController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('jobs', JobController::class);
Route::apiResource('tasks', TaskController::class);

Route::get('tasks/project-price-less-than/{price}', [TaskController::class, 'getTasksByProjectPrice']);