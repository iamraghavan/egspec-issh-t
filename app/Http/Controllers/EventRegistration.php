<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\EventRegistrationMod;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\Session as EventSession;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelPdf\Facades\Pdf;


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
            abort(403, 'Unauthorized action.');
        }

        $encryptedGoogleUid = null;
        if (Auth::check()) {
            $googleUid = Auth::user()->google_uid;
            $salt = config('app.salt');
            $encryptedGoogleUid = encrypt($googleUid . $salt);
        }

        $currentUrl = url()->current();
        $qrCode = QrCode::size(200)->generate($currentUrl);

        return view('pages.register', compact('events', 'selectedEvent', 'encryptedGoogleUid', 'qrCode'));
    }



    public function postRegister(Request $request)
    {
        try {
            Log::info('Request Data:', $request->all());

            // Determine if the event is free
            $isFreeEvent = $request->input('totalValue_rj') == '0.00';

            // Validation rules
            $validatedData = $request->validate([
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

            $summaryAmount = $request->input('totalValue_rj');
            $validatedData['summary_amount'] = $summaryAmount;

            Log::info('Validated Data:', $validatedData);

            // Generate event_registration_id and handle invoice_id
            $eventDate = date('dmy');
            $lastRegistration = EventRegistrationMod::where('event_id', $validatedData['event_id'])
                ->orderBy('id', 'desc')
                ->first();

            $incrementId = $lastRegistration ? (int)substr($lastRegistration->event_registration_id, -4) + 1 : 1;
            $incrementId = str_pad($incrementId, 4, '0', STR_PAD_LEFT);

            $eventRegistrationId = "EGSPEC/{$validatedData['event_id']}/{$eventDate}{$incrementId}";
            $invoiceId = $validatedData['invoice_id'] ?? strtoupper(uniqid('INV-', true));

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
            $registration->amount = $validatedData['amount'] ?? 0; // Default to 0 for free events
            $registration->summary_amount = $validatedData['summary_amount'];
            $registration->payment_id = $validatedData['payment_id'] ?? ''; // Default to empty string for free events
            $registration->order_id = $validatedData['order_id'] ?? ''; // Default to empty string for free events
            $registration->invoice_id = $invoiceId;
            $registration->registration_type = $validatedData['registration_type'];

            // Handle members field if the registration type is group
            if ($validatedData['registration_type'] === 'group') {
                $members = [];
                for ($i = 1; $i <= ($validatedData['number_of_members'] ?? 0); $i++) {
                    $members[] = $request->input('member_name_' . $i);
                }
                $registration->members = json_encode($members);
            } else {
                $registration->members = null; // Ensure members is null for individual registrations
            }

            $registration->save();
            $request->session()->put('event_registration_id', $registration->event_registration_id);

            return response()->json(['success' => true, 'message' => 'Registration successful']);
        } catch (\Exception $e) {
            Log::error('Error in registration process:', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'An error occurred during registration. Please try again later.'], 500);
        }
    }





    public function showDetailss($id)
    {
        $event = Session::findOrFail($id);
        return response()->json($event);
    }

    public function showDetails($id)
    {
        $event = Session::findOrFail($id);
        return view('partials.event-details', compact('event'));
    }


    public function thankYou(Request $request)
    {
        $eventRegistrationId = $request->session()->get('event_registration_id');
        $registration = EventRegistrationMod::where('event_registration_id', $eventRegistrationId)->first();
        $event = EventSession::where('id', $registration->event_id)->first();
        $sessionEvents = EventSession::where('id', $registration->event_id)->get();

        // Log data for debugging
        Log::info('Registration:', $registration->toArray());
        Log::info('Event:', $event->toArray());
        Log::info('Session Events:', $sessionEvents->toArray());

        return view('pages.thank_you', [
            'registration' => $registration,
            'event' => $event,
            'sessionEvents' => $sessionEvents
        ]);
    }


    public function getUserEventPage(Request $request)
    {
        // Extract the event registration ID from query parameters
        $eventRegistrationId = $request->query('id');

        if (!$eventRegistrationId) {
            // Handle the case where 'id' is not provided in the query string
            return redirect()->route('events.thankYou')->with('error', 'Event registration ID is missing.');
        }

        // Fetch registration details
        $registration = EventRegistrationMod::where('event_registration_id', $eventRegistrationId)->firstOrFail();

        // Fetch event details
        $event = Session::where('id', $registration->event_id)->firstOrFail();

        // Fetch session events
        $sessionEvents = Session::where('id', $registration->event_id)->get();

        return view('pages.get-reg-details', [
            'registration' => $registration,
            'event' => $event,
            'sessionEvents' => $sessionEvents
        ]);
    }
    public function downloadPdf($event_registration_id)
    {
        // Fetch registration data based on event_registration_id
        $registration = EventRegistrationMod::where('invoice_id', $event_registration_id)->firstOrFail();

        // Fetch session events based on the event_id from the registration
        $sessionEvents = Session::where('id', $registration->event_id)->get();

        // Generate the PDF directly from the Blade view
        $pdf = Pdf::view('pages.pdf-view', [
            'registration' => $registration,
            'sessionEvents' => $sessionEvents
        ]);

        // Define the path where the PDF will be saved
        $pdfPath = public_path('documents/registration-details.pdf');

        // Save the PDF to the specified path
        $pdf->save($pdfPath);

        // Return a response to indicate the PDF has been saved
        return response()->json([
            'message' => 'PDF has been saved successfully.',
            'path' => asset('documents/registration-details.pdf')
        ]);
    }
}
