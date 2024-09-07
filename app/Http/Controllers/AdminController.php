<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventRegistrationMod;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminController extends Controller
{
    public function dashboard(Request $request, $token)
    {

        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        // Fetch weekly sales
        $weeklySales = EventRegistrationMod::sum('summary_amount');


        // Fetch weekly orders
        $weeklyOrders = EventRegistrationMod::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        // Fetch total visitors
        $totalVisitors = EventRegistrationMod::count();


        // Assume we have previous week's data for comparison
        $previousStartOfWeek = Carbon::now()->subWeek()->startOfWeek()->toDateString();
        $previousEndOfWeek = Carbon::now()->subWeek()->endOfWeek()->toDateString();

        // Calculate percentage changes
        $previousWeeklySales = EventRegistrationMod::whereBetween('created_at', [$previousStartOfWeek, $previousEndOfWeek])
            ->sum('amount');
        $previousWeeklyOrders = EventRegistrationMod::whereBetween('created_at', [$previousStartOfWeek, $previousEndOfWeek])
            ->count();
        $previousTotalVisitors = EventRegistrationMod::whereBetween('created_at', [$previousStartOfWeek, $previousEndOfWeek])
            ->distinct('user_id')
            ->count('user_id');

        $salesIncrease = $previousWeeklySales ? (($weeklySales - $previousWeeklySales) / $previousWeeklySales) * 100 : 0;
        $ordersDecrease = $previousWeeklyOrders ? (($previousWeeklyOrders - $weeklyOrders) / $previousWeeklyOrders) * 100 : 0;
        $visitorsIncrease = $previousTotalVisitors ? (($totalVisitors - $previousTotalVisitors) / $previousTotalVisitors) * 100 : 0;


        $decodedToken = base64_decode($token);

        $sessionToken = $request->session()->get('admin_auth_token');

        $token = $request->session()->get('admin_auth_token');

        // Compare the decoded token with the session token
        if ($sessionToken !== $token) {
            // Handle invalid token scenario
            return redirect()->route('login')->withErrors(['token' => 'Invalid session token.']);
        }



        if (Auth::guard('admin')->check()) {

            $user = Auth::guard('admin')->user();


            return view('admin.pages.index', [
                'user' => $user,
                'weeklySales' => number_format($weeklySales, 2),
                'weeklyOrders' => number_format($weeklyOrders),
                'totalVisitors' => number_format($totalVisitors),
                'salesIncrease' => number_format($salesIncrease, 2),
                'ordersDecrease' => number_format($ordersDecrease, 2),
                'visitorsIncrease' => number_format($visitorsIncrease, 2),
            ], compact('token'));
        }

        // Redirect to login if not authenticated
        return redirect()->route('login');
    }

    public function showLoginForm()
    {

        if (Auth::guard('admin')->check()) {

            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }





    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function getDailyRegistrations()
    {
        // Get the start and end of the current week
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        // Fetch daily user registrations data
        $registrations = EventRegistrationMod::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $registrations->pluck('date');
        $counts = $registrations->pluck('count');

        return response()->json([
            'xAxis' => $dates->toArray(),
            'series' => $counts->toArray()
        ]);
    }

    public function getRevenueByEvent()
    {
        // Example revenue data by event
        $revenueData = EventRegistrationMod::selectRaw('event_id, SUM(summary_amount) as revenue')
            ->groupBy('event_id')
            ->get();

        $events = $revenueData->map(function ($item) {
            return 'Event ' . $item->event_id; // Replace with actual event names if available
        });
        $revenues = $revenueData->pluck('revenue');

        return response()->json([
            'xAxis' => $events->toArray(),
            'series' => $revenues->toArray()
        ]);
    }

    public function getRegistrationTrends()
    {
        // Fetch monthly registration data
        $trendData = EventRegistrationMod::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $trendData->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('M'); // Convert month number to month abbreviation
        });
        $counts = $trendData->pluck('count');

        return response()->json([
            'xAxis' => $months->toArray(),
            'series' => $counts->toArray()
        ]);
    }

    public function getGeographicalDistribution()
    {
        // Example geographical distribution data
        $geoData = EventRegistrationMod::selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
            ->get();

        $countries = $geoData->pluck('country');
        $counts = $geoData->pluck('count');

        return response()->json([
            'series' => $countries->map(function ($country, $index) use ($counts) {
                return ['name' => $country, 'value' => $counts[$index]];
            })->toArray()
        ]);
    }
}
