<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tenants', App\Http\Controllers\Admin\TenantController::class);
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
    Route::resource('laundry_logs', App\Http\Controllers\Admin\LaundryLogController::class);
});

Route::post('/tenant/register', [App\Http\Controllers\Admin\TenantController::class, 'register'])->name('tenant.register');

// Landlord routes
Route::prefix('landlord')->name('landlord.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Landlord\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laundry-records', [App\Http\Controllers\Landlord\LaundryRecordController::class, 'index'])->name('laundry_records');
    Route::get('/payment-records', [App\Http\Controllers\Landlord\PaymentRecordController::class, 'index'])->name('payment_records');
    Route::resource('laundry-records', App\Http\Controllers\Landlord\LaundryRecordController::class);
    Route::resource('payment-records', App\Http\Controllers\Landlord\PaymentRecordController::class);
    // Add more landlord-specific routes here
});

// Worker routes
Route::prefix('worker')->name('worker.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Worker\DashboardController::class, 'index'])->name('dashboard');
    // Add more worker-specific routes here
});

// Client routes
Route::prefix('client')->name('client.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    // Add more client-specific routes here
});

require __DIR__.'/auth.php';
