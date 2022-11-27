<?php

use App\Http\Controllers\SectionsController;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/sections',function(){
    return sections::all();
});
Route::post('/sections',[SectionsController::class , 'update']);
Route::put('/sections/{id}',[SectionsController::class , 'update']);
Route::get('/sections/{id}',[SectionsController::class , 'show']);
Route::get('/sections/{id}/inv',[SectionsController::class , 'showev']);
Route::delete('/sections/{id}',[SectionsController::class , 'destroyapi']);

