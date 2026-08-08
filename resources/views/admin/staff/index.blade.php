@extends('admin.layouts.app')
@section('title', 'Equipe')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold">Membres de l'equipe</h3>
        <a href="{{ route('admin.staff.create') }}" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-6 py-2 rounded-lg transition-colors">
            + Ajouter un membre
        </a>
    </div>

    <div class="bg-dark-400 rounded-xl border border-dark-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-dark-100">
                        <th class="px-6 py-3">Photo</th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $member)
                        <tr class="border-b border-dark-100 hover:bg-dark-200/50">
                            <td class="px-6 py-4">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-dark-200 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-white">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $member->role ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs {{ $member->is_active ? 'bg-green-900/50 text-green-300' : 'bg-red-900/50 text-red-300' }}">
                                    {{ $member->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.staff.edit', $member) }}" class="text-blue-400 hover:text-blue-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" onsubmit="return confirm('Supprimer ce membre ?')">
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
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucun membre</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($staff->hasPages())
            <div class="px-6 py-4 border-t border-dark-100">
                {{ $staff->links() }}
            </div>
        @endif
    </div>
@endsection
