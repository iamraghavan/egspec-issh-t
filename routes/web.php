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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cookie;


$ip = session('ip');
$country = session('country');
$region = session('region');

// web.php
use App\Models\EventRegistrationMod;
use App\Models\Session;

Route::get('/test-pdf', function () {
    // Sample event registration ID for demonstration
    $event_registration_id = 'INV-66D2FBBCE59368.40160966';

    // Fetch registration details based on the invoice ID
    $registration = EventRegistrationMod::where('invoice_id', $event_registration_id)->firstOrFail();

    // Fetch session events based on the event_id from the registration
    $sessionEvents = Session::where('id', $registration->event_id)->get();

    // Pass the data to the view
    return view('pages.pdf-view', compact('registration', 'sessionEvents'));
});

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;


Route::get('/test-mail', function () {
    $event_registration_id = 'INV-66D2FBBCE59368.40160966';

    // Fetch registration details based on the invoice ID
    $registration = EventRegistrationMod::where('invoice_id', $event_registration_id)->firstOrFail();

    // Fetch session events based on the event_id from the registration
    $sessionEvents = Session::where('id', $registration->event_id)->get();

    // Assuming you want to use the first session event as the event details
    $event = $sessionEvents->first();

    // Prepare the data for the email
    $data = [
        'name' => $registration->name,
        'eventName' => $event->title,
        'eventDate' => $event->date,
        'eventRegistrationId' => $registration->event_registration_id,
        'invoiceId' => $registration->invoice_id,
        'email' => $registration->email,
        'phone' => $registration->phone,
        'address' => $registration->address,
        'city' => $registration->city,
        'state' => $registration->state,
        'country' => $registration->country,
        'pincode' => $registration->pincode,
        'amountPaid' => $registration->amount,
        'paymentId' => $registration->payment_id,
        'orderId' => $registration->order_id
    ];

    // Generate the PDF
    $pdf = PDF::loadView('pages.pdf-view', [
        'registration' => $registration,
        'sessionEvents' => $sessionEvents
    ])->setOptions([
        'isHtml5ParserEnabled' => true,
        'isPhpEnabled' => true,
        'isRemoteEnabled' => true,
        'defaultPaperSize' => 'letter',
        'marginTop'    => 0,
        'marginBottom' => 0,
        'marginLeft'   => 0,
        'marginRight'  => 0
    ]);

    // Define the filename for the PDF
    $fileName = 'e-ticket-' . str_replace('INV-', '', $registration->invoice_id) . '.pdf';

    // Save the PDF to a temporary file
    $pdfPath = storage_path('app/public/' . $fileName);
    $pdf->save($pdfPath);

    // Debugging: Check if the PDF file was generated and saved
    if (!file_exists($pdfPath)) {
        return 'PDF file was not generated. Check the path and permissions.';
    }

    // Send the email with the PDF attachment
    try {
        Mail::to('raghavanofficials@gmail.com')->send(new RegistrationMail($data, $pdfPath, $event->title));
    } catch (\Exception $e) {
        return 'Failed to send email: ' . $e->getMessage();
    }

    // Debugging: Check if file is attached and optionally delete the PDF
    if (file_exists($pdfPath)) {
        unlink($pdfPath); // Optionally delete the PDF after sending the email
    } else {
        return 'PDF file was not found after sending the email.';
    }

    return 'Email sent successfully!';
});


Route::get('auth/google', [GoogleController::class, 'redirectToGooglePopup'])->name('google.popup.login');
// Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallbackPopup']);

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

Route::get('/legal/privacy-policy', [PageControllers::class, 'legal_privacy_policy'])->name('privacy-policy');
Route::get('/legal/terms-and-services', [PageControllers::class, 'legal_terms_and_services'])->name('terms-and-services');

// routes/web.php

Route::post('/accept-cookie-consent', function () {
    Cookie::queue('cookie_consent', true, 365);
    return redirect()->back();
})->name('acceptCookieConsent');

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

    Route::get('/api/daily-registrations', [AdminController::class, 'getDailyRegistrations']);
    Route::get('/api/revenue-by-event', [AdminController::class, 'getRevenueByEvent']);
    Route::get('/api/registration-trends', [AdminController::class, 'getRegistrationTrends']);
    Route::get('/api/geographical-distribution', [AdminController::class, 'getGeographicalDistribution']);


    Route::prefix('egspec/e/portal/sessions')->group(function () {
        Route::get('/{token}', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/create/{token}', [SessionController::class, 'create'])->name('sessions.create');
        Route::post('/', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('/{session}/{token}', [SessionController::class, 'show'])->name('sessions.show');
        Route::get('/{session}/edit/{token}', [SessionController::class, 'edit'])->name('sessions.edit');
        Route::put('/update/{session_id}', [SessionController::class, 'update'])->name('sessions.update');
        Route::delete('/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');
    });

    Route::prefix('egspec/e/portal/speaker')->group(function () {
        Route::get('/profile/{token}', [SessionController::class, 'speaker_index'])->name('speaker.index');
        Route::get('/create/profile/{token}', [SessionController::class, 'speaker_create'])->name('speaker.create');
        Route::post('/create/profile/c/{token}', [SessionController::class, 'speaker_store'])->name('speaker.store');
    });

    Route::post('/admin/logout/session', [AdminController::class, 'logout'])->name('admin.logout');
});
