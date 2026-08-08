@extends('layouts.app')

@section('title', $category->name)

@section('content')
<!-- Header -->
<section class="relative py-24 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
    <div class="absolute top-10 right-10 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-72 h-72 bg-rose/10 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <a href="{{ route('services') }}" class="inline-flex items-center text-gold/70 hover:text-gold text-sm font-montserrat mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Tous les services
        </a>
        <h1 class="font-playfair text-4xl md:text-6xl font-bold text-white mb-4">{{ $category->name }}</h1>
        <p class="text-gray-300 text-lg">{{ $category->services->count() }} prestation{{ $category->services->count() > 1 ? 's' : '' }} disponible{{ $category->services->count() > 1 ? 's' : '' }}</p>
    </div>
</section>

<style>
    .swiper-container {
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .swiper-container::-webkit-scrollbar { display: none; }
    .swiper-slide {
        scroll-snap-align: center;
        flex-shrink: 0;
    }
</style>

<!-- Services Carousel -->
<section class="py-16 bg-cream">
    <div class="max-w-5xl mx-auto px-4" x-data="{ current: 0, total: {{ $category->services->count() }} }">

        {{-- Desktop: grid --}}
        <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($category->services as $service)
            <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gold/30 shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="h-56 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="text-center p-4">
                        <svg class="w-20 h-20 text-gold/15 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                        <span class="text-gold/25 text-sm font-playfair mt-2 block">{{ $service->name }}</span>
                    </div>
                    @endif
                    <div class="absolute top-3 right-3 px-4 py-1.5 bg-gold text-white text-sm font-bold rounded-full shadow-lg">
                        {{ number_format($service->price, 0, ',', ' ') }} FCFA
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">{{ $service->name }}</h3>
                    @if($service->description)
                    <p class="text-gray-500 text-sm mb-4">{{ $service->description }}</p>
                    @endif
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $service->duration }} min
                        </div>
                        <a href="{{ route('reservation') }}" class="inline-flex items-center px-5 py-2 border-2 border-gold text-gold font-semibold text-sm rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                            Reserver
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Mobile: horizontal swipe --}}
        <div class="md:hidden">
            <div class="swiper-container flex gap-4 pb-4" x-ref="slider"
                 @scroll="current = Math.round($refs.slider.scrollLeft / ($refs.slider.scrollWidth / total))">
                @foreach($category->services as $service)
                <div class="swiper-slide w-[85vw] max-w-[320px]">
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                        <div class="h-52 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                            @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                            @else
                            <div class="text-center p-4">
                                <svg class="w-16 h-16 text-gold/15 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                                <span class="text-gold/25 text-sm font-playfair mt-2 block">{{ $service->name }}</span>
                            </div>
                            @endif
                            <div class="absolute top-3 right-3 px-4 py-1.5 bg-gold text-white text-sm font-bold rounded-full shadow-lg">
                                {{ number_format($service->price, 0, ',', ' ') }} FCFA
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">{{ $service->name }}</h3>
                            @if($service->description)
                            <p class="text-gray-500 text-sm mb-3">{{ $service->description }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-gray-400 text-sm">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $service->duration }} min
                                </div>
                                <a href="{{ route('reservation') }}" class="inline-flex items-center px-5 py-2 border-2 border-gold text-gold font-semibold text-sm rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                                    Reserver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Dots indicator --}}
            <div class="flex justify-center gap-2 mt-4">
                @foreach($category->services as $index => $service)
                <div class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                     :class="current === {{ $index }} ? 'bg-gold w-6' : 'bg-gray-300'"></div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 relative overflow-hidden">
    <div class="absolute inset-0 gold-gradient"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <h2 class="font-playfair text-3xl md:text-4xl font-bold text-white mb-6">Interesse(e) par {{ $category->name }} ?</h2>
        <p class="text-white/80 text-lg mb-8">Reservez votre rendez-vous et laissez-nous sublimer votre beaute.</p>
        <a href="{{ route('reservation') }}" class="inline-flex items-center px-10 py-4 bg-white text-gold-dark font-montserrat font-bold text-sm tracking-widest uppercase rounded-full hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
            Reserver maintenant
        </a>
    </div>
</section>
@endsection
