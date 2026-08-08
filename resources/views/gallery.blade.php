@extends('layouts.app')

@section('title', 'Galerie')

@section('content')
<!-- Hero -->
<section class="relative py-32 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
    <div class="absolute top-10 right-10 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <span class="inline-block px-6 py-2 border border-gold/40 rounded-full text-gold text-sm font-montserrat tracking-[0.3em] uppercase mb-6">Portfolio</span>
        <h1 class="font-playfair text-5xl md:text-6xl font-bold text-white mb-4">Notre Galerie</h1>
        <p class="text-gray-300 text-lg">Decouvrez nos plus belles realisations.</p>
    </div>
</section>

<!-- Gallery -->
<section class="py-20 bg-cream" x-data="{ filter: 'all', lightbox: false, currentImage: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button @click="filter = 'all'" :class="filter === 'all' ? 'gold-gradient text-white shadow-lg shadow-gold/20' : 'bg-white text-gray-700 hover:border-gold'" class="px-6 py-2.5 rounded-full font-montserrat text-sm font-semibold tracking-wide border border-gray-200 transition-all duration-300">
                Toutes
            </button>
            @foreach($categories as $category)
            <button @click="filter = '{{ $category->slug }}'" :class="filter === '{{ $category->slug }}' ? 'gold-gradient text-white shadow-lg shadow-gold/20' : 'bg-white text-gray-700 hover:border-gold'" class="px-6 py-2.5 rounded-full font-montserrat text-sm font-semibold tracking-wide border border-gray-200 transition-all duration-300">
                {{ $category->name }}
            </button>
            @endforeach
        </div>

        @if($galleryImages->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($galleryImages as $image)
            <div x-show="filter === 'all' || filter === '{{ $image->category->slug ?? '' }}'"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="group relative overflow-hidden rounded-2xl aspect-square cursor-pointer"
                 @click="lightbox = true; currentImage = '{{ asset('storage/' . $image->image_path) }}'">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title ?? '' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-5">
                    <div>
                        <h4 class="text-white font-playfair font-semibold">{{ $image->title ?? '' }}</h4>
                        @if($image->category)
                        <span class="text-gold text-sm">{{ $image->category->name }}</span>
                        @endif
                    </div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="w-12 h-12 rounded-full bg-gold/80 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <svg class="w-24 h-24 text-gold/20 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
            <h3 class="font-playfair text-2xl text-gray-400">La galerie sera bientot disponible</h3>
            <p class="text-gray-400 mt-2">Nos plus belles realisations arrivent prochainement.</p>
        </div>
        @endif

        <!-- Lightbox -->
        <div x-show="lightbox" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="lightbox = false"
             @keydown.escape.window="lightbox = false"
             class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4">
            <button @click="lightbox = false" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img :src="currentImage" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl" @click.stop>
        </div>
    </div>
</section>
@endsection
