<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Google_Client;

class GoogleController extends Controller
{
    public function checkAuth(Request $request)
    {
        $this->validateEventId($request);
        session(['event_id' => $request->event_id]);

        return Auth::check() ? $this->redirectToRegistration() : $this->redirectToGoogleWithIntendedUrl();
    }

    private function validateEventId(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
        ]);
    }

    private function redirectToRegistration()
    {
        return redirect()->route('register.check', ['id' => session('event_id')]);
    }

    public function redirectToGooglePopup()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google authentication callback
    public function handleGoogleCallbackPopup()
    {
        try {
            $user = Socialite::driver('google')->user();
            $authUser = $this->findOrCreateUser($user);
            Auth::login($authUser);
            session(['google_uid' => $authUser->google_id]);

            return response()->json([
                'success' => true,
                'redirect' => route('home') // Adjust this as needed
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication failed. Please try again.'
            ]);
        }
    }

    private function redirectToGoogleWithIntendedUrl()
    {
        session(['url.intended' => url()->previous()]);
        return $this->redirectToGoogle();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $authUser = $this->findOrCreateUser($user);
            Auth::login($authUser);
            session(['google_uid' => $authUser->google_id]);

            return $this->redirectAfterLogin();
        } catch (\Exception $e) {
            return $this->handleAuthenticationError($e);
        }
    }

    private function findOrCreateUser($googleUser)
    {
        return User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'profile_url' => $googleUser->avatar,
                'google_id' => $googleUser->id,
                'password' => bcrypt($googleUser->id), // Consider using a more secure approach
                'is_admin' => 0,
                'roles' => 'user',
            ]
        );
    }

    private function redirectAfterLogin()
    {
        $eventID = session('event_id');
        session()->forget('event_id');

        return $eventID
            ? redirect()->route('register.page', ['id' => $eventID])
            : redirect(session('url.intended', '/'));
    }

    private function handleAuthenticationError(\Exception $e)
    {
        Log::error('Google Authentication Failed: ' . $e->getMessage());
        return redirect()->route('index')->with('error', 'Failed to authenticate with Google. Please try again later.');
    }

    public function handleGoogleOneTapCallback(Request $request)
    {
        try {
            $payload = $this->verifyGoogleOneTap($request);

            if ($payload) {
                $user = $this->findOrCreateUserFromPayload($payload);
                Auth::login($user);
                session(['google_uid' => $user->google_id]);

                return $this->handleSuccessfulLoginResponse($user);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid ID token.'], 400);
            }
        } catch (\Exception $e) {
            return $this->handleOneTapError($e);
        }
    }

    private function verifyGoogleOneTap(Request $request)
    {
        $credential = $request->input('credential');

        if (!$credential) {
            throw new \Exception('No credential provided.');
        }

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        return $client->verifyIdToken($credential);
    }

    private function findOrCreateUserFromPayload($payload)
    {
        return User::updateOrCreate(
            ['email' => $payload['email']],
            [
                'name' => $payload['name'],
                'profile_url' => $payload['picture'],
                'google_id' => $payload['sub'],
                'password' => bcrypt($payload['sub']), // Consider using a more secure approach
                'is_admin' => 0,
                'roles' => 'user',
            ]
        );
    }

    private function handleSuccessfulLoginResponse($user)
    {
        $eventID = session('event_id');
        session()->forget('event_id');

        return $eventID
            ? redirect()->route('register.page', ['id' => $eventID])
            : response()->json([
                'success' => true,
                'google_uid' => $user->google_id,
                'redirect' => route('user.dashboard', $user->google_id),
            ]);
    }

    private function handleOneTapError(\Exception $e)
    {
        Log::error('Google One Tap Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Login failed. Please try again later.'], 500);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $this->clearSessionAndCookies($request);
            Auth::logout();
        }

        return redirect('/');
    }

    private function clearSessionAndCookies(Request $request)
    {
        $request->session()->flush();

        $cookieNames = ['laravel_session', 'XSRF-TOKEN'];
        foreach ($cookieNames as $cookieName) {
            $cookieJar = app('cookie')->getQueuedCookies();
            unset($cookieJar[$cookieName]);
        }
    }
}
