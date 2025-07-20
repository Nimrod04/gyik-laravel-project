@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Válasz szerkesztése</h1>
    <form method="POST" action="{{ route('answers.update', $answer->id) }}">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="answerBody" class="block text-gray-700 font-semibold mb-2">Válasz szövege</label>
            <textarea id="answerBody" name="answerBody" rows="4" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('answerBody') border-red-500 @enderror">{{ old('answerBody', $answer->answerBody) }}</textarea>
            @error('answerBody')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('questions.show', $answer->questionId) }}" class="text-sm text-gray-600 hover:underline">Vissza</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">
                Mentés
            </button>
        </div>
    </form>
</div>
@endsection