<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('auth.login');
});


// Auth::routes();

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionController::class);

Route::resource('products', ProductController::class);

Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);

Route::resource('Archive', InvoiceAchiveController::class);

Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'show']);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy_file'])->name('delete_file');

Route::get('/Status_show/{id}', [InvoiceController::class, 'Status_show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');

Route::get('Invoice_Paid', [InvoiceController::class, 'Invoice_Paid'])->name('Invoice_Paid');

Route::get('Invoice_UnPaid', [InvoiceController::class, 'Invoice_UnPaid'])
->name('Invoice_UnPaid')->middleware('permission:الفواتير الغير مدفوعة');

Route::get('Invoice_Partial', [InvoiceController::class, 'Invoice_Partial'])->name('Invoice_Partial');

Route::get('Print_invoice/{id}', [InvoiceController::class, 'Print_invoice'])->name('Print_invoice');

Route::get('export-invoices', [InvoiceController::class, 'exportInvoices'])->name('export-invoices');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('/{page}', [AdminController::class, 'index']);
