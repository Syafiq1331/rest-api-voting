<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CandidateController;
use App\Http\Controllers\api\SelectionController;
use App\Http\Controllers\api\VotingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Candidate
Route::resources(
    ['candidates' => CandidateController::class,],
);

// Route Selection
Route::resources(
    ['selections' => SelectionController::class,],
);

// Custom Route
Route::get('/selections/active', [SelectionController::class, 'ShowActiveSelection']);
Route::get('/selections/inactive', [SelectionController::class, 'ShowInActiveSelection']);
Route::post('/voting/validate', [VotingController::class, 'validateVoting']);
Route::get('/voting/count', [VotingController::class, 'countVoting']);
Route::get('/voting/uncount', [VotingController::class, 'uncountVoting']);
Route::get('/voting/history', [VotingController::class, 'votingHistory']);
Route::get('/voting/statistic', [VotingController::class, 'statistic']);
