<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoansController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Add Balance Rp. 500k
Route::get('/addbalance', [ProfileController::class, 'addbalance'])->middleware(['auth', 'verified'])->name('addbalance');

//User Loans
Route::get('/loans', [LoansController::class, 'index'])->middleware(['auth', 'verified'])->name('loans');
Route::get('/addloans', [LoansController::class, 'addloans'])->middleware(['auth', 'verified'])->name('addloans');
Route::post('/addloans', [LoansController::class, 'addnewloans'])->middleware(['auth', 'verified'])->name('addnewloans');

//User Repayment
Route::get('/repayment', [LoansController::class, 'repayment'])->middleware(['auth', 'verified'])->name('repayment');
Route::get('/repaymentdetail', [LoansController::class, 'repaymentdetail'])->middleware(['auth', 'verified'])->name('repaymentdetail');
Route::get('/repayment/{id}', [LoansController::class, 'settlerepayment'])->middleware(['auth', 'verified'])->name('settlerepayment');

//Admin Approval
Route::get('/approval', [LoansController::class, 'approval'])->middleware(['auth', 'verified'])->name('approval');
Route::get('/approval/detail/{id}', [LoansController::class, 'approvaldetail'])->middleware(['auth', 'verified'])->name('approvaldetail');
Route::post('/approveloans', [LoansController::class, 'approveloans'])->middleware(['auth', 'verified'])->name('approveloans');

require __DIR__.'/auth.php';
