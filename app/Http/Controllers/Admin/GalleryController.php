<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::with('category')->orderBy('order')->paginate(20);
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:4096',
            'title' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
        ]);

        $isActive = $request->has('is_active');

        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'public');
            GalleryImage::create([
                'title' => $request->title,
                'image_path' => $path,
                'category_id' => $request->category_id,
                'is_active' => $isActive,
            ]);
        }

        session()->flash('success', 'Image(s) ajoutée(s) avec succès.');
        return back();
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $gallery->update($validated);

        session()->flash('success', 'Image mise à jour.');
        return back();
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        session()->flash('success', 'Image supprimée.');
        return back();
    }
}
