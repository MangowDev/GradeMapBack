<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::post('/user', [UserController::class, 'createUser']);
Route::get('/user/{id}', [UserController::class, 'getUserById']);
Route::get('/user/role/{role}', [UserController::class, 'getUsersByRole']);
Route::put('/user/{id}', [UserController::class, 'updateUser']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser']);

Route::get('/subjects', [SubjectController::class, 'getAllSubjects']);
Route::post('/subjects', [SubjectController::class, 'createSubject']);
Route::get('/subjects/{id}', [SubjectController::class, 'getSubjectById']);
Route::put('/subjects/{id}', [SubjectController::class, 'updateSubject']);
Route::delete('/subjects/{id}', [SubjectController::class, 'deleteSubject']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
