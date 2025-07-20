@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Profilod</h1>
    <div class="mb-6">
        <div class="mb-2">
            <span class="font-semibold text-gray-700">Név:</span>
            <span class="text-gray-900">{{ auth()->user()->name }}</span>
        </div>
        <div class="mb-2">
            <span class="font-semibold text-gray-700">Email:</span>
            <span class="text-gray-900">{{ auth()->user()->email }}</span>
        </div>
        <div class="mb-2">
            <span class="font-semibold text-gray-700">Nem:</span>
            <span class="text-gray-900">{{ auth()->user()->gender ?? 'Nincs megadva' }}</span>
        </div>
        <div class="mb-2">
            <span class="font-semibold text-gray-700">Regisztráció dátuma:</span>
            <span class="text-gray-900">{{ auth()->user()->created_at->format('Y.m.d H:i') }}</span>
        </div>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">Profil szerkesztése</a>
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">Vissza a dashboardra</a>
    </div>
</div>
@endsection