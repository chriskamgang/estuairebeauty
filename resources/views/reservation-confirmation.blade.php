@extends('layouts.app')

@section('title', 'Reservation Confirmee')

@section('content')

    <section class="min-h-screen flex items-center justify-center py-32 bg-cream">
        <div class="max-w-lg mx-auto px-4 text-center">

            <!-- Success Icon -->
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto rounded-full gold-gradient flex items-center justify-center shadow-xl shadow-gold/30 animate-bounce" style="animation-duration: 2s;">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 mb-4">Reservation Confirmee !</h1>
            <p class="text-gray-500 text-lg mb-10">Merci pour votre reservation. Nous avons bien recu votre demande.</p>

            <!-- Reservation Details -->
            @if(isset($reservation))
            <div class="bg-white rounded-2xl p-8 border border-gold/10 shadow-lg text-left mb-10">
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-6 text-center">Details de votre reservation</h3>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Reference</span>
                        <span class="font-semibold text-gold">#{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Service</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->service->name ?? '' }}</span>
                    </div>

                    @if($reservation->staffMember)
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Coiffeur(se)</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->staffMember->name }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Date</span>
                        <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($reservation->reservation_date)->translatedFormat('l j F Y') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Heure</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->reservation_time }}</span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Client</span>
                        <span class="font-semibold text-gray-900">{{ $reservation->client_name }}</span>
                    </div>

                    @if($reservation->service)
                    <div class="flex justify-between items-center py-3">
                        <span class="text-gray-500 text-sm">Prix</span>
                        <span class="font-bold text-gold text-lg">{{ number_format($reservation->service->price, 0, ',', ' ') }} FCFA</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Info Notice -->
            <div class="bg-gold/10 rounded-xl p-5 mb-8 text-left">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-gray-700 text-sm font-medium mb-1">Information importante</p>
                        <p class="text-gray-500 text-sm">Votre reservation est en attente de confirmation. Vous recevrez une notification une fois validee par notre equipe. En cas de besoin, contactez-nous au <strong class="text-gold">{{ setting('phone', '+241 XX XX XX XX') }}</strong>.</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-3 gold-gradient text-white font-semibold text-sm rounded-full hover:shadow-lg hover:shadow-gold/30 transition-all duration-300">
                    Retour a l'accueil
                </a>
                @if(setting('whatsapp_number'))
                <a href="https://wa.me/{{ setting('whatsapp_number') }}?text={{ urlencode('Bonjour, je viens de faire une reservation en ligne. Pouvez-vous me confirmer ?') }}" target="_blank" class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-semibold text-sm rounded-full hover:bg-green-700 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    Confirmer par WhatsApp
                </a>
                @endif
            </div>
        </div>
    </section>

@endsection
