@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
    <div class="absolute inset-0 opacity-30" style="background-image: url('{{ asset('storage/hero/hero-coiffure.jpeg') }}'); background-size: cover; background-position: center;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>
    <div class="absolute top-20 left-10 w-72 h-72 bg-gold/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-rose/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <div class="mb-6">
            <span class="inline-block px-6 py-2 border border-gold/40 rounded-full text-gold text-sm font-montserrat tracking-[0.3em] uppercase">
                Salon de Beaute Premium
            </span>
        </div>
        <h1 class="font-playfair text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 leading-tight">
            {{ setting('hero_title', 'Sublimez votre beaute') }}
        </h1>
        <p class="font-montserrat text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
            {{ setting('hero_subtitle', 'Coiffure, Maquillage, Lace Frontale & Onglerie') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('reservation') }}" class="inline-flex items-center justify-center px-10 py-4 gold-gradient text-white font-montserrat font-semibold text-sm tracking-widest uppercase rounded-full hover:shadow-2xl hover:shadow-gold/30 transition-all duration-500 transform hover:scale-105">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reserver maintenant
            </a>
            <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-10 py-4 border-2 border-white/30 text-white font-montserrat font-semibold text-sm tracking-widest uppercase rounded-full hover:bg-white/10 hover:border-gold transition-all duration-500">
                Nos Services
            </a>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </div>
</section>

<!-- Services Categories -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 gold-gradient"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-gold/10 text-gold text-xs font-montserrat tracking-[0.3em] uppercase rounded-full mb-4">Ce que nous offrons</span>
            <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 mb-4">Nos Services</h2>
            <div class="w-24 h-1 gold-gradient mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
            <div class="group hover-lift bg-cream rounded-2xl p-8 text-center border border-gray-100 hover:border-gold/30">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-gold/20 to-rose/20 flex items-center justify-center group-hover:from-gold/30 group-hover:to-rose/30 transition-all duration-500">
                    @if($category->slug == 'coiffure')
                    <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758A5.002 5.002 0 0112 4a5 5 0 013.879 5.121"/></svg>
                    @elseif($category->slug == 'maquillage')
                    <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/></svg>
                    @elseif($category->slug == 'lace-frontale')
                    <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75z"/></svg>
                    @else
                    <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                    @endif
                </div>
                <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">{{ $category->name }}</h3>
                <p class="text-gray-500 text-sm mb-5">{{ $category->description ?? 'Des prestations de qualite pour sublimer votre beaute' }}</p>
                <a href="{{ route('services') }}" class="inline-flex items-center text-gold font-medium text-sm hover:text-gold-dark transition-colors">
                    Decouvrir <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-24 bg-cream-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-gold/10 text-gold text-xs font-montserrat tracking-[0.3em] uppercase rounded-full mb-4">Pourquoi nous</span>
            <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 mb-4">L'Excellence au service de votre beaute</h2>
            <div class="w-24 h-1 gold-gradient mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full gold-gradient flex items-center justify-center shadow-lg shadow-gold/20 group-hover:shadow-gold/40 transition-shadow duration-500">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                </div>
                <h3 class="font-playfair text-2xl font-semibold text-gray-900 mb-3">Expertise</h3>
                <p class="text-gray-500 leading-relaxed">Des professionnels qualifies avec des annees d'experience dans la beaute et la coiffure.</p>
            </div>
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full rose-gradient flex items-center justify-center shadow-lg shadow-rose/20 group-hover:shadow-rose/40 transition-shadow duration-500">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                </div>
                <h3 class="font-playfair text-2xl font-semibold text-gray-900 mb-3">Passion</h3>
                <p class="text-gray-500 leading-relaxed">Chaque cliente est unique. Nous mettons tout notre coeur pour sublimer votre beaute naturelle.</p>
            </div>
            <div class="text-center group">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gold to-rose flex items-center justify-center shadow-lg shadow-gold/20 group-hover:shadow-gold/40 transition-shadow duration-500">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                </div>
                <h3 class="font-playfair text-2xl font-semibold text-gray-900 mb-3">Qualite Premium</h3>
                <p class="text-gray-500 leading-relaxed">Des produits haut de gamme et un cadre elegant pour une experience beaute inoubliable.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Services -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-gold/10 text-gold text-xs font-montserrat tracking-[0.3em] uppercase rounded-full mb-4">Nos prestations</span>
            <h2 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 mb-4">Services populaires</h2>
            <div class="w-24 h-1 gold-gradient mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $service)
            <div class="group hover-lift bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gold/30 shadow-sm">
                <div class="h-48 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <svg class="w-16 h-16 text-gold/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                    @endif
                    <div class="absolute top-3 right-3 px-3 py-1 bg-gold text-white text-xs font-bold rounded-full shadow-lg">
                        {{ number_format($service->price, 0, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="p-5">
                    <span class="text-xs text-gold font-semibold tracking-wider uppercase">{{ $service->category->name ?? '' }}</span>
                    <h3 class="font-playfair text-lg font-semibold text-gray-900 mt-1 mb-2">{{ $service->name }}</h3>
                    <div class="flex items-center text-gray-400 text-sm mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $service->duration }} min
                    </div>
                    <a href="{{ route('reservation') }}" class="block w-full text-center py-2.5 border-2 border-gold text-gold font-semibold text-sm rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                        Reserver
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="inline-flex items-center px-8 py-3 border-2 border-gold text-gold font-montserrat font-semibold text-sm tracking-wider uppercase rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                Voir tous les services
                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
@if($galleryImages->count() > 0)
<section class="py-24 bg-gray-900 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-gold/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-rose/5 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 bg-gold/20 text-gold text-xs font-montserrat tracking-[0.3em] uppercase rounded-full mb-4">Portfolio</span>
            <h2 class="font-playfair text-4xl md:text-5xl font-bold text-white mb-4">Nos Realisations</h2>
            <div class="w-24 h-1 gold-gradient mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galleryImages as $image)
            <div class="group relative overflow-hidden rounded-2xl aspect-square">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title ?? 'Realisation' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                    <div>
                        <h4 class="text-white font-playfair font-semibold text-lg">{{ $image->title ?? '' }}</h4>
                        @if($image->category)
                        <span class="text-gold text-sm">{{ $image->category->name }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('gallery') }}" class="inline-flex items-center px-8 py-3 border-2 border-gold text-gold font-montserrat font-semibold text-sm tracking-wider uppercase rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                Voir la galerie complete
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 gold-gradient"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <h2 class="font-playfair text-4xl md:text-5xl font-bold text-white mb-6">Prete a etre sublime ?</h2>
        <p class="text-white/80 text-lg mb-10 max-w-2xl mx-auto">Reservez votre rendez-vous en quelques clics et laissez nos experts prendre soin de vous.</p>
        <a href="{{ route('reservation') }}" class="inline-flex items-center px-12 py-4 bg-white text-gold-dark font-montserrat font-bold text-sm tracking-widest uppercase rounded-full hover:bg-cream hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Reserver maintenant
        </a>
    </div>
</section>
@endsection
