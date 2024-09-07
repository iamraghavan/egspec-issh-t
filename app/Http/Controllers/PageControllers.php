<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Cookie;



class PageControllers extends Controller
{
    public function home()
    {
        $partners = $this->getPartners();
        return view('pages.home', compact('partners'));
    }

    private function getPartners()
    {
        return [
            ['name' => 'Partner 1', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp'],
            ['name' => 'Partner 2', 'image' => 'https://production.egspec.org/assets/images/Accredited/award5.webp'],
            ['name' => 'Partner 3', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp'],
            ['name' => 'Partner 4', 'image' => 'https://production.egspec.org/assets/images/Accredited/award5.webp'],
            ['name' => 'Partner 5', 'image' => 'https://production.egspec.org/assets/images/Accredited/award2.webp']
        ];
    }

    public function eventSession(Request $request)
    {
        $query = $this->buildEventQuery($request);

        $events = $query->paginate(9); // Adjust the number per page as needed
        $filters = $this->getFilterOptions();

        return view('pages.get-events', array_merge($filters, ['events' => $events]));
    }

    private function buildEventQuery(Request $request)
    {
        $query = Session::query();

        $filters = ['venue', 'department', 'mode', 'price_type'];
        foreach ($filters as $filter) {
            if ($request->has($filter) && $request->input($filter)) {
                $query->where($filter, $request->input($filter));
            }
        }

        return $query;
    }

    private function getFilterOptions()
    {
        return [
            'venues' => Session::select('venue')->distinct()->pluck('venue'),
            'departments' => Session::select('department')->distinct()->pluck('department')
        ];
    }

    public function show($slug)
    {
        Log::info('Fetching event ID with slug: ' . $slug);

        $event = Session::where('slug', $slug)->first();

        if (!$event) {
            Log::error('Event not found for slug: ' . $slug);
            return abort(404, 'Sorry, the event could not be found.');
        }

        Log::info('Event found with ID: ' . $event->id);

        $eventDetails = Session::find($event->id);

        return view('pages.show-event-details', compact('eventDetails'));
    }

    public function acceptCookieConsent()
    {
        Cookie::queue('cookie_consent', true, 365); // Cookie valid for 365 days
        return redirect()->back();
    }

    public function legal_privacy_policy()
    {
        return view('pages.legal.privacy-policy');
    }

    public function legal_terms_and_services()
    {
        return view('pages.legal.terms-and-services');
    }
}
