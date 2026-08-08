@extends('admin.layouts.app')
@section('title', 'Parametres')

@section('content')
    <div class="max-w-3xl" x-data="{ tab: 'general' }">
        <!-- Tabs -->
        <div class="flex gap-1 mb-6 bg-dark-400 rounded-xl p-1 border border-dark-100">
            <button @click="tab = 'general'" :class="tab === 'general' ? 'bg-gold text-dark-500' : 'text-gray-400 hover:text-white'" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-colors">General</button>
            <button @click="tab = 'contact'" :class="tab === 'contact' ? 'bg-gold text-dark-500' : 'text-gray-400 hover:text-white'" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-colors">Contact</button>
            <button @click="tab = 'social'" :class="tab === 'social' ? 'bg-gold text-dark-500' : 'text-gray-400 hover:text-white'" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-colors">Reseaux sociaux</button>
            <button @click="tab = 'maps'" :class="tab === 'maps' ? 'bg-gold text-dark-500' : 'text-gray-400 hover:text-white'" class="flex-1 py-2 px-4 rounded-lg font-medium text-sm transition-colors">Google Maps</button>
        </div>

        <div class="bg-dark-400 rounded-xl border border-dark-100 p-6">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- General -->
                <div x-show="tab === 'general'" x-cloak>
                    <h3 class="text-lg font-semibold mb-4">Informations generales</h3>

                    <div class="mb-5">
                        <label for="salon_name" class="block text-sm font-medium text-gray-300 mb-2">Nom du salon</label>
                        <input type="text" name="salon_name" id="salon_name" value="{{ $settings['salon_name'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>

                    <div class="mb-5">
                        <label for="salon_description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea name="salon_description" id="salon_description" rows="4"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">{{ $settings['salon_description'] ?? '' }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label for="logo" class="block text-sm font-medium text-gray-300 mb-2">Logo</label>
                        @if(isset($settings['logo']) && $settings['logo'])
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="h-16 rounded">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-gold file:text-dark-500 file:font-semibold file:cursor-pointer">
                    </div>
                </div>

                <!-- Contact -->
                <div x-show="tab === 'contact'" x-cloak>
                    <h3 class="text-lg font-semibold mb-4">Coordonnees</h3>

                    <div class="mb-5">
                        <label for="address" class="block text-sm font-medium text-gray-300 mb-2">Adresse</label>
                        <input type="text" name="address" id="address" value="{{ $settings['address'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Telephone</label>
                            <input type="text" name="phone" id="phone" value="{{ $settings['phone'] ?? '' }}"
                                class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-300 mb-2">WhatsApp</label>
                            <input type="text" name="whatsapp" id="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}"
                                class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ $settings['email'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>
                </div>

                <!-- Social -->
                <div x-show="tab === 'social'" x-cloak>
                    <h3 class="text-lg font-semibold mb-4">Reseaux sociaux</h3>

                    <div class="mb-5">
                        <label for="facebook" class="block text-sm font-medium text-gray-300 mb-2">Facebook (URL)</label>
                        <input type="url" name="facebook" id="facebook" value="{{ $settings['facebook'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold"
                            placeholder="https://facebook.com/...">
                    </div>

                    <div class="mb-5">
                        <label for="instagram" class="block text-sm font-medium text-gray-300 mb-2">Instagram (URL)</label>
                        <input type="url" name="instagram" id="instagram" value="{{ $settings['instagram'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold"
                            placeholder="https://instagram.com/...">
                    </div>
                </div>

                <!-- Maps -->
                <div x-show="tab === 'maps'" x-cloak>
                    <h3 class="text-lg font-semibold mb-4">Google Maps</h3>

                    <div class="mb-5">
                        <label for="google_maps_key" class="block text-sm font-medium text-gray-300 mb-2">Cle API Google Maps</label>
                        <input type="text" name="google_maps_key" id="google_maps_key" value="{{ $settings['google_maps_key'] ?? '' }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold"
                            placeholder="AIzaSy...">
                        <p class="text-xs text-gray-500 mt-1">Utilisee pour afficher la carte sur le site</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-dark-100">
                    <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-8 py-3 rounded-lg transition-colors">
                        Enregistrer les parametres
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
