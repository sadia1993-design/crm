<?php

use App\Http\Controllers\StatusController;
use App\Http\Controllers\TimesheetsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IsAdmin;
use App\Http\Controllers\IsCustomerController;
use App\Http\Controllers\Customers;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\customer\ProposalApproveController;
use App\Http\Controllers\customer\ProposalPendingController;

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;


Route::Group(['prefix' => 'admin', 'middleware' => ['ChkAdmin']], function () {
    Route::resource('/customers', Customers::class);
    Route::get('/customer', [IsAdmin::class, 'customer'])->name('customer');
    Route::get('/', [IsAdmin::class, 'index'])->name('dashboard');
    Route::resource('/users', UserRegisterController::class);

//    Route::post('sendmail/invoice/{id}', [InvoiceController::class, 'mail_send'] )->name('mail');

    Route::resource('/invoice', InvoiceController::class);
    Route::resource('/task_list', StatusController::class);
    Route::resource('/timesheets',TimesheetsController::class);


});

Route::Group(['middleware' => ['ChkCustomer']], function () {
    Route::get('/customer_panel', [IsCustomerController::class, 'index'])->name('customer_panel');

    Route::get('/proposalDownload/{id}', [ProposalApproveController::class, 'printToPdf'])->name('proposalDownload');


    Route::resource('/proposals', ProposalApproveController::class);
    Route::get('/proposal/status',  [ProposalApproveController::class, 'status'])->name('proposals.status');
    Route::get('proposal/pending', [ProposalApproveController::class, 'pending'])->name('proposals.pending');
    Route::get('proposal/approved', [ProposalApproveController::class, 'approved'])->name('proposals.approved');
    Route::get('proposal/declined', [ProposalApproveController::class, 'declined'])->name('proposals.declined');

    Route::resource('/invoice', InvoiceController::class);
});


Auth::routes(['register' => false]);

Route::get('/', [IsAdmin::class, 'lead'])->name('lead');
Route::get('/', function () {
});



