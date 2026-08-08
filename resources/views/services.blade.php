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

<!-- Categories Grid -->
<section class="py-20 bg-cream">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
            @if($category->services->count() > 0)
            <a href="{{ route('services.show', $category->slug) }}" class="group hover-lift bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-gold/30 shadow-sm hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full gold-gradient flex items-center justify-center shadow-md shadow-gold/20 group-hover:shadow-gold/40 transition-shadow duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                </div>
                <h3 class="font-playfair text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ $category->services->count() }} prestation{{ $category->services->count() > 1 ? 's' : '' }}</p>
                <span class="text-gold font-semibold text-sm">
                    A partir de {{ number_format($category->services->min('price'), 0, ',', ' ') }} FCFA
                </span>
                <div class="mt-4 inline-flex items-center text-gold text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Voir les prestations
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </a>
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
