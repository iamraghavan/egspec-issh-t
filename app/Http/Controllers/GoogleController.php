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
        $eventID = session('event_id');
        return redirect()->route('register.check', ['id' => $eventID]);
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
        $existingUser = User::where('email', $googleUser->email)->first();
        return $existingUser ? $this->updateUser($existingUser, $googleUser) : $this->createUser($googleUser);
    }

    private function updateUser($existingUser, $googleUser)
    {
        $existingUser->update([
            'name' => $googleUser->name,
            'profile_url' => $googleUser->avatar,
            'google_id' => $googleUser->id,
        ]);
        return $existingUser;
    }

    private function createUser($googleUser)
    {
        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'profile_url' => $googleUser->avatar,
            'password' => bcrypt($googleUser->id),
            'google_id' => $googleUser->id,
            'is_admin' => 0,
            'roles' => 'user',
        ]);
    }

    private function redirectAfterLogin()
    {
        $eventID = session('event_id');
        session()->forget('event_id');

        if ($eventID) {
            return redirect()->route('register.page', ['id' => $eventID]);
        }

        $intendedUrl = session('url.intended', '/');
        session()->forget('url.intended');
        return redirect($intendedUrl);
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
        $googleUid = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'];
        $profilePicture = $payload['picture'];

        $existingUser = User::where('email', $email)->first();
        return $existingUser ? $this->updateUser($existingUser, (object)[
            'id' => $googleUid,
            'name' => $name,
            'email' => $email,
            'avatar' => $profilePicture
        ]) : $this->createUser((object)[
            'id' => $googleUid,
            'name' => $name,
            'email' => $email,
            'avatar' => $profilePicture
        ]);
    }

    private function handleSuccessfulLoginResponse($user)
    {
        $eventID = session('event_id');
        session()->forget('event_id');

        if ($eventID) {
            return redirect()->route('register.page', ['id' => $eventID]);
        }

        return response()->json([
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
