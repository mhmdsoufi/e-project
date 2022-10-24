<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchivedInvoicesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomersReportControllere;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\PrintInvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportInvoicesControllere;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\Models\invoices;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

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


Route::get('/home', [HomeController::class, 'index'])->name('home');

//auth
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','UserManagement\RoleController');
    Route::resource('users','UserManagement\UserController');
});
//users
Route::get('/users', [UserController::class,'index']);
Route::get('/users_create', [UserController::class,'create']);
Route::post('/users_store', [UserController::class,'store'])->name('users.store');
Route::get('/user_update/{id}', [UserController::class,'edit']);
Route::post('/users_update/{id}', [UserController::class,'update']);

//roles
Route::get('/roles', [RoleController::class,'index']);
Route::get('/roles_create', [RoleController::class,'create']);
Route::get('/roles_show/{id}', [RoleController::class,'show']);
Route::get('/roles_edit/{id}', [RoleController::class,'edit']);
Route::patch('/roles_update/{id}', [RoleController::class,'update'])->name('roles.update');
Route::post('/roles_store', [RoleController::class,'store'])->name('roles.store');


//invoices
Route::get('/invoices-list', [InvoicesController::class,'index']);

Route::get('/print-invoice/{id}', [PrintInvoicesController::class,'index'])->name('print-invoice');

Route::get('/Paid', [InvoicesController::class,'paid_invoices']);

Route::get('/UnPaid', [InvoicesController::class,'unpaid_invoices']);

Route::get('/Partially', [InvoicesController::class,'partiallypaid_invoices']);

//Route::post('/archive-invoice', [InvoicesController::class,'archive'])->name('archive-invoice');

Route::post('/restore-invoice', [ArchivedInvoicesController::class,'edit'])->name('restore-invoice');

Route::post('/archiveinvoices/delete',[ArchivedInvoicesController::class,'destroy'])->name('archiveinvoices.destroy');

Route::get('/archived-invoices', [ArchivedInvoicesController::class,'index']);

Route::get('/invoices/create', [InvoicesController::class,'create']);

Route::post('/invoices', [InvoicesController::class,'store']);

Route::get('/edit_invoice/{id}',[InvoicesController::class,'edit']);

Route::get('/edit_invoice/',[InvoicesController::class,'edit']);

Route::post('/edit_invoice/invoices/update',[InvoicesController::class,'update']);

Route::post('/invoices/delete',[InvoicesController::class,'destroy'])->name('invoices.destroy');

Route::get('/payment-status/{id}',[InvoicesController::class,'show'])->name('payment-status');

Route::post('/update-payment/{id}',[InvoicesController::class,'update_payment'])->name('update-payment');

Route::get('invoices/export/', [InvoicesController::class, 'export']);
//sections
Route::get('/sign-up', [SectionsController::class,'index1']);

Route::get('/sections', [SectionsController::class,'index']);

Route::post('sections/update',[SectionsController::class,'update']);

Route::post('sections/update/{id}',[SectionsController::class,'update']);

Route::post('sections/destroy/{id}',[SectionsController::class,'destroy']);
//products
Route::get('/products', [ProductsController::class,'index']);

Route::post('/products', [ProductsController::class,'store'])->name('products.store');

Route::post('products/update',[ProductsController::class,'update']);

Route::post('products/destroy',[ProductsController::class,'destroy']);

Route::get('/section/{id}',[InvoicesController::class,'getproducts']);
//invoices details
Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'index']);

Route::get('/view_file/{invoice_number}/{file_name}',[InvoicesAttachmentsController::class,'open']);

Route::get('/download/{invoice_number}/{file_name}',[InvoicesAttachmentsController::class,'download']);

Route::post('details/destroy',[InvoicesAttachmentsController::class,'destroy'])->name('delete_file');

Route::post('/InvoiceAttachments',[InvoicesAttachmentsController::class,'store']);

//reports
Route::get('/invoices_report',[ReportInvoicesControllere::class,'index']);
Route::post('/Search_invoices',[ReportInvoicesControllere::class,'search']);

Route::get('/customers_report',[CustomersReportControllere::class,'index']);
Route::post('/search_customers',[CustomersReportControllere::class,'search']);

Route::get('/markasread',[InvoicesDetailsController::class,'markasread']);


//Route::post('/sections',[SectionsController::class,'store'])->name('sections.store');
//Auth::routes(['register']);
//Route::resource('sections',SectionsController::class);
//Route::get('/{id}', [AdminController::class, 'index']);
