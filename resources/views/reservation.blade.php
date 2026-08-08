@extends('layouts.app')

@section('title', 'Reservation')

@section('content')
<!-- Hero -->
<section class="relative py-32 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
    <div class="absolute top-10 left-10 w-72 h-72 bg-rose/10 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        <span class="inline-block px-6 py-2 border border-gold/40 rounded-full text-gold text-sm font-montserrat tracking-[0.3em] uppercase mb-6">Rendez-vous</span>
        <h1 class="font-playfair text-5xl md:text-6xl font-bold text-white mb-4">Reservation</h1>
        <p class="text-gray-300 text-lg">Reservez votre prestation en quelques etapes simples.</p>
    </div>
</section>

<!-- Reservation Form -->
<section class="py-20 bg-cream">
    <div class="max-w-3xl mx-auto px-4" x-data="reservationForm()">

        <!-- Progress Bar -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <template x-for="(label, index) in ['Service', 'Equipe', 'Date & Heure', 'Vos infos', 'Confirmation']" :key="index">
                    <div class="flex items-center" :class="index < 4 ? 'flex-1' : ''">
                        <div class="flex flex-col items-center">
                            <div :class="step > index ? 'gold-gradient text-white shadow-lg shadow-gold/20' : step === index ? 'gold-gradient text-white shadow-lg shadow-gold/20 ring-4 ring-gold/20' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-500">
                                <template x-if="step > index">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </template>
                                <template x-if="step <= index">
                                    <span x-text="index + 1"></span>
                                </template>
                            </div>
                            <span class="text-xs mt-2 font-medium hidden sm:block" :class="step >= index ? 'text-gold' : 'text-gray-400'" x-text="label"></span>
                        </div>
                        <div x-show="index < 4" class="flex-1 h-0.5 mx-3 rounded-full transition-all duration-500" :class="step > index ? 'bg-gold' : 'bg-gray-200'"></div>
                    </div>
                </template>
            </div>
        </div>

        <form action="{{ route('reservation.store') }}" method="POST" @submit.prevent="submitForm">
            @csrf

            <!-- Step 1: Service -->
            <div x-show="step === 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Choisissez votre service</h2>
                    <p class="text-gray-500 mb-8">Selectionnez la categorie puis le service souhaite.</p>

                    <!-- Category Selection -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
                        @foreach($categories as $category)
                        <button type="button" @click="selectedCategory = {{ $category->id }}" :class="selectedCategory === {{ $category->id }} ? 'border-gold bg-gold/5 text-gold' : 'border-gray-200 text-gray-600 hover:border-gold/50'" class="p-4 rounded-2xl border-2 text-center transition-all duration-300">
                            <span class="font-semibold text-sm">{{ $category->name }}</span>
                        </button>
                        @endforeach
                    </div>

                    <!-- Services -->
                    @foreach($categories as $category)
                    <div x-show="selectedCategory === {{ $category->id }}" x-transition class="space-y-3">
                        @foreach($category->services as $service)
                        <label class="flex items-center justify-between p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300" :class="selectedService === {{ $service->id }} ? 'border-gold bg-gold/5' : 'border-gray-100 hover:border-gold/30'">
                            <div class="flex items-center">
                                <input type="radio" name="service_id" value="{{ $service->id }}" x-model.number="selectedService" class="sr-only" @change="serviceName = '{{ $service->name }}'; servicePrice = {{ $service->price }}; serviceDuration = {{ $service->duration }}">
                                <div :class="selectedService === {{ $service->id }} ? 'bg-gold border-gold' : 'border-gray-300'" class="w-5 h-5 rounded-full border-2 mr-4 flex items-center justify-center transition-all">
                                    <div x-show="selectedService === {{ $service->id }}" class="w-2 h-2 bg-white rounded-full"></div>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-900">{{ $service->name }}</span>
                                    <span class="text-gray-400 text-sm ml-2">{{ $service->duration }} min</span>
                                </div>
                            </div>
                            <span class="font-bold text-gold">{{ number_format($service->price, 0, ',', ' ') }} FCFA</span>
                        </label>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" @click="if(selectedService) step++" :disabled="!selectedService" :class="selectedService ? 'gold-gradient text-white hover:shadow-lg hover:shadow-gold/30' : 'bg-gray-200 text-gray-400 cursor-not-allowed'" class="px-8 py-3 rounded-full font-semibold text-sm tracking-wide transition-all duration-300">
                        Suivant
                    </button>
                </div>
            </div>

            <!-- Step 2: Staff -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Choisissez votre professionnel(le)</h2>
                    <p class="text-gray-500 mb-8">Optionnel - laissez vide pour aucune preference.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300" :class="selectedStaff === '' ? 'border-gold bg-gold/5' : 'border-gray-100 hover:border-gold/30'">
                            <input type="radio" name="staff_member_id" value="" x-model="selectedStaff" class="sr-only" @change="staffName = 'Aucune preference'">
                            <div :class="selectedStaff === '' ? 'bg-gold border-gold' : 'border-gray-300'" class="w-5 h-5 rounded-full border-2 mr-4 flex items-center justify-center transition-all">
                                <div x-show="selectedStaff === ''" class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="font-semibold text-gray-700">Aucune preference</span>
                            </div>
                        </label>

                        @foreach($staffMembers as $staff)
                        <label class="flex items-center p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300" :class="selectedStaff === '{{ $staff->id }}' ? 'border-gold bg-gold/5' : 'border-gray-100 hover:border-gold/30'">
                            <input type="radio" name="staff_member_id" value="{{ $staff->id }}" x-model="selectedStaff" class="sr-only" @change="staffName = '{{ $staff->name }}'">
                            <div :class="selectedStaff === '{{ $staff->id }}' ? 'bg-gold border-gold' : 'border-gray-300'" class="w-5 h-5 rounded-full border-2 mr-4 flex items-center justify-center transition-all">
                                <div x-show="selectedStaff === '{{ $staff->id }}'" class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-cream overflow-hidden mr-3">
                                    @if($staff->photo)
                                    <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-gold font-bold text-lg">{{ substr($staff->name, 0, 1) }}</div>
                                    @endif
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-900">{{ $staff->name }}</span>
                                    @if($staff->role)
                                    <span class="text-sm text-gray-400 block">{{ $staff->role }}</span>
                                    @endif
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" @click="step--" class="px-8 py-3 rounded-full font-semibold text-sm text-gray-600 border-2 border-gray-200 hover:border-gold/50 transition-all duration-300">Retour</button>
                    <button type="button" @click="step++" class="px-8 py-3 rounded-full font-semibold text-sm gold-gradient text-white hover:shadow-lg hover:shadow-gold/30 transition-all duration-300">Suivant</button>
                </div>
            </div>

            <!-- Step 3: Date & Time -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Date et heure</h2>
                    <p class="text-gray-500 mb-8">Choisissez le jour et l'heure de votre rendez-vous.</p>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                            <input type="date" name="reservation_date" x-model="selectedDate" :min="today" class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:ring-0 focus:outline-none font-montserrat transition-colors" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Heure</label>
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                <template x-for="time in availableTimes" :key="time">
                                    <button type="button" @click="selectedTime = time" :class="selectedTime === time ? 'gold-gradient text-white shadow-lg shadow-gold/20' : 'bg-gray-50 text-gray-700 hover:border-gold border border-gray-200'" class="py-2.5 rounded-xl text-sm font-semibold transition-all duration-300" x-text="time"></button>
                                </template>
                            </div>
                            <input type="hidden" name="reservation_time" x-model="selectedTime">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" @click="step--" class="px-8 py-3 rounded-full font-semibold text-sm text-gray-600 border-2 border-gray-200 hover:border-gold/50 transition-all duration-300">Retour</button>
                    <button type="button" @click="if(selectedDate && selectedTime) step++" :disabled="!selectedDate || !selectedTime" :class="selectedDate && selectedTime ? 'gold-gradient text-white hover:shadow-lg hover:shadow-gold/30' : 'bg-gray-200 text-gray-400 cursor-not-allowed'" class="px-8 py-3 rounded-full font-semibold text-sm tracking-wide transition-all duration-300">Suivant</button>
                </div>
            </div>

            <!-- Step 4: Client Info -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Vos informations</h2>
                    <p class="text-gray-500 mb-8">Pour vous contacter et confirmer votre reservation.</p>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet *</label>
                            <input type="text" name="client_name" x-model="clientName" class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:ring-0 focus:outline-none transition-colors" placeholder="Votre nom" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Telephone *</label>
                            <input type="tel" name="client_phone" x-model="clientPhone" class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:ring-0 focus:outline-none transition-colors" placeholder="+241 XX XX XX XX" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email (optionnel)</label>
                            <input type="email" name="client_email" x-model="clientEmail" class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:ring-0 focus:outline-none transition-colors" placeholder="votre@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Notes (optionnel)</label>
                            <textarea name="notes" x-model="notes" rows="3" class="w-full px-5 py-3 rounded-xl border-2 border-gray-200 focus:border-gold focus:ring-0 focus:outline-none transition-colors resize-none" placeholder="Informations supplementaires..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" @click="step--" class="px-8 py-3 rounded-full font-semibold text-sm text-gray-600 border-2 border-gray-200 hover:border-gold/50 transition-all duration-300">Retour</button>
                    <button type="button" @click="if(clientName && clientPhone) step++" :disabled="!clientName || !clientPhone" :class="clientName && clientPhone ? 'gold-gradient text-white hover:shadow-lg hover:shadow-gold/30' : 'bg-gray-200 text-gray-400 cursor-not-allowed'" class="px-8 py-3 rounded-full font-semibold text-sm tracking-wide transition-all duration-300">Voir le recapitulatif</button>
                </div>
            </div>

            <!-- Step 5: Summary -->
            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h2 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Recapitulatif</h2>
                    <p class="text-gray-500 mb-8">Verifiez les details de votre reservation.</p>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Service</span>
                            <span class="font-semibold text-gray-900" x-text="serviceName"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Professionnel(le)</span>
                            <span class="font-semibold text-gray-900" x-text="staffName"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Date</span>
                            <span class="font-semibold text-gray-900" x-text="formatDate(selectedDate)"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Heure</span>
                            <span class="font-semibold text-gray-900" x-text="selectedTime"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Duree</span>
                            <span class="font-semibold text-gray-900" x-text="serviceDuration + ' min'"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Client</span>
                            <span class="font-semibold text-gray-900" x-text="clientName"></span>
                        </div>
                        <div class="flex justify-between items-center py-4 border-b border-gray-100">
                            <span class="text-gray-500">Telephone</span>
                            <span class="font-semibold text-gray-900" x-text="clientPhone"></span>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-gold" x-text="servicePrice.toLocaleString('fr-FR') + ' FCFA'"></span>
                        </div>
                    </div>

                    <div class="mt-8 p-4 rounded-xl bg-gold/5 border border-gold/20">
                        <p class="text-sm text-gray-600">
                            <svg class="w-5 h-5 text-gold inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Le paiement se fait sur place. Votre reservation sera confirmee par telephone.
                        </p>
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <button type="button" @click="step--" class="px-8 py-3 rounded-full font-semibold text-sm text-gray-600 border-2 border-gray-200 hover:border-gold/50 transition-all duration-300">Retour</button>
                    <button type="submit" :disabled="submitting" class="px-10 py-3 rounded-full font-semibold text-sm gold-gradient text-white hover:shadow-lg hover:shadow-gold/30 transition-all duration-300 transform hover:scale-105 disabled:opacity-50">
                        <span x-show="!submitting">Confirmer la reservation</span>
                        <span x-show="submitting" class="flex items-center">
                            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            Envoi en cours...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
function reservationForm() {
    const businessHours = @json($businessHours);
    return {
        step: 0,
        selectedCategory: {{ $categories->first()->id ?? 'null' }},
        selectedService: null,
        selectedStaff: '',
        selectedDate: '',
        selectedTime: '',
        serviceName: '',
        servicePrice: 0,
        serviceDuration: 0,
        staffName: 'Aucune preference',
        clientName: '',
        clientPhone: '',
        clientEmail: '',
        notes: '',
        submitting: false,
        today: new Date().toISOString().split('T')[0],

        get availableTimes() {
            if (!this.selectedDate) return [];
            const date = new Date(this.selectedDate);
            const dayOfWeek = date.getDay();
            const hours = businessHours[dayOfWeek];
            if (!hours || hours.is_closed) return [];

            const times = [];
            const [openH, openM] = hours.open_time.split(':').map(Number);
            const [closeH, closeM] = hours.close_time.split(':').map(Number);
            let h = openH, m = openM;

            while (h < closeH || (h === closeH && m < closeM)) {
                times.push(`${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}`);
                m += 30;
                if (m >= 60) { h++; m = 0; }
            }
            return times;
        },

        formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            const days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            const months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
            return `${days[d.getDay()]} ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
        },

        submitForm() {
            this.submitting = true;
            this.$el.closest('form').submit();
        }
    }
}
</script>
@endpush
@endsection
