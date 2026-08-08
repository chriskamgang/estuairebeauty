@extends('admin.layouts.app')
@section('title', 'Galerie')

@section('content')
    <!-- Upload Form -->
    <div class="bg-dark-400 rounded-xl border border-dark-100 p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Ajouter des images</h3>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Images *</label>
                    <input type="file" name="images[]" multiple accept="image/*" required
                        class="w-full px-3 py-2 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gold file:text-dark-500 file:font-semibold file:cursor-pointer file:text-sm">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Titre</label>
                    <input type="text" name="title" class="w-full px-3 py-2 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Categorie</label>
                    <select name="category_id" class="w-full px-3 py-2 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                        <option value="">Aucune</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded bg-dark-300 border-dark-100 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-300">Actif</span>
                    </label>
                    <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-6 py-2 rounded-lg transition-colors">
                        Uploader
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Image Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @forelse($images as $image)
            <div class="bg-dark-400 rounded-xl border border-dark-100 overflow-hidden group relative">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover">
                <div class="p-3">
                    <p class="text-sm font-medium text-white truncate">{{ $image->title ?? 'Sans titre' }}</p>
                    <p class="text-xs text-gray-400">{{ $image->category->name ?? 'Sans categorie' }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="px-2 py-0.5 rounded-full text-xs {{ $image->is_active ? 'bg-green-900/50 text-green-300' : 'bg-red-900/50 text-red-300' }}">
                            {{ $image->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                        <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" onsubmit="return confirm('Supprimer cette image ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">Aucune image dans la galerie</div>
        @endforelse
    </div>

    @if($images->hasPages())
        <div class="mt-6">
            {{ $images->links() }}
        </div>
    @endif
@endsection
