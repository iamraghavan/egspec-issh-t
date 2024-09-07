<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\EventRegistrationMod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\RegistrationMail;
use App\Mail\RegistrationNotificationToOrganizer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventRegistration extends Controller
{
    public function getRegister($id = null, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('google.login');
        }

        $events = Session::all();
        $selectedEvent = $id ? Session::findOrFail($id) : Session::first();
        $sessionToken = $request->query('session_token');

        if ($sessionToken && !hash_equals(csrf_token(), $sessionToken)) {
            return abort(403, 'Unauthorized action.');
        }

        $encryptedGoogleUid = Auth::check() ? encrypt(Auth::user()->google_uid . config('app.salt')) : null;
        $currentUrl = url()->current();
        $qrCode = QrCode::size(200)->generate($currentUrl);

        return view('pages.register', compact('events', 'selectedEvent', 'encryptedGoogleUid', 'qrCode'));
    }

    public function postRegister(Request $request)
    {
        try {
            Log::info('Request Data:', $request->all());

            $isFreeEvent = $request->input('totalValue_rj') == '0.00';

            $validatedData = $this->validateRegistrationData($request, $isFreeEvent);

            $eventRegistrationId = $this->generateEventRegistrationId($validatedData['event_id']);
            $invoiceId = $validatedData['invoice_id'] ?? strtoupper(uniqid('INV-', true));

            $registration = $this->createRegistration($validatedData, $eventRegistrationId, $invoiceId);

            $this->handleEmailAndPdf($registration);

            return response()->json(['success' => true, 'message' => 'Registration successful and email sent']);
        } catch (\Exception $e) {
            Log::error('Error in registration process:', ['exception' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'An error occurred during registration. Please try again later.'], 500);
        }
    }

    private function validateRegistrationData(Request $request, bool $isFreeEvent)
    {
        return $request->validate([
            'event_id' => 'required|integer',
            'google_uid' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'amount' => $isFreeEvent ? 'nullable|numeric' : 'required|numeric',
            'totalValue_rj' => 'required|numeric',
            'payment_id' => $isFreeEvent ? 'nullable|string|max:100' : 'required|string|max:100',
            'order_id' => $isFreeEvent ? 'nullable|string|max:100' : 'required|string|max:100',
            'invoice_id' => 'nullable|string|max:100',
            'registration_type' => 'required|in:individual,group',
            'number_of_members' => $request->input('registration_type') === 'group' ? 'nullable|integer|min:1|max:3' : 'nullable',
            'member_name_1' => $request->input('registration_type') === 'group' ? 'nullable|string|max:255' : 'nullable',
            'member_name_2' => $request->input('registration_type') === 'group' ? 'nullable|string|max:255' : 'nullable',
            'member_name_3' => $request->input('registration_type') === 'group' ? 'nullable|string|max:255' : 'nullable',
        ]);
    }

    private function generateEventRegistrationId(int $eventId)
    {
        $eventDate = date('dmy');
        $lastRegistration = EventRegistrationMod::where('event_id', $eventId)
            ->orderBy('id', 'desc')
            ->first();

        $incrementId = $lastRegistration ? (int)substr($lastRegistration->event_registration_id, -4) + 1 : 1;
        $incrementId = str_pad($incrementId, 4, '0', STR_PAD_LEFT);

        return "EGSPEC/{$eventId}/{$eventDate}{$incrementId}";
    }

    private function createRegistration(array $validatedData, string $eventRegistrationId, string $invoiceId)
    {
        $registration = new EventRegistrationMod();
        $registration->event_registration_id = $eventRegistrationId;
        $registration->event_id = $validatedData['event_id'];
        $registration->user_id = $validatedData['google_uid'];
        $registration->name = $validatedData['name'];
        $registration->email = $validatedData['email'];
        $registration->phone = $validatedData['phone'];
        $registration->address = $validatedData['address'];
        $registration->country = $validatedData['country'];
        $registration->state = $validatedData['state'];
        $registration->city = $validatedData['city'];
        $registration->pincode = $validatedData['pincode'];
        $registration->amount = $validatedData['amount'] ?? 0;
        $registration->summary_amount = $validatedData['totalValue_rj'];
        $registration->payment_id = $validatedData['payment_id'] ?? '';
        $registration->order_id = $validatedData['order_id'] ?? '';
        $registration->invoice_id = $invoiceId;
        $registration->registration_type = $validatedData['registration_type'];

        if ($validatedData['registration_type'] === 'group') {
            $members = array_filter([
                $validatedData['member_name_1'] ?? null,
                $validatedData['member_name_2'] ?? null,
                $validatedData['member_name_3'] ?? null
            ]);
            $registration->members = json_encode($members);
        } else {
            $registration->members = null;
        }

        $registration->save();
        request()->session()->put('event_registration_id', $registration->event_registration_id);

        return $registration;
    }

    private function handleEmailAndPdf(EventRegistrationMod $registration)
    {
        $event = Session::findOrFail($registration->event_id);
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

        Mail::to('raghavan@egspec.org')->send(new RegistrationNotificationToOrganizer($data));

        $pdf = Pdf::loadView('pages.pdf-view', [
            'registration' => $registration,
            'sessionEvents' => Session::where('id', $registration->event_id)->get()
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

        $fileName = 'e-ticket-' . str_replace('INV-', '', $registration->invoice_id) . '.pdf';
        $pdfPath = storage_path('app/public/' . $fileName);
        $pdf->save($pdfPath);

        if (file_exists($pdfPath)) {
            Mail::to($registration->email)->send(new RegistrationMail($data, $pdfPath, $event->title));
            unlink($pdfPath);
        } else {
            Log::error('PDF file was not generated:', ['pdf_path' => $pdfPath]);
            throw new \Exception('PDF file was not generated.');
        }
    }

    public function showDetailss($id)
    {
        return response()->json(Session::findOrFail($id));
    }

    public function showDetails($id)
    {
        return view('partials.event-details', ['event' => Session::findOrFail($id)]);
    }

    public function thankYou(Request $request)
    {
        $eventRegistrationId = $request->session()->get('event_registration_id');
        $registration = EventRegistrationMod::where('event_registration_id', $eventRegistrationId)->firstOrFail();
        $event = Session::findOrFail($registration->event_id);

        return view('pages.thank_you', [
            'registration' => $registration,
            'event' => $event,
            'sessionEvents' => Session::where('id', $registration->event_id)->get()
        ]);
    }

    public function getUserEventPage(Request $request)
    {
        $eventRegistrationId = $request->query('id');

        if (!$eventRegistrationId) {
            return redirect()->route('events.thankYou')->with('error', 'Event registration ID is missing.');
        }

        $registration = EventRegistrationMod::where('event_registration_id', $eventRegistrationId)->firstOrFail();
        $event = Session::findOrFail($registration->event_id);

        return view('pages.get-reg-details', [
            'registration' => $registration,
            'event' => $event,
            'sessionEvents' => Session::where('id', $registration->event_id)->get()
        ]);
    }

    public function downloadPdf($event_registration_id)
    {
        $registration = EventRegistrationMod::where('invoice_id', $event_registration_id)->firstOrFail();
        $sessionEvents = Session::where('id', $registration->event_id)->get();

        $fileName = 'e-ticket-' . str_replace('INV-', '', $registration->invoice_id) . '.pdf';

        $pdf = Pdf::loadView('pages.pdf-view', [
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

        return $pdf->download($fileName);
    }
}
