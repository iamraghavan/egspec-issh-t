<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EventRegistrationMod;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Handle the dashboard view for the user.
     *
     * @param Request $request
     * @param string|null $google_uid
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard(Request $request, $google_uid = null)
    {
        try {
            $user = $this->getUser($google_uid);

            if ($user) {
                Auth::login($user);

                $this->logActivity($user->id, 'User accessed dashboard from IP: ' . $request->ip(), [
                    'email' => $user->email,
                    'ip_address' => $request->ip(),
                ]);

                $eventRegistrations = EventRegistrationMod::where('user_id', $user->google_id)->get();

                return view('user.dashboard', [
                    'user' => $user,
                    'eventRegistrations' => $eventRegistrations,
                ]);
            }

            return redirect()->route('home')->with('error', 'User not found.');
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Handle the activity logs view for the user.
     *
     * @param string|null $google_uid
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function activityLogs($google_uid = null)
    {
        try {
            $user = $this->getUser($google_uid);

            if ($user) {
                Auth::login($user);

                $activityLogs = ActivityLog::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(15); // Use pagination for performance

                return view('user.activity_logs', [
                    'activityLogs' => $activityLogs,
                    'user' => $user,
                ]);
            }

            return redirect()->route('home')->with('error', 'User not found.');
        } catch (\Exception $e) {
            Log::error('Activity Logs error: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Retrieve and return the user based on Google UID.
     *
     * @param string|null $google_uid
     * @return \App\Models\User|null
     */
    protected function getUser($google_uid)
    {
        return $google_uid ? User::where('google_id', $google_uid)->first() : Auth::user();
    }

    /**
     * Log an activity for a user.
     *
     * @param int $userId
     * @param string $description
     * @param array $properties
     * @return void
     */
    protected function logActivity($userId, $description, $properties = [])
    {
        ActivityLog::create([
            'user_id' => $userId,
            'description' => $description,
            'properties' => $properties,
        ]);
    }
}
