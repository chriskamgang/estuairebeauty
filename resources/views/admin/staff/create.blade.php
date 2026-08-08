@extends('admin.layouts.app')
@section('title', 'Ajouter un membre')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.staff.index') }}" class="text-gray-400 hover:text-gold transition-colors">&larr; Retour a l'equipe</a>
        </div>

        <div class="bg-dark-400 rounded-xl border border-dark-100 p-6">
            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nom *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">
                </div>

                <div class="mb-5">
                    <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                    <input type="text" name="role" id="role" value="{{ old('role') }}"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold"
                        placeholder="Ex: Coiffeuse, Estheticienne...">
                </div>

                <div class="mb-5">
                    <label for="bio" class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                    <textarea name="bio" id="bio" rows="3"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold">{{ old('bio') }}</textarea>
                </div>

                <div class="mb-5">
                    <label for="photo" class="block text-sm font-medium text-gray-300 mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="w-full px-4 py-3 bg-dark-300 border border-dark-100 rounded-lg text-white focus:outline-none focus:border-gold file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:bg-gold file:text-dark-500 file:font-semibold file:cursor-pointer">
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-3">Services assignes</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-48 overflow-y-auto p-3 bg-dark-300 rounded-lg border border-dark-100">
                        @foreach($services as $service)
                            <label class="flex items-center gap-2 cursor-pointer py-1">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded bg-dark-200 border-dark-100 text-gold focus:ring-gold">
                                <span class="text-sm text-gray-300">{{ $service->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded bg-dark-300 border-dark-100 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-300">Actif</span>
                    </label>
                </div>

                <button type="submit" class="bg-gold hover:bg-gold-dark text-dark-500 font-semibold px-8 py-3 rounded-lg transition-colors">
                    Ajouter le membre
                </button>
            </form>
        </div>
    </div>
@endsection
