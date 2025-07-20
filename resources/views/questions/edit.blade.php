@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Kérdés szerkesztése</h1>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="questionTitle" class="block text-gray-700 font-semibold mb-2">Cím</label>
            <input id="questionTitle" name="questionTitle" type="text" value="{{ old('questionTitle', $question->questionTitle) }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('questionTitle') border-red-500 @enderror">
            @error('questionTitle')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="questionBody" class="block text-gray-700 font-semibold mb-2">Leírás</label>
            <textarea id="questionBody" name="questionBody" rows="5" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('questionBody') border-red-500 @enderror">{{ old('questionBody', $question->questionBody) }}</textarea>
            @error('questionBody')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('questions.show', $question->id) }}" class="text-sm text-gray-600 hover:underline">Vissza</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                Mentés
            </button>
        </div>
    </form>
</div>
@endsection