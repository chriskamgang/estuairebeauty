@extends('admin.layouts.app')
@section('title', 'Modifier le service')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.services.index') }}" class="text-gray-400 hover:text-gold transition-colors">&larr; Retour aux services</a>
        </div>

        <div class="bg-dark-400 rounded-xl border border-dark-100 p-6">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                </div>

                <div class="mb-5">
                    <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Categorie *</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                        <option value="">Choisir une categorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Prix (FCFA) *</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required min="0"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-300 mb-2">Duree (min) *</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" required min="1"
                            class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image</label>
                    @if($service->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-32 h-32 rounded-lg object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-gold file:text-dark-500 file:font-semibold file:cursor-pointer">
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded bg-dark-300 border-dark-100 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-300">Actif</span>
                    </label>
                </div>

                <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-8 py-3 rounded-lg transition-colors">
                    Mettre a jour
                </button>
            </form>
        </div>
    </div>
@endsection
