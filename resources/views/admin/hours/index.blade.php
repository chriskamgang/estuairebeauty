@extends('admin.layouts.app')
@section('title', 'Horaires')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-dark-400 rounded-xl border border-dark-100 overflow-hidden">
            <form action="{{ route('admin.hours.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-400 border-b border-dark-100">
                                <th class="px-6 py-3">Jour</th>
                                <th class="px-6 py-3">Ouverture</th>
                                <th class="px-6 py-3">Fermeture</th>
                                <th class="px-6 py-3">Ferme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hours as $hour)
                                <tr class="border-b border-dark-100">
                                    <td class="px-6 py-4 font-medium text-white">{{ $hour->day_name }}</td>
                                    <td class="px-6 py-4">
                                        <input type="time" name="hours[{{ $hour->id }}][open_time]" value="{{ $hour->open_time ? \Carbon\Carbon::parse($hour->open_time)->format('H:i') : '' }}"
                                            class="bg-dark-300 border border-dark-100 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-gold">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="time" name="hours[{{ $hour->id }}][close_time]" value="{{ $hour->close_time ? \Carbon\Carbon::parse($hour->close_time)->format('H:i') : '' }}"
                                            class="bg-dark-300 border border-dark-100 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-gold">
                                    </td>
                                    <td class="px-6 py-4">
                                        <label class="cursor-pointer">
                                            <input type="checkbox" name="hours[{{ $hour->id }}][is_closed]" value="1" {{ $hour->is_closed ? 'checked' : '' }}
                                                class="w-5 h-5 rounded bg-dark-300 border-dark-100 text-red-500 focus:ring-red-500">
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-dark-100">
                    <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-8 py-3 rounded-lg transition-colors">
                        Enregistrer les horaires
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
