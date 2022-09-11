<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Models\invoices;
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
//Auth::routes(['register']);



//Route::get('/{id}', [AdminController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/invoices-list', [InvoicesController::class,'index']);

Route::get('/invoices/create', [InvoicesController::class,'create']);

Route::post('/invoices', [InvoicesController::class,'store'])->name('invoices.store');

Route::get('/edit_invoice/{id}',[InvoicesController::class,'edit']);

Route::post('/invoices/update',[InvoicesController::class,'update']);

Route::post('/invoices/delete',[InvoicesController::class,'destroy'])->name('invoices.destroy');

Route::get('/sign-up', [SectionsController::class,'index1']);

Route::get('/sections', [SectionsController::class,'index']);

Route::post('sections/update',[SectionsController::class,'update']);

Route::post('sections/destroy',[SectionsController::class,'destroy']);

Route::post('/sections',[SectionsController::class,'store'])->name('sections.store');

Route::get('/products', [ProductsController::class,'index']);

Route::post('/products', [ProductsController::class,'store'])->name('products.store');

Route::post('products/update',[ProductsController::class,'update']);

Route::post('products/destroy',[ProductsController::class,'destroy']);

Route::get('/section/{id}',[InvoicesController::class,'getproducts']);

Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'index']);

Route::get('/view_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'open']);

Route::get('/download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'download']);

Route::post('details/destroy',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::post('/InvoiceAttachments',[InvoicesAttachmentsController::class,'store']);
