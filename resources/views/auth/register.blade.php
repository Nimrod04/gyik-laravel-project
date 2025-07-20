@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Regisztráció</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Név</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-gray-700 font-semibold mb-2">Nem</label>
            <select id="gender" name="gender" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gender') border-red-500 @enderror">
                <option value="">Válassz nemet</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Férfi</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nő</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Egyéb</option>
            </select>
            @error('gender')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Jelszó</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Jelszó megerősítése</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex items-center justify-between">
            <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                Már regisztráltál?
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                Regisztráció
            </button>
        </div>
    </form>
</div>
@endsection