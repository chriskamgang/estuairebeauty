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
    .carousel-container {
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .carousel-container::-webkit-scrollbar { display: none; }
    .carousel-item {
        scroll-snap-align: start;
        flex-shrink: 0;
    }
</style>

<!-- Services List -->
<section class="py-20 bg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($categories as $category)
        @if($category->services->count() > 0)
        <div class="mb-20 last:mb-0">
            <div class="flex items-center mb-10">
                <div class="w-16 h-16 rounded-full gold-gradient flex items-center justify-center mr-5 shadow-lg shadow-gold/20">
                    @if($category->slug == 'coiffure')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121"/></svg>
                    @elseif($category->slug == 'maquillage')
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128z"/></svg>
                    @else
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                    @endif
                </div>
                <div>
                    <h2 class="font-playfair text-3xl md:text-4xl font-bold text-gray-900">{{ $category->name }}</h2>
                    @if($category->description)
                    <p class="text-gray-500 mt-1">{{ $category->description }}</p>
                    @endif
                </div>
            </div>

            @php
                $subCategories = $category->services->whereNotNull('sub_category')->groupBy('sub_category');
            @endphp

            @if($subCategories->count() > 0)
            {{-- Sub-category layout with tabs and carousel --}}
            <div x-data="{ activeTab: '{{ $subCategories->keys()->first() }}' }">
                {{-- Sub-category tabs --}}
                <div class="flex flex-wrap gap-3 mb-8">
                    @foreach($subCategories as $subName => $subServices)
                    <button
                        @click="activeTab = '{{ $subName }}'"
                        :class="activeTab === '{{ $subName }}'
                            ? 'bg-gold text-white shadow-lg shadow-gold/30'
                            : 'bg-white text-gray-700 border border-gray-200 hover:border-gold/50'"
                        class="px-6 py-3 rounded-full font-montserrat font-semibold text-sm transition-all duration-300"
                    >
                        {{ $subName }}
                        <span class="ml-1 text-xs opacity-70">({{ $subServices->count() }})</span>
                    </button>
                    @endforeach
                </div>

                {{-- Carousel for each sub-category --}}
                @foreach($subCategories as $subName => $subServices)
                <div x-show="activeTab === '{{ $subName }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="relative">
                        {{-- Swipe hint --}}
                        <div class="flex items-center justify-end mb-3 text-gray-400 text-sm md:hidden">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            Swipez pour voir plus
                        </div>

                        <div class="carousel-container flex gap-5 pb-4">
                            @foreach($subServices as $service)
                            <div class="carousel-item w-[300px] md:w-[340px]">
                                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gold/30 shadow-sm hover:shadow-xl transition-all duration-300">
                                    <div class="h-56 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                                        @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                        @else
                                        <div class="text-center">
                                            <svg class="w-20 h-20 text-gold/20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                                            <span class="text-gold/30 text-sm font-playfair mt-2 block">{{ $service->name }}</span>
                                        </div>
                                        @endif
                                        <div class="absolute top-3 right-3 px-4 py-1.5 bg-gold text-white text-sm font-bold rounded-full shadow-lg">
                                            {{ number_format($service->price, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">{{ $service->name }}</h3>
                                        @if($service->description)
                                        <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $service->description }}</p>
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
                    </div>
                </div>
                @endforeach
            </div>
            @else
            {{-- Standard grid for categories without sub-categories --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($category->services as $service)
                <div class="group hover-lift bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-gold/30 shadow-sm">
                    <div class="h-52 bg-gradient-to-br from-cream to-cream-dark flex items-center justify-center relative overflow-hidden">
                        @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="text-center">
                            <svg class="w-20 h-20 text-gold/20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                            <span class="text-gold/30 text-sm font-playfair mt-2 block">{{ $service->name }}</span>
                        </div>
                        @endif
                        <div class="absolute top-3 right-3 px-4 py-1.5 bg-gold text-white text-sm font-bold rounded-full shadow-lg">
                            {{ number_format($service->price, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                        @if($service->description)
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3">{{ $service->description }}</p>
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
            @endif
        </div>
        @endif
        @endforeach
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
