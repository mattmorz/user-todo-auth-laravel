<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Mail;


// Home
Route::view('/','welcome');

// Auth
Route::get ('/register',[AuthController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[AuthController::class,'register']);
Route::get ('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);


// Auth-protected for create, store, edit, update
Route::middleware('auth')->group(function () {
    Route::get('todos/create',  [TodoController::class, 'create'])->name('todos.create');
    Route::post('todos',        [TodoController::class, 'store'])->name('todos.store');
    Route::get('todos/{id}/edit',[TodoController::class, 'edit'])->name('todos.edit');
    Route::put('todos/{id}',   [TodoController::class, 'update'])->name('todos.update');
    // Profile
    Route::get ('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::post('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

// Public: list & view
Route::get('todos',[TodoController::class, 'index'])->name('todos.index');
Route::get('todos/{id}',[TodoController::class, 'show'])->name('todos.show');

// Admin-only delete
Route::delete('todos/{id}',   [TodoController::class, 'destroy'])
     ->middleware(['auth', 'admin'])
     ->name('todos.destroy');
