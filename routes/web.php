<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    
    /** @var \App\Models\User $user */ 

    $user = Auth::user();

    $roleValue = $user->roleString();

    return match ($roleValue) {
        'admin' => to_route('admin.dashboard'),
        'other' => to_route('other.dashboard'),
        default => to_route('user.dashboard'),
    };
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';