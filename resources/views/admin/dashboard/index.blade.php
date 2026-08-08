@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $cards = [
                ['label' => "Aujourd'hui", 'value' => $stats['today'], 'color' => 'text-blue-400', 'bg' => 'bg-blue-900/30', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label' => 'Cette semaine', 'value' => $stats['week'], 'color' => 'text-green-400', 'bg' => 'bg-green-900/30', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['label' => 'Ce mois', 'value' => $stats['month'], 'color' => 'text-purple-400', 'bg' => 'bg-purple-900/30', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['label' => 'Total', 'value' => $stats['total'], 'color' => 'text-gold', 'bg' => 'bg-yellow-900/30', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
            ];
        @endphp
        @foreach($cards as $card)
            <div class="bg-dark-400 rounded-xl p-6 border border-dark-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-400">{{ $card['label'] }}</p>
                        <p class="text-3xl font-bold {{ $card['color'] }} mt-1">{{ $card['value'] }}</p>
                    </div>
                    <div class="p-3 rounded-lg {{ $card['bg'] }}">
                        <svg class="w-6 h-6 {{ $card['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/></svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Reservations -->
    <div class="bg-dark-400 rounded-xl border border-dark-100">
        <div class="px-6 py-4 border-b border-dark-100 flex items-center justify-between">
            <h3 class="text-lg font-semibold">Reservations recentes</h3>
            <a href="{{ route('admin.reservations.index') }}" class="text-sm text-gold hover:text-gold-light transition-colors">Voir tout</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-dark-100">
                        <th class="px-6 py-3">Client</th>
                        <th class="px-6 py-3">Service</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Heure</th>
                        <th class="px-6 py-3">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentReservations as $reservation)
                        <tr class="border-b border-dark-100 hover:bg-dark-200/50">
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">{{ $reservation->client_name }}</div>
                                <div class="text-sm text-gray-400">{{ $reservation->client_phone }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $reservation->service->name ?? '-' }}</td>
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
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucune reservation</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
