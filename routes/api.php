<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserSubjectController;


// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Rutas para usuarios
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getAllUsers']);
    Route::post('/', [UserController::class, 'createUser']);
    Route::get('/classroom', [UserController::class, 'getAllUsersWithClassrooms']);
    Route::get('/role/{role}', [UserController::class, 'getUsersByRole']);
    Route::get('/{id}/grades', [UserController::class, 'getUserGrades']);
    Route::get('/{id}', [UserController::class, 'getUserById']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
    Route::get('/{id}/classroom', [UserController::class, 'getUserClassroom']);
});

// Rutas para asignaturas
Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'getAllSubjects']);
    Route::post('/', [SubjectController::class, 'createSubject']);
    Route::get('/{id}', [SubjectController::class, 'getSubjectById']);
    Route::get('/{id}/users', [SubjectController::class, 'getUsersBySubject']);
    Route::put('/{id}', [SubjectController::class, 'updateSubject']);
    Route::delete('/{id}', [SubjectController::class, 'deleteSubject']);
});

Route::prefix('user-subjects')->group(function () {
    Route::post('/attach', [UserSubjectController::class, 'attach']);
    Route::post('/detach', [UserSubjectController::class, 'detach']);
    Route::post('/sync', [UserSubjectController::class, 'sync']);
    Route::get('/user/{userId}', [UserSubjectController::class, 'userSubjects']);
    Route::get('/subject/{subjectId}', [UserSubjectController::class, 'subjectUsers']);
});

// Rutas para notas
Route::prefix('grades')->group(function () {
    Route::get('/', [GradeController::class, 'getAllGrades']);
    Route::post('/', [GradeController::class, 'createGrade']);
    Route::get('/details', [GradeController::class, 'getAllGradesWithRelations']);
    Route::get('/subject/{id}', [GradeController::class, 'getGradesBySubject']);
    Route::get('/{id}', [GradeController::class, 'getGradeById']);
    Route::get('/{id}/details', [GradeController::class, 'getGradeDetails']);
    Route::put('/{id}', [GradeController::class, 'updateGrade']);
    Route::delete('/{id}', [GradeController::class, 'deleteGrade']);
});

// Rutas para computadoras
Route::prefix('computers')->group(function () {
    Route::get('/', [ComputerController::class, 'getAllComputers']);
    Route::post('/', [ComputerController::class, 'createComputer']);
    Route::get('/details', [ComputerController::class, 'getAllComputersWithRelations']);
    Route::get('/{id}', [ComputerController::class, 'getComputerById']);
    Route::get('/{id}/details', [ComputerController::class, 'getComputerDetails']);
    Route::post('/batch-details', [ComputerController::class, 'getComputersBatchDetails']);
    Route::put('/{id}', [ComputerController::class, 'updateComputer']);
    Route::delete('/{id}', [ComputerController::class, 'deleteComputer']);
});

// Rutas para aulas
Route::prefix('classrooms')->group(function () {
    Route::get('/', [ClassroomController::class, 'getAllClassrooms']);
    Route::post('/', [ClassroomController::class, 'createClassroom']);
    Route::get('/details', [ClassroomController::class, 'getAllClassroomsWithRelations']);
    Route::get('/{id}', [ClassroomController::class, 'getClassroomById']);
    Route::get('/{id}/details', [ClassroomController::class, 'getClassroomDetails']);
    Route::put('/{id}', [ClassroomController::class, 'updateClassroom']);
    Route::delete('/{id}', [ClassroomController::class, 'deleteClassroom']);
});

// Rutas para mesas
Route::prefix('boards')->group(function () {
    Route::get('/', [BoardController::class, 'getAllBoards']);
    Route::post('/', [BoardController::class, 'createBoard']);
    Route::get('/details', [BoardController::class, 'getAllBoardsWithRelations']);
    Route::get('/{id}', [BoardController::class, 'getBoardById']);
    Route::get('/{id}/details', [BoardController::class, 'getBoardDetails']);
    Route::post('/batch-details', [BoardController::class, 'getBoardsBatchDetails']);
    Route::put('/{id}', [BoardController::class, 'updateBoard']);
    Route::delete('/{id}', [BoardController::class, 'deleteBoard']);
});

// Ruta para obtener el usuario autenticado
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::options('{any}', function () {
    return response()->json([], 200);
})->where('any', '.*');
