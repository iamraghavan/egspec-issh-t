<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\VerifyController;
use App\Http\Controllers\EventRegistration;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PageControllers;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminAuth;


$ip = session('ip');
$country = session('country');
$region = session('region');



Route::post('/apis/credentials/oauthclient/callback', [GoogleController::class, 'handleGoogleOneTapCallback'])->name('google.one-tap-callback');
Route::any('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');

Route::get('/u/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');


Route::get('/events/sessions/thank-you', [EventRegistration::class, 'thankYou'])->name('thankYou');
// Route::get('/events/thank-you', [EventRegistration::class, 'thankYou'])->name('events.thankYou');
Route::get('/events/get-details/u/{id?}', [EventRegistration::class, 'getUserEventPage'])->name('events.get-reg-page');

Route::get('/events/sessions/register/{id?}', [EventRegistration::class, 'getRegister'])->name('register.page');

Route::get('/events/sessions/register/download-pdf/{event_registration_id}', [EventRegistration::class, 'downloadPdf'])->name('pdf.download');

Route::post('/events/sessions/register', [EventRegistration::class, 'postRegister'])->name('register.post');

Route::get('/events/{id}', [EventRegistration::class, 'showDetailss']);

Route::get('/', [PageControllers::class, 'home'])->name('index');
Route::get('/events/session', [PageControllers::class, 'EventSession'])->name('events.index');
Route::get('/events/sessions', [PageControllers::class, 'ab'])->name('events.show');
Route::get('/events/sessions/{slug}', [PageControllers::class, 'show'])->name('events.show');


use App\Http\Controllers\PaymentController;


Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'makePayment'])->name('payment.make');
Route::post('/payment/success', [PaymentController::class, 'handlePayment'])->name('payment.handle');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
Route::post('/create-razorpay-order', [PaymentController::class, 'createOrder']);
Route::post('/store-payment-details', [PaymentController::class, 'storePaymentDetails'])->name('store.payment.details');

// Admin routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/auth/admin/login', [VerifyController::class, 'login'])->name('auth.admin-login');
});
Route::middleware('auth')->group(function () {
    Route::get('/u/dashboard/{google_uid}', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/u/dashboard/activity-logs/{google_uid}', [UserController::class, 'activityLogs'])->name('user.activityLogs');
    Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/egspec/e/portal/{token}', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('egspec/e/portal/sessions')->group(function () {
        Route::get('/{token}', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/create/{token}', [SessionController::class, 'create'])->name('sessions.create');
        Route::post('/', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('/{session}/{token}', [SessionController::class, 'show'])->name('sessions.show');
        Route::get('/{session}/edit/{token}', [SessionController::class, 'edit'])->name('sessions.edit');
        Route::put('/update/{session_id}', [SessionController::class, 'update'])->name('sessions.update');
        Route::delete('/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');
    });

    Route::post('/admin/logout/session', [AdminController::class, 'logout'])->name('admin.logout');
});
