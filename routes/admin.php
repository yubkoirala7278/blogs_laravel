<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// ===========dashboard=============
Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
// ================================

// ========posts==================
Route::resources([
    'posts'=>PostController::class,
    'category'=>CategoryController::class,
    'tag'=>TagController::class
]);

Route::get('/users',[UserController::class,'index'])->name('admin.users');
Route::post('/users',[UserController::class,'store'])->name('admin.users.store');
// ===============================

Route::get('/notifications',[NotificationController::class,'index'])->name('admin.notification');
Route::post('/notifications/{id}/mark-as-read',[NotificationController::class,'markAsRead'])->name('admin.notification.markAsRead');