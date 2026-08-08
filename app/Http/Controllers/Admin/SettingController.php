<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'salon_name', 'salon_description',
            'address', 'phone', 'email', 'whatsapp',
            'facebook', 'instagram',
            'google_maps_key',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        if ($request->hasFile('logo')) {
            $request->validate(['logo' => 'image|max:2048']);

            $oldLogo = Setting::get('logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('logo')->store('logo', 'public');
            Setting::set('logo', $path);
        }

        session()->flash('success', 'Paramètres mis à jour avec succès.');
        return back();
    }
}
