<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryImage;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->with('category')->orderBy('order')->limit(8)->get();
        $galleryImages = GalleryImage::where('is_active', true)->orderBy('order')->limit(6)->get();

        return view('welcome', compact('categories', 'services', 'galleryImages'));
    }
}
