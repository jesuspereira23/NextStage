<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OnboardingController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\EvolutionLogController;
use App\Http\Controllers\LevelController;

/*
|--------------------------------------------------------------------------
| AUTH — público
|--------------------------------------------------------------------------
*/

Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| PROTEGIDAS — Bearer token (Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me',          [AuthController::class, 'me']);
    Route::post('/logout',     [AuthController::class, 'logout']);
    Route::post('/onboarding', [OnboardingController::class, 'store']);

    Route::apiResource('objectives',    ObjectiveController::class);
    Route::apiResource('workouts',      WorkoutController::class);
    Route::apiResource('exercises',     ExerciseController::class);
    Route::apiResource('evolution-logs', EvolutionLogController::class);
    Route::apiResource('levels',        LevelController::class);

    Route::patch('objectives/{objective}/toggle', [ObjectiveController::class, 'toggle']);
    Route::patch('workouts/{workout}/toggle',     [WorkoutController::class,   'toggle']);
});
