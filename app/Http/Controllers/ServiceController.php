<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->with(['services' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->orderBy('order')
            ->get();

        return view('services', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with(['services' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->firstOrFail();

        return view('services.show', compact('category'));
    }
}
