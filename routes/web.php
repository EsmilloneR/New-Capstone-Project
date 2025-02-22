<?php

use App\Http\Controllers\admin\BillingController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::prefix('admin')->middleware(['auth', 'role:super-admin,admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Users
    Route::get('/users/guests', [UserController::class, 'guests'])->name('admin.users.guests.index');
    Route::get('/users/admins', [UserController::class, 'admins'])->name('admin.users.admins.index');

    Route::get('/user/{id}/show', [UserController::class, 'showUser'])->name('admin.users.show');
    Route::get('/user/{id}/edit', [UserController::class, 'editUser'])->name('admin.users.edit');
    Route::delete('/user/{id}/delete', [UserController::class, 'deleteUser'])->name('admin.users.delete');
    Route::put('/user/{id}/update', [UserController::class, 'updateUser'])->name('admin.users.update');


    // Settings
    Route::get('/settings', [SettingsController::class, 'settings'])->name('admin.settings.index');
    Route::put('/settings/{id}/update', [SettingsController::class, 'update'])->name('admin.settings.update');


    // Rooms
    Route::get('/rooms/add', [RoomController::class, 'add'])->name('admin.rooms.add');
    Route::get('/rooms/current', [RoomController::class, 'current'])->name('admin.rooms.current');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'delete'])->name('admin.rooms.destroy');
    Route::post('rooms/', [RoomController::class, 'store'])->name('admin.rooms.store');


    // Billing
    Route::get('/billing', [BillingController::class, 'reservation'])->name('admin.billing.reservations');
    Route::put('/admin/billing/accept/{id}', [BillingController::class, 'accept'])->name('admin.billing.accept');
    Route::put('/admin/billing/cancel/{id}', [BillingController::class, 'cancel'])->name('admin.billing.cancel');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/booking', [ReservationController::class, 'index'])->name('booking.index');
    Route::post('/booking/confirm', [ReservationController::class, 'confirm'])->name('booking.confirm');
    Route::post('/booking/store', [ReservationController::class, 'store'])->name('booking.store');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
});

require __DIR__ . '/auth.php';
