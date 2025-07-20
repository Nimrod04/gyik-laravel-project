@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Új kérdés felvitele</h1>
    @auth
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="questionTitle" class="block text-gray-700 font-semibold mb-2">Cím</label>
            <input type="text" name="questionTitle" id="questionTitle" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="questionBody" class="block text-gray-700 font-semibold mb-2">Kérdés leírása</label>
            <textarea name="questionBody" id="questionBody" rows="5" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        @if(isset($categories) && count($categories))
        <div class="mb-4">
            <label for="categories" class="block text-gray-700 font-semibold mb-2">Kategóriák</label>
            <select name="categories[]" id="categories" multiple
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('questions.index') }}" class="text-gray-600 hover:underline">Vissza a kérdésekhez</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                Kérdés mentése
            </button>
        </div>
    </form>
    @else
    <p class="text-center text-gray-600">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Jelentkezz be</a> a kérdés felviteléhez!
    </p>
    @endauth
</div>
@endsection