@extends('layouts.app')

@section('title', 'Contact')

@section('content')

    <!-- Hero -->
    <section class="relative pt-32 pb-20 bg-gray-900">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ setting('contact_hero_image', 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1920') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 to-gray-900"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
            <span class="text-gold font-montserrat text-sm tracking-[0.3em] uppercase">Estuaire Beauty</span>
            <h1 class="font-playfair text-5xl md:text-6xl font-bold text-white mt-4 mb-4">Contactez-Nous</h1>
            <div class="w-20 h-1 gold-gradient mx-auto rounded-full mb-6"></div>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto">Nous sommes a votre ecoute. N'hesitez pas a nous contacter pour toute question.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-20 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Contact Info -->
                <div>
                    <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-8">Nos Coordonnees</h2>

                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl border border-gold/10 hover-lift">
                            <div class="w-12 h-12 rounded-full gold-gradient flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Adresse</h3>
                                <p class="text-gray-500">{{ setting('address', 'Bafoussam, Cameroun') }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl border border-gold/10 hover-lift">
                            <div class="w-12 h-12 rounded-full gold-gradient flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telephone</h3>
                                <a href="tel:{{ setting('phone', '+241 XX XX XX XX') }}" class="text-gray-500 hover:text-gold transition-colors">
                                    {{ setting('phone', '+241 XX XX XX XX') }}
                                </a>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl border border-gold/10 hover-lift">
                            <div class="w-12 h-12 rounded-full gold-gradient flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <a href="mailto:{{ setting('email', 'contact@estuairebeauty.com') }}" class="text-gray-500 hover:text-gold transition-colors">
                                    {{ setting('email', 'contact@estuairebeauty.com') }}
                                </a>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        @if(setting('whatsapp_number'))
                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl border border-gold/10 hover-lift">
                            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">WhatsApp</h3>
                                <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" class="text-gray-500 hover:text-green-600 transition-colors">
                                    Ecrivez-nous sur WhatsApp
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Social Media -->
                    <div class="mt-10">
                        <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-4">Suivez-nous</h3>
                        <div class="flex space-x-4">
                            @if(setting('facebook_url'))
                            <a href="{{ setting('facebook_url') }}" target="_blank" class="w-12 h-12 rounded-full bg-white border border-gold/20 flex items-center justify-center text-gray-500 hover:gold-gradient hover:text-white hover:border-gold transition-all duration-300 hover-lift">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            @endif
                            @if(setting('instagram_url'))
                            <a href="{{ setting('instagram_url') }}" target="_blank" class="w-12 h-12 rounded-full bg-white border border-gold/20 flex items-center justify-center text-gray-500 hover:gold-gradient hover:text-white hover:border-gold transition-all duration-300 hover-lift">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            @endif
                            @if(setting('tiktok_url'))
                            <a href="{{ setting('tiktok_url') }}" target="_blank" class="w-12 h-12 rounded-full bg-white border border-gold/20 flex items-center justify-center text-gray-500 hover:gold-gradient hover:text-white hover:border-gold transition-all duration-300 hover-lift">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.2a6.34 6.34 0 0010.86 4.48v-7.15a8.16 8.16 0 005.58 2.2v-3.44a4.85 4.85 0 01-3.77-1.83V6.69h3.77z"/></svg>
                            </a>
                            @endif
                            @if(setting('youtube_url'))
                            <a href="{{ setting('youtube_url') }}" target="_blank" class="w-12 h-12 rounded-full bg-white border border-gold/20 flex items-center justify-center text-gray-500 hover:gold-gradient hover:text-white hover:border-gold transition-all duration-300 hover-lift">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="mt-10">
                        <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-4">Horaires d'ouverture</h3>
                        <div class="bg-white rounded-xl border border-gold/10 overflow-hidden">
                            @php
                            $dayNames = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                            @endphp
                            @forelse($businessHours as $bh)
                            <div class="flex justify-between items-center px-5 py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                <span class="font-medium text-gray-700 text-sm">{{ $dayNames[$bh->day_of_week ?? 0] ?? '' }}</span>
                                @if($bh->is_closed ?? false)
                                <span class="text-red-400 text-sm font-medium">Ferme</span>
                                @else
                                <span class="text-gold font-semibold text-sm">{{ $bh->open_time ?? '08:00' }} - {{ $bh->close_time ?? '19:00' }}</span>
                                @endif
                            </div>
                            @empty
                            <div class="px-5 py-3 flex justify-between">
                                <span class="text-gray-700 text-sm">Lundi - Vendredi</span>
                                <span class="text-gold font-semibold text-sm">{{ setting('hours_weekday', '08h - 19h') }}</span>
                            </div>
                            <div class="px-5 py-3 border-t border-gray-50 flex justify-between">
                                <span class="text-gray-700 text-sm">Samedi</span>
                                <span class="text-gold font-semibold text-sm">{{ setting('hours_saturday', '08h - 20h') }}</span>
                            </div>
                            <div class="px-5 py-3 border-t border-gray-50 flex justify-between">
                                <span class="text-gray-700 text-sm">Dimanche</span>
                                <span class="text-red-400 font-medium text-sm">{{ setting('hours_sunday', 'Ferme') }}</span>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div>
                    <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-8">Nous Trouver</h2>

                    <!-- Google Maps -->
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gold/10 h-[400px] mb-8">
                        @if(setting('google_maps_api_key'))
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key={{ setting('google_maps_api_key') }}&q={{ urlencode(setting('address', 'Bafoussam, Cameroun')) }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        @else
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode(setting('address', 'Quartier Macambou, Bafoussam, Cameroun')) }}&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        @endif
                    </div>

                    <!-- Quick CTA -->
                    <div class="bg-white rounded-2xl p-8 border border-gold/10 text-center">
                        <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Envie d'un rendez-vous ?</h3>
                        <p class="text-gray-500 text-sm mb-6">Reservez en ligne ou appelez-nous directement.</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ url('/reservation') }}" class="inline-flex items-center justify-center px-6 py-3 gold-gradient text-white font-semibold text-sm rounded-full hover:shadow-lg hover:shadow-gold/30 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Reserver en ligne
                            </a>
                            <a href="tel:{{ setting('phone', '+241 XX XX XX XX') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-gold text-gold font-semibold text-sm rounded-full hover:bg-gold hover:text-white transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Appeler
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
