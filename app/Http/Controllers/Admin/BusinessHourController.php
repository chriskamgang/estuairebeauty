<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessHour;
use Illuminate\Http\Request;

class BusinessHourController extends Controller
{
    public function index()
    {
        $hours = BusinessHour::orderBy('day_of_week')->get();
        return view('admin.hours.index', compact('hours'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hours' => 'required|array',
            'hours.*.open_time' => 'nullable|date_format:H:i',
            'hours.*.close_time' => 'nullable|date_format:H:i',
            'hours.*.is_closed' => 'boolean',
        ]);

        foreach ($request->hours as $id => $data) {
            BusinessHour::where('id', $id)->update([
                'open_time' => $data['open_time'] ?? null,
                'close_time' => $data['close_time'] ?? null,
                'is_closed' => isset($data['is_closed']),
            ]);
        }

        session()->flash('success', 'Horaires mis à jour avec succès.');
        return back();
    }
}
