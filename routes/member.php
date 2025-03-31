<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\Auth\AuthController;
use App\Http\Controllers\Member\Auth\ForgetPasswordController;
use App\Http\Controllers\Member\Auth\PaymentController;
use App\Http\Controllers\Member\TaskController;


Route::controller(AuthController::class)->group(function(){
   Route::match(['get','post'],'member-register', 'memberRegister')->name('member-register');
   Route::post('member-login', 'memberLogin')->name('member-login');
   Route::get('member-verify/{email}', 'memberVerify')->name('member-verify');
   Route::get('member-detail/{id}', 'memberDetail')->name('member-detail');
   Route::post('validate-mobile', 'validateMobile')->name('validate-mobile');
   Route::post('validate-email', 'validateEmail')->name('validate-email');


});

Route::controller(ForgetPasswordController::class)->group(function(){
    Route::post('forget-password', 'forgetPassword')->name('forget-password');
    Route::get('resetPassword/{token}/{email}', 'showResetPasswordForm')->name('resetPassword');
    Route::post('resetPassword', 'submitResetPasswordForm')->name('postresetPassword');
 
 });

 Route::controller(PaymentController::class)->group(function(){
    Route::get('member-invoice/{invoiceNumber}', 'qrInvoice')->name('member-invoice');
 });

Route::prefix('member/')->name('member.')->middleware('auth')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::match(['get','post'],'profile', 'profile')->name('profile');

        Route::get('logout', 'logout')->name('logout');

    });

    Route::controller(PaymentController::class)->group(function(){
        Route::get('payment', 'payment')->name('payment');
        Route::post('donate', 'donate')->name('donate');
        Route::get('invoice/{invoiceNumber}', 'qrInvoice')->name('invoice');
     });

     Route::controller(TaskController::class)->group(function(){
      Route::get('task-list', 'taskList')->name('task-list');
      Route::get('task-update/{id}', 'taskUpdate')->name('task-update');
      Route::post('task-updates', 'taskUpdates')->name('task-updates');

   });
});