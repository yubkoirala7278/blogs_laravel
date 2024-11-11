<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ReadmoreController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\TagController;
use Illuminate\Support\Facades\Route;

// ============frontend================
// home-page
Route::get('/',[HomeController::class,'index'])->name('frontend.index');
Route::get('/read-more/{post}',[ReadmoreController::class,'index'])->name('frontend.read-more');
Route::get('/category/{category}',[CategoryController::class,'index'])->name('frontend.category');
Route::get('/tag/{tag}',[TagController::class,'index'])->name('frontend.tag');
Route::get('/about-author',[HomeController::class,'aboutAuthor'])->name('frontend.about.author');
Route::get('/contact-us',[HomeController::class,'contactUs'])->name('frontend.contact');
Route::post('/contact-us',[HomeController::class,'contact'])->name('frontent.contact.us');
Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'register'])->name('frontend.register');
Route::post('/comment',[CommentController::class,'store'])->name('comments.store');
Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
Route::delete('/comment/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');
Route::delete('/comment/delete/reply/{id}/{commentId}',[CommentController::class,'deleteReply'])->name('comment.delete.reply');



// ============admin dashboard============
Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::prefix('admin')->group(function(){
        require __DIR__.'/admin.php';
    });
});

// ============Auth==========================
// login admin
Route::get('/login',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'adminLogin'])->name('admin.login');

// logout admin
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

// forget password
Route::get('/forget-password',[AuthController::class,'forgetPasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');

// reset password
Route::get('/reset-password',[AuthController::class,'resetPasswordLoad']);
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('resetPassword');

// ==========================================

Route::get('/latest-notification', function () {
    return auth()->user()->notifications()->latest()->first();
});

Route::get('/unread-notification-count', function () {
    return auth()->user()->unreadNotifications->count();
});