<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\StaffMember;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $categories = Category::where('is_active', true)
            ->with(['services' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->orderBy('order')
            ->get();
        $staffMembers = StaffMember::where('is_active', true)->orderBy('order')->get();
        $businessHours = BusinessHour::all()->keyBy('day_of_week');

        return view('reservation', compact('categories', 'staffMembers', 'businessHours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_member_id' => 'nullable|exists:staff_members,id',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_email' => 'nullable|email|max:255',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|string',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['status'] = 'pending';
        $reservation = Reservation::create($validated);

        return redirect()->route('reservation.confirmation', $reservation->id);
    }

    public function confirmation(Reservation $reservation)
    {
        $reservation->load(['service.category', 'staffMember']);
        return view('reservation-confirmation', compact('reservation'));
    }
}
