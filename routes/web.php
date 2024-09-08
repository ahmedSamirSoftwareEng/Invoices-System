<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesDetailsController;

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

// Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionController::class);

Route::resource('products', ProductController::class);

Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);

Route::get ('/section/{id}', [InvoiceController::class, 'getproducts']);

Route::get ('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'show']);

Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class, 'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy_file'])->name ('delete_file');

Route::get('/Status_show/{id}', [InvoiceController::class, 'Status_show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');





Route::get('/{page}', [AdminController::class, 'index']);


