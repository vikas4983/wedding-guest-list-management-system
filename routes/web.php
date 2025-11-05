<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InvitationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    'role:admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('guests', GuestController::class);
    Route::resource('events', EventController::class);
    Route::resource('cards', CardController::class);
    Route::post('invitation', [InvitationController::class, 'invitation'])->name('send.invitation');
});
