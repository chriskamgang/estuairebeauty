<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = StaffMember::orderBy('order')->paginate(15);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        return view('admin.staff.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }

        unset($validated['services']);
        $member = StaffMember::create($validated);

        if ($request->has('services')) {
            $member->services()->sync($request->services);
        }

        session()->flash('success', 'Membre ajouté avec succès.');
        return redirect()->route('admin.staff.index');
    }

    public function edit(StaffMember $staff)
    {
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $assignedServices = $staff->services->pluck('id')->toArray();
        return view('admin.staff.edit', compact('staff', 'services', 'assignedServices'));
    }

    public function update(Request $request, StaffMember $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            if ($staff->photo) {
                Storage::disk('public')->delete($staff->photo);
            }
            $validated['photo'] = $request->file('photo')->store('staff', 'public');
        }

        unset($validated['services']);
        $staff->update($validated);
        $staff->services()->sync($request->services ?? []);

        session()->flash('success', 'Membre mis à jour avec succès.');
        return redirect()->route('admin.staff.index');
    }

    public function destroy(StaffMember $staff)
    {
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }

        $staff->services()->detach();
        $staff->delete();

        session()->flash('success', 'Membre supprimé.');
        return redirect()->route('admin.staff.index');
    }
}
