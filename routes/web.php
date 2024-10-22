<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\bKashPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/যড', function () {
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

require __DIR__.'/auth.php';
Route::get('admin', [AdminController::class, 'index'])->name('itemForm')->middleware(['auth', 'admin']);
Route::post('store/item', [AdminController::class, 'storage'])->name('storeAddItem')->middleware(['auth', 'admin']);
Route::get('view', [AdminController::class, 'itemView'])->name('itemPage')->middleware(['auth', 'admin']);

// user section route
Route::get('/', [UserController::class, 'home'])->name('homepage');
Route::get('buy-item/{id}', [UserController::class, 'product'])->name('BuyItem')->middleware('auth');
Route::post('store', [UserController::class, 'store'])->name('storePage')->middleware('auth');


Route::get('ticket', [UserController::class, 'ticket'])->name('ticketPage')->middleware('auth');

// ticket page

Route::post('/pay-via-bkash', [bKashPaymentController::class, 'pay'])->name('payViaBkash')->middleware('auth');



// bkash
// web.php
Route::post('/process-payment', [UserController::class, 'processPayment'])->middleware('auth');
Route::post('/bkash/payment', [UserController::class, 'processPaymentTicket'])->name('ticket')->middleware('auth');

