@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Kérdések listája</h1>

    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Kategóriák</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($categories as $cat)
            <a href="{{ route('categories.show', $cat->id) }}"
                class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-blue-100 hover:text-blue-700 transition">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>

    @if(isset($category))
    <div class="mb-4 text-blue-700 font-semibold">
        Csak a(z) "{{ $category->name }}" kategória kérdései láthatók.
        <a href="{{ route('questions.index') }}" class="text-blue-600 hover:underline ms-2">Összes kérdés</a>
    </div>
    @endif

    <a href="{{ route('questions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">Új kérdés felvitele</a>
    <ul class="space-y-4">
        @foreach($questions as $question)
        <li class="bg-white rounded shadow p-4 flex justify-between items-center">
            <div>
                <a href="{{ route('questions.show', $question->id) }}" class="text-lg text-indigo-700 hover:underline font-semibold">
                    {{ $question->questionTitle }}
                </a>
                <span class="text-sm text-gray-500 ml-2">({{ $question->answers->count() }} válasz)</span>
                <div class="flex gap-2 mt-1">
                    @foreach($question->categories as $cat)
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs">{{ $cat->name }}</span>
                    @endforeach
                </div>
            </div>
            <span class="text-xs text-gray-400">Szerző: {{ $question->author->name }}</span>
        </li>
        @endforeach
    </ul>
</div>
@endsection