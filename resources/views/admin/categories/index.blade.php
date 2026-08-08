@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold">Liste des categories</h3>
        <a href="{{ route('admin.categories.create') }}" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-6 py-2 rounded-lg transition-colors">
            + Ajouter une categorie
        </a>
    </div>

    <div class="bg-dark-400 rounded-xl border border-dark-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-dark-100">
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Icone</th>
                        <th class="px-6 py-3">Ordre</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-dark-100 hover:bg-dark-200/50">
                            <td class="px-6 py-4 font-medium text-white">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ Str::limit($category->description, 50) }}</td>
                            <td class="px-6 py-4 text-sm">{{ $category->icon ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $category->order ?? 0 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs {{ $category->is_active ? 'bg-green-900/50 text-green-300' : 'bg-red-900/50 text-red-300' }}">
                                    {{ $category->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-400 hover:text-blue-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette categorie ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">Aucune categorie</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-dark-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
