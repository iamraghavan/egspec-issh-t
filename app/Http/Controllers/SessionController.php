<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

use App\Models\Speaker;

class SessionController extends Controller
{
    public function __construct()
    {
        // Middleware should be applied in routes, not directly in controllers.
    }

    // Token validation logic
    private function validateToken(Request $request, $token)
    {
        $sessionToken = $request->session()->get('admin_auth_token');

        if ($sessionToken !== $token) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }

        return null;
    }

    // Show all sessions
    public function index(Request $request, $token)
    {
        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        $sessions = Session::where('is_hide', 'show')->get();

        return view('admin.pages.sessions.index', compact('user', 'sessions', 'token'));
    }

    // Show session creation form
    public function create(Request $request, $token)
    {
        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        $session = new Session();

        return view('admin.pages.sessions.create', compact('user', 'session', 'token'));
    }

    // Store a new session
    public function store(Request $request)
    {
        $this->validateSessionData($request);

        $sessionData = $this->formatSessionData($request);

        Session::create($sessionData);

        return redirect()->route('sessions.index', ['token' => $request->session()->get('admin_auth_token')])
            ->with('success', 'Session created successfully.');
    }

    // Show session details
    public function show(Session $session, Request $request, $token)
    {
        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        return view('admin.pages.sessions.show', compact('user', 'session', 'token'));
    }

    // Show edit form
    public function edit(Session $session, Request $request, $token)
    {
        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        return view('admin.pages.sessions.edit', compact('user', 'session', 'token'));
    }

    // Update a session
    public function update(Request $request, $session_id)
    {
        Log::info('Update Request Data:', $request->all());

        $this->validateSessionData($request);

        $session = Session::find($session_id);

        if (!$session) {
            return redirect()->route('sessions.index')
                ->withErrors(['session' => 'Session not found.']);
        }

        $session->update($this->formatSessionData($request));

        return redirect()->route('sessions.index', ['token' => $request->session()->get('admin_auth_token')])
            ->with('success', 'Session updated successfully.');
    }

    // Delete a session
    public function destroy(Session $session)
    {
        // Update the 'is_hide' field instead of deleting the record
        $session->update(['is_hide' => 'block']);

        return redirect()->route('sessions.index', ['token' => request()->session()->get('admin_auth_token')])
            ->with('success', 'Session marked as hidden successfully.');
    }




    // Validate session data
    private function validateSessionData(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            'conducted_by' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:h:i A',
            'end_time' => 'required|date_format:h:i A|after:start_time',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'department' => 'required|string|max:255',
            'mode' => 'required|string',
            'meeting_url' => 'nullable|url',
            'price_type' => 'required|string',
            'amount' => 'nullable|numeric',
        ]);
    }

    // Format session data
    private function formatSessionData(Request $request)
    {
        return array_merge($request->all(), [
            'start_time' => Carbon::createFromFormat('h:i A', $request->input('start_time'))->format('H:i:s'),
            'end_time' => Carbon::createFromFormat('h:i A', $request->input('end_time'))->format('H:i:s'),
            'amount' => $request->input('amount', 0),
        ]);
    }

    public function speaker_index(Request $request, $token)
    {
        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        return view('admin.pages.speaker.index', compact('user', 'token'));
    }

    public function speaker_create(Request $request, $token)
    {

        if ($errorRedirect = $this->validateToken($request, $token)) {
            return $errorRedirect;
        }

        $user = Auth::guard('admin')->user();
        return view('admin.pages.speaker.create', compact('user', 'token'));
    }
}
