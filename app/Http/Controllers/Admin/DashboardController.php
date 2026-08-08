<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'today' => Reservation::whereDate('reservation_date', $today)->count(),
            'week' => Reservation::whereBetween('reservation_date', [$today->copy()->startOfWeek(), $today->copy()->endOfWeek()])->count(),
            'month' => Reservation::whereMonth('reservation_date', $today->month)->whereYear('reservation_date', $today->year)->count(),
            'total' => Reservation::count(),
        ];

        $recentReservations = Reservation::with(['service', 'staffMember'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentReservations'));
    }
}
