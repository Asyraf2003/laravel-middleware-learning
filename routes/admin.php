<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;

Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/users', [UserAdminController::class, 'index'])
    ->middleware('can:viewAny,App\Models\User')
    ->name('users.index');

Route::get('/users/{user}/edit', [UserAdminController::class, 'edit'])
    ->middleware('can:update,user')
    ->name('users.edit');

Route::patch('/users/{user}', [UserAdminController::class, 'update'])
    ->middleware('can:update,user')
    ->name('users.update');

Route::patch('/users/{user}/role', [UserAdminController::class, 'changeRole'])
    ->middleware('can:changeRole,user')
    ->name('users.changeRole');

Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])
    ->middleware('can:delete,user')
    ->name('users.destroy');