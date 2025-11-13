<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FilterController;
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
    Route::resource('contacts', ContactController::class);
    Route::get('export-guests', [ContactController::class, 'export'])->name('export.guests');
    Route::post('invitation', [InvitationController::class, 'invitation'])->name('send.invitation');
    Route::get('invited', [InvitationController::class, 'invited'])->name('invited');
    Route::get('filter-keyword', [FilterController::class, 'filter'])->name('filter.keyword');
});
