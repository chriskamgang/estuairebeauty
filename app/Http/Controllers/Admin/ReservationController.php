<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['service', 'staffMember']);

        if ($request->filled('date')) {
            $query->whereDate('reservation_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->latest('reservation_date')->paginate(15)->withQueryString();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $reservation->update(['status' => $request->status]);

        session()->flash('success', 'Statut de la réservation mis à jour.');
        return back();
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        session()->flash('success', 'Réservation supprimée.');
        return back();
    }
}
