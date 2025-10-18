<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('kanban')->group(function () {
        Route::get('/', [App\Http\Controllers\KanbanController::class, 'index'])->name('kanban.index');
        Route::get('/create', [App\Http\Controllers\KanbanController::class, 'create'])->name('kanban.create');
        Route::post('/store', [App\Http\Controllers\KanbanController::class, 'store'])->name('kanban.store');
        Route::get('/{id}', [App\Http\Controllers\KanbanController::class, 'show'])->name('kanban.show');
        Route::get('/{id}/edit', [App\Http\Controllers\KanbanController::class, 'edit'])->name('kanban.edit');
        Route::put('/update-position', [App\Http\Controllers\KanbanController::class, 'updatePosition'])->name('kanban.updatePosition');
        Route::put('/{id}', [App\Http\Controllers\KanbanController::class, 'update'])->name('kanban.update');
        Route::delete('/{id}', [App\Http\Controllers\KanbanController::class, 'destroy'])->name('kanban.destroy');
    });

    Route::prefix('category')->group(function () {
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
