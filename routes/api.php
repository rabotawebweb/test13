<?php

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


Route::get('/comments/{id}/{sort}', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::get('/answers/{id}', [App\Http\Controllers\CommentController::class, 'answers'])->name('comments.answers');

