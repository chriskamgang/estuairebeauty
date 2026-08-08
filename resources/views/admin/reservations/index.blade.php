@extends('admin.layouts.app')
@section('title', 'Reservations')

@section('content')
    <!-- Filters -->
    <div class="bg-dark-400 rounded-xl border border-dark-100 p-6 mb-6">
        <form method="GET" action="{{ route('admin.reservations.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Date</label>
                <input type="date" name="date" value="{{ request('date') }}"
                    class="bg-dark-300 border border-dark-100 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Statut</label>
                <select name="status" class="bg-dark-300 border border-dark-100 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-gold">
                    <option value="">Tous</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirme</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annule</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Termine</option>
                </select>
            </div>
            <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-6 py-2 rounded-lg transition-colors">Filtrer</button>
            <a href="{{ route('admin.reservations.index') }}" class="text-gray-400 hover:text-white px-4 py-2">Reinitialiser</a>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-dark-400 rounded-xl border border-dark-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-dark-100">
                        <th class="px-6 py-3">Client</th>
                        <th class="px-6 py-3">Telephone</th>
                        <th class="px-6 py-3">Service</th>
                        <th class="px-6 py-3">Staff</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Heure</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr class="border-b border-dark-100 hover:bg-dark-200/50">
                            <td class="px-6 py-4 font-medium text-white">{{ $reservation->client_name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->client_phone }}</td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->service->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->staffMember->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->reservation_time }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-900/50 text-yellow-300',
                                        'confirmed' => 'bg-green-900/50 text-green-300',
                                        'cancelled' => 'bg-red-900/50 text-red-300',
                                        'completed' => 'bg-blue-900/50 text-blue-300',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'En attente',
                                        'confirmed' => 'Confirme',
                                        'cancelled' => 'Annule',
                                        'completed' => 'Termine',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$reservation->status] ?? 'bg-gray-700 text-gray-300' }}">
                                    {{ $statusLabels[$reservation->status] ?? $reservation->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1" x-data="{ open: false }">
                                    <div class="relative">
                                        <button @click="open = !open" class="text-gray-400 hover:text-gold text-sm px-2 py-1 rounded border border-dark-100 hover:border-gold transition-colors">
                                            Statut
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-1 w-36 bg-dark-300 border border-dark-100 rounded-lg shadow-xl z-10">
                                            @foreach(['pending' => 'En attente', 'confirmed' => 'Confirme', 'cancelled' => 'Annule', 'completed' => 'Termine'] as $status => $label)
                                                <form action="{{ route('admin.reservations.updateStatus', $reservation) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-dark-100 {{ $reservation->status === $status ? 'text-gold' : 'text-gray-300' }}">
                                                        {{ $label }}
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Supprimer cette reservation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-6 py-8 text-center text-gray-500">Aucune reservation trouvee</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservations->hasPages())
            <div class="px-6 py-4 border-t border-dark-100">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
@endsection
