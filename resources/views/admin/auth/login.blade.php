<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Estuaire Beauty Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: { 100: '#2a2a4a', 200: '#1e1e3a', 300: '#1a1a2e', 400: '#16213e', 500: '#0f0f23' },
                        gold: { DEFAULT: '#D4AF37', light: '#e8cc6e', dark: '#b8962e' },
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark-500 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gold">Estuaire Beauty</h1>
            <p class="text-gray-400 mt-2">Espace Administration</p>
        </div>

        <div class="bg-dark-400 rounded-2xl shadow-2xl p-8 border border-dark-100">
            <h2 class="text-xl font-semibold text-white mb-6 text-center">Connexion</h2>

            @if($errors->any())
                <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-colors"
                        placeholder="admin@estuairebeauty.com">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-colors"
                        placeholder="Votre mot de passe">
                </div>

                <button type="submit" class="w-full bg-gold hover:bg-gold-dark text-dark-500 font-semibold py-3 rounded-lg transition-colors">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>
