
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\DonateController;

use App\Http\Controllers\Student\EmailVerificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/admin.php';
require __DIR__ . '/student.php';
require __DIR__ . '/member.php';

Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    
    dd('clear');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test-raw-mail', function () {
    $toEmail = 'recipient-email@example.com';
    $subject = 'Test Email';
    $body = 'This is a test email sent using raw content to check if email functionality is working.';

    Mail::raw($body, function ($message) use ($toEmail, $subject) {
        $message->to($toEmail)
                ->subject($subject);
    });

    return 'Raw test email sent successfully!';
});


Route::get('email-verify', function () {
    return view('mail-template.verification');
});

Route::get('donate-pdf', function () {
    return view('pdf.member.donation-invoice');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('contact-us', 'contactUs')->name('contact-us');
    Route::get('get-city/{id}', 'getCity')->name('get.city');
   
    Route::get('contact', 'contact')->name('contact');
    Route::get('about', 'about')->name('about');
    Route::get('our-teacher', 'ourTeacher')->name('our-teacher');
    Route::get('blog', 'blog')->name('blog');
    Route::get('student-review', 'studentReview')->name('student-review');
    Route::get('faq', 'faq')->name('faq');
    Route::get('our-college', 'ourCollege')->name('our-college');
    Route::get('member', 'member')->name('member');
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('term-condition', 'termCondition')->name('term-condition');
    Route::get('step-for-enroll', 'stepForEnroll')->name('step-for-enroll');
    Route::get('become-a-member', 'becomeMember')->name('become-a-member');
    Route::get('donate-now', 'donateNow')->name('donate-now');
    Route::get('donate-amount-details', 'donatdonateAmountDetailseNow')->name('donate-amount-details');
    Route::post('subscriber', 'subscriber')->name('subscriber');
    Route::post('sumit-contact-form', 'submitContactForm')->name('sumit-contact-form');




});

Route::controller(CourseController::class)->group(function(){
    Route::get('course', 'course')->name('course');
    Route::get('course-detail/{slug}', 'courseDetail')->name('course-detail');

});

Route::controller(EmailVerificationController::class)->group(function(){
    Route::post('send-otp','sendOtp')->name('send.otp');
    Route::post('verify-otp', 'verifyOtp')->name('verify.otp');
});

Route::controller(DonateController::class)->group(function(){
    Route::post('donate-now-amount','donateNowAmount')->name('donate-now-amount');
    Route::get('doner-receipt-detail/{invoiceNumber}','donerReceiptDetail')->name('doner-receipt-detail');

});




