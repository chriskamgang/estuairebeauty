@extends('layouts.app')

@section('title', 'Nos Services')

@section('content')
<!-- Hero -->
<section class="relative py-32 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
    <div class="absolute top-10 right-10 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-72 h-72 bg-rose/10 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <span class="inline-block px-6 py-2 border border-gold/40 rounded-full text-gold text-sm font-montserrat tracking-[0.3em] uppercase mb-6">Nos prestations</span>
        <h1 class="font-playfair text-5xl md:text-6xl font-bold text-white mb-4">Nos Services</h1>
        <p class="text-gray-300 text-lg max-w-2xl mx-auto">Decouvrez l'ensemble de nos prestations beaute realisees par des professionnels passionnes.</p>
    </div>
</section>

<style>
    .carousel-scroll {
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .carousel-scroll::-webkit-scrollbar { display: none; }
    .carousel-card {
        scroll-snap-align: start;
        flex-shrink: 0;
    }
</style>

<!-- Categories Accordion -->
<section class="py-16 bg-cream">
    @php
        $defaultOpen = 'null';
        if (request('cat')) {
            $catIndex = $categories->pluck('slug')->search(request('cat'));
            if ($catIndex !== false) {
                $defaultOpen = $catIndex;
            }
        }
    @endphp
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ openCat: {{ $defaultOpen }} }" x-init="if (openCat !== null) { $nextTick(() => { document.getElementById('cat-{{ request('cat') }}')?.scrollIntoView({ behavior: 'smooth', block: 'center' }) }) }">
        <div class="space-y-4">
            @foreach($categories as $index => $category)
            @if($category->services->count() > 0)
            <div id="cat-{{ $category->slug }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Category header (clickable) --}}
                <button
                    @click="openCat = openCat === {{ $index }} ? null : {{ $index }}"
                    class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-cream/50 transition-colors duration-200"
                >
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full gold-gradient flex items-center justify-center shadow-md shadow-gold/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-playfair text-xl md:text-2xl font-bold text-gray-900">{{ $category->name }}</h2>
                            <p class="text-gray-400 text-sm mt-0.5">{{ $category->services->count() }} prestation{{ $category->services->count() > 1 ? 's' : '' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-gold font-semibold text-sm hidden sm:block">
                            A partir de {{ number_format($category->services->min('price'), 0, ',', ' ') }} FCFA
                        </span>
                        <svg
                            class="w-6 h-6 text-gold transition-transform duration-300"
                            :class="openCat === {{ $index }} ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>

                {{-- Expandable carousel --}}
                <div
                    x-show="openCat === {{ $index }}"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-[600px]"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 max-h-[600px]"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="overflow-hidden"
                >
                    <div class="px-6 pb-6">
                        {{-- Swipe hint mobile --}}
                        <div class="flex items-center justify-end mb-3 text-gray-400 text-xs md:hidden">
                            <svg class="w-3.5 h-3.5 mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            Swipez pour voir plus
                        </div>

                        <div class="carousel-scroll flex gap-4 pb-2">
                            @foreach($category->services as $service)
                            <div class="carousel-card w-[260px] md:w-[300px]">
                                <div class="bg-cream-dark/30 rounded-xl overflow-hidden border border-gray-100 hover:border-gold/30 hover:shadow-lg transition-all duration-300">
                                    {{-- Image --}}
                                    <div class="h-48 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                                        @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                        @else
                                        <div class="text-center p-4">
                                            <svg class="w-16 h-16 text-gold/15 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                                            <span class="text-gold/25 text-xs font-playfair mt-2 block">{{ $service->name }}</span>
                                        </div>
                                        @endif
                                        <div class="absolute top-2.5 right-2.5 px-3 py-1 bg-gold text-white text-xs font-bold rounded-full shadow-lg">
                                            {{ number_format($service->price, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="p-4">
                                        <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-gray-400 text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $service->duration }} min
                                            </div>
                                            <a href="{{ route('reservation') }}" class="inline-flex items-center px-4 py-1.5 border-2 border-gold text-gold font-semibold text-xs rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                                                Reserver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 gold-gradient"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <h2 class="font-playfair text-4xl font-bold text-white mb-6">Envie d'un nouveau look ?</h2>
        <p class="text-white/80 text-lg mb-8">Reservez votre rendez-vous et laissez-nous sublimer votre beaute.</p>
        <a href="{{ route('reservation') }}" class="inline-flex items-center px-10 py-4 bg-white text-gold-dark font-montserrat font-bold text-sm tracking-widest uppercase rounded-full hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
            Reserver maintenant
        </a>
    </div>
</section>
@endsection
