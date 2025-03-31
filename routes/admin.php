
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\College\CollegeController;
use App\Http\Controllers\Admin\Member\TaskController;
use App\Http\Controllers\Admin\Member\ProfileController;
use App\Http\Controllers\Admin\Setting\TrustSettingController;
use App\Http\Controllers\Admin\Question\QuestionBankController;
use App\Http\Controllers\Admin\Setting\ContactUsController;
use App\Http\Controllers\Admin\Setting\DonationController;

Route::match(['get','post'],'admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::prefix('admin/')->name('admin.')->middleware('admin')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('users', 'users')->name('users');
        Route::get('logout', 'logout')->name('logout');
        Route::post('filter-data','dataFilter')->name('filter-data');
    });

    Route::controller(StudentController::class)->group(function(){
        Route::get('enrool-student', 'enroolStudent')->name('enrool-student');
        Route::get('enrool-student-info/{id}', 'enroolStudentInfo')->name('enrool-student-info');
    });

    Route::controller(NotificationController::class)->group(function(){
        Route::get('notification', 'notification')->name('notification');
        Route::post('send-notification', 'sendNotification')->name('send-notification');
    });

    Route::controller(DocumentController::class)->group(function(){
        Route::get('document', 'document')->name('document');
    });

    Route::controller(CourseController::class)->group(function(){
        Route::get('courses', 'courses')->name('courses');
        Route::post('add-course', 'AddCourse')->name('add-course');
        Route::get('edit-course/{id}', 'editCourse')->name('edit-course');
        Route::post('update-course', 'updateCourse')->name('update-course');
        Route::post('course-update-status', 'updateStatus')->name('course-update-status');
    });

    Route::controller(CollegeController::class)->group(function(){
        Route::match(['get','post'],'college-add', 'collegeAdd')->name('college-add');
        Route::get('college-list', 'collegeList')->name('college-list');
        Route::get('college-edit/{id}', 'collegeEdit')->name('college-edit');
        Route::post('college-status-update', 'collegeUpdateStatus')->name('college-update-status');
        Route::post('college-update', 'collegeUpdate')->name('college-update');

    });

    Route::controller(TaskController::class)->group(function(){
        Route::get('task-list', 'taskList')->name('task-list');
        Route::post('task-add', 'taskAdd')->name('task-add');
        Route::get('task-report-check', 'checkReport')->name('task-report-check');
    });

    Route::prefix('member/')->name('member.')->controller(ProfileController::class)->group(function(){
        Route::get('indian-list', 'indianMemberList')->name('indian-list');
        Route::get('nri-list', 'nriMemberList')->name('nri-list');
        Route::get('member-info/{id}','memberInfo')->name('member-info');
    });

     Route::prefix('social-pages/')->name('social-pages.')->controller(TrustSettingController::class)->group(function(){
        Route::match(['get','post'],'privacy-policy', 'privacyPolicy')->name('privacy-policy');
        Route::match(['get','post'], 'term-condition', 'termCondition')->name('term-condition');
     });

    Route::controller(ContactUsController::class)->group(function(){
        Route::get('contact-us', 'ContactUs')->name('contact-us');
    });

    Route::controller(DonationController::class)->group(function(){
        Route::get('donation-report', 'donationReport')->name('donation-report');
        Route::post('donation-add', 'donationAdd')->name('donation-add');
    });

     
     Route::prefix('test-series/')->name('test-series.')->controller(QuestionBankController::class)->group(function(){
        Route::get('list', 'list')->name('list');
        Route::post('add', 'add')->name('add');
     });

     Route::prefix('question/')->name('question.')->controller(QuestionBankController::class)->group(function(){
        Route::get('list', 'questionList')->name('list');
        Route::post('add', 'questionAdd')->name('add');
     });


});

