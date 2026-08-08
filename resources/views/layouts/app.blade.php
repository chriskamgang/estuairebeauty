<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', setting('site_name', 'Estuaire Beauty')) - Salon de Beaute Premium a Bafoussam</title>
    <meta name="description" content="@yield('description', setting('site_description', 'Estuaire Beauty - Votre salon de beaute premium a Bafoussam. Coiffure, Maquillage, Lace Frontale, Onglerie, Extensions de cils, Dermopigmentation, Soins & Massage.'))">

    <!-- Open Graph / WhatsApp / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', setting('site_name', 'Estuaire Beauty')) - Salon de Beaute Premium a Bafoussam">
    <meta property="og:description" content="@yield('description', setting('site_description', 'Votre salon de beaute premium a Bafoussam. Coiffure, Maquillage, Lace Frontale, Onglerie, Extensions de cils, Dermopigmentation & Massage. Reservez en ligne !'))">
    <meta property="og:image" content="{{ asset('storage/hero/hero-coiffure.jpeg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="{{ setting('site_name', 'Estuaire Beauty') }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('site_name', 'Estuaire Beauty')) - Salon de Beaute Premium">
    <meta name="twitter:description" content="@yield('description', setting('site_description', 'Votre salon de beaute premium a Bafoussam. Reservez en ligne !'))">
    <meta name="twitter:image" content="{{ asset('storage/hero/hero-coiffure.jpeg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            light: '#D4AF37',
                            DEFAULT: '#D4AF37',
                            dark: '#C5962C',
                        },
                        rose: {
                            light: '#F4C2C2',
                            DEFAULT: '#E8A0BF',
                            dark: '#D4849A',
                        },
                        cream: {
                            light: '#FFFFFF',
                            DEFAULT: '#FFF8F0',
                            dark: '#F5EDE3',
                        }
                    },
                    fontFamily: {
                        'playfair': ['"Playfair Display"', 'serif'],
                        'montserrat': ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        .gold-gradient {
            background: linear-gradient(135deg, #D4AF37, #C5962C);
        }
        .rose-gradient {
            background: linear-gradient(135deg, #F4C2C2, #E8A0BF);
        }
        .text-gold-gradient {
            background: linear-gradient(135deg, #D4AF37, #C5962C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
        }
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-cream font-montserrat text-gray-800 antialiased">

    <!-- Navbar -->
    <nav x-data="{ mobileOpen: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    @if(setting('logo'))
                        <img src="{{ asset('storage/' . setting('logo')) }}" alt="{{ setting('site_name', 'Estuaire Beauty') }}" class="h-12">
                    @else
                        <span class="font-playfair text-2xl font-bold text-gold-gradient">
                            {{ setting('site_name', 'Estuaire Beauty') }}
                        </span>
                    @endif
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="font-montserrat text-sm font-medium tracking-wide uppercase hover:text-gold transition-colors duration-300 {{ request()->is('/') ? 'text-gold' : 'text-gray-700' }}">
                        Accueil
                    </a>
                    <a href="{{ url('/services') }}" class="font-montserrat text-sm font-medium tracking-wide uppercase hover:text-gold transition-colors duration-300 {{ request()->is('services') ? 'text-gold' : 'text-gray-700' }}">
                        Services
                    </a>
                    <a href="{{ url('/galerie') }}" class="font-montserrat text-sm font-medium tracking-wide uppercase hover:text-gold transition-colors duration-300 {{ request()->is('galerie') ? 'text-gold' : 'text-gray-700' }}">
                        Galerie
                    </a>
                    <a href="{{ url('/contact') }}" class="font-montserrat text-sm font-medium tracking-wide uppercase hover:text-gold transition-colors duration-300 {{ request()->is('contact') ? 'text-gold' : 'text-gray-700' }}">
                        Contact
                    </a>
                    <a href="{{ url('/reservation') }}" class="inline-flex items-center px-6 py-2.5 gold-gradient text-white font-montserrat text-sm font-semibold tracking-wide uppercase rounded-full hover:shadow-lg hover:shadow-gold/30 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Reserver
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-700 hover:text-gold transition-colors">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-white/95 backdrop-blur-md border-t border-gold/10">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ url('/') }}" class="block py-2 text-sm font-medium tracking-wide uppercase {{ request()->is('/') ? 'text-gold' : 'text-gray-700' }}">Accueil</a>
                <a href="{{ url('/services') }}" class="block py-2 text-sm font-medium tracking-wide uppercase {{ request()->is('services') ? 'text-gold' : 'text-gray-700' }}">Services</a>
                <a href="{{ url('/galerie') }}" class="block py-2 text-sm font-medium tracking-wide uppercase {{ request()->is('galerie') ? 'text-gold' : 'text-gray-700' }}">Galerie</a>
                <a href="{{ url('/contact') }}" class="block py-2 text-sm font-medium tracking-wide uppercase {{ request()->is('contact') ? 'text-gold' : 'text-gray-700' }}">Contact</a>
                <a href="{{ url('/reservation') }}" class="block w-full text-center py-3 gold-gradient text-white font-semibold text-sm tracking-wide uppercase rounded-full mt-4">Reserver</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <!-- Top section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- About -->
                <div>
                    <h3 class="font-playfair text-2xl font-bold text-gold mb-4">{{ setting('site_name', 'Estuaire Beauty') }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        {{ setting('site_description', 'Votre destination beaute haut de gamme. Nous sublimous votre beaute naturelle avec expertise et passion.') }}
                    </p>
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        @if(setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if(setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @endif
                        @if(setting('tiktok_url'))
                        <a href="{{ setting('tiktok_url') }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1v-3.5a6.37 6.37 0 00-.79-.05A6.34 6.34 0 003.15 15.2a6.34 6.34 0 0010.86 4.48v-7.15a8.16 8.16 0 005.58 2.2v-3.44a4.85 4.85 0 01-3.77-1.83V6.69h3.77z"/></svg>
                        </a>
                        @endif
                        @if(setting('whatsapp_number'))
                        <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-playfair text-lg font-semibold text-white mb-4">Navigation</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-gold transition-colors text-sm">Accueil</a></li>
                        <li><a href="{{ url('/services') }}" class="text-gray-400 hover:text-gold transition-colors text-sm">Nos Services</a></li>
                        <li><a href="{{ url('/galerie') }}" class="text-gray-400 hover:text-gold transition-colors text-sm">Galerie</a></li>
                        <li><a href="{{ url('/reservation') }}" class="text-gray-400 hover:text-gold transition-colors text-sm">Reservation</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-gold transition-colors text-sm">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-playfair text-lg font-semibold text-white mb-4">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gold mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-400 text-sm">{{ setting('address', 'Libreville, Gabon') }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-gray-400 text-sm">{{ setting('phone', '+241 XX XX XX XX') }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-400 text-sm">{{ setting('email', 'contact@estuairebeauty.com') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Opening Hours -->
                <div>
                    <h4 class="font-playfair text-lg font-semibold text-white mb-4">Horaires</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex justify-between">
                            <span>Lundi - Vendredi</span>
                            <span class="text-gold">{{ setting('hours_weekday', '08h - 19h') }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Samedi</span>
                            <span class="text-gold">{{ setting('hours_saturday', '08h - 20h') }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Dimanche</span>
                            <span class="text-gold">{{ setting('hours_sunday', 'Ferme') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} {{ setting('site_name', 'Estuaire Beauty') }}. Tous droits reserves.
                </p>
                <p class="text-gray-500 text-sm mt-2 md:mt-0">
                    Fait avec <span class="text-rose">&#9829;</span> a {{ setting('city', 'Libreville') }}
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
