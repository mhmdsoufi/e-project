<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});




Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/invoices-list', [InvoicesController::class,'index']);

Route::get('/sections', [SectionsController::class,'index']);

route::post('sections/update',[SectionsController::class,'update']);

route::post('sections/destroy',[SectionsController::class,'destroy']);

route::post('/sections',[SectionsController::class,'store'])->name('sections.store');



