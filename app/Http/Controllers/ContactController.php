<?php

namespace App\Http\Controllers;

use App\Models\BusinessHour;

class ContactController extends Controller
{
    public function index()
    {
        $businessHours = BusinessHour::orderBy('day_of_week')->get();
        return view('contact', compact('businessHours'));
    }
}
