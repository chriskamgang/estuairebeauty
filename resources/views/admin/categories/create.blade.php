@extends('admin.layouts.app')
@section('title', 'Ajouter une categorie')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-gold transition-colors">&larr; Retour aux categories</a>
        </div>

        <div class="bg-dark-400 rounded-xl border border-dark-100 p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                </div>

                <div class="mb-5">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-300 mb-2">Icone (classe CSS ou emoji)</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-300 mb-2">Ordre d'affichage</label>
                        <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded bg-dark-300 border-dark-100 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-300">Active</span>
                    </label>
                </div>

                <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-8 py-3 rounded-lg transition-colors">
                    Creer la categorie
                </button>
            </form>
        </div>
    </div>
@endsection
