<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $galleryImages = GalleryImage::where('is_active', true)->with('category')->orderBy('order')->get();

        return view('gallery', compact('categories', 'galleryImages'));
    }
}
