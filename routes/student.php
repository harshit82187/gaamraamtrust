
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Student\EmailVerificationController;
use App\Http\Controllers\Student\Test\TestSeriesController;


Route::match(['get', 'post'], 'student/login', [AuthController::class, 'login'])->name('student.login');
Route::get('send-wa', [AuthController::class, 'sendWa'])->name('send-wa');


Route::prefix('student/')->name('student.')->middleware('student')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('notification', 'notification')->name('notification');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile-update', 'profileUpdate')->name('profile-update');
        Route::get('logout', 'logout')->name('logout');
        Route::post('autoLogout', 'autoLogout')->name('autoLogout');

    });

    Route::controller(DocumentController::class)->group(function(){
        Route::get('document-list', 'document')->name('document-list');
        Route::post('document-upload', 'documentUpload')->name('document-upload');
    });

    Route::controller(EmailVerificationController::class)->group(function(){
        Route::post('send-otp','sendOtp')->name('send.otp');
        Route::post('verify-otp', 'verifyOtp')->name('verify.otp');
    });

    Route::controller(TestSeriesController::class)->group(function(){
        Route::get('test-series-list','list')->name('test-series-list');
        Route::get('get-test-series/{slug}','attemptSeriesTest')->name('get-test-series');
        Route::post('save-answer', 'saveAnswer')->name('save-answer');
        Route::get('test-result/{testSeriesId}','testResult')->name('test-result');


    });

    

    
});

