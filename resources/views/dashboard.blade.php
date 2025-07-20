@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Saját kérdéseid</h1>
    @if($questions->count())
        <ul class="space-y-4">
            @foreach($questions as $question)
                <li class="bg-gray-100 rounded p-4 flex justify-between items-center">
                    <div>
                        <a href="{{ route('questions.show', $question->id) }}" class="text-lg text-indigo-700 hover:underline font-semibold">
                            {{ $question->questionTitle }}
                        </a>
                        <div class="text-sm text-gray-500 mt-1">
                            {{ $question->created_at->format('Y.m.d H:i') }} &middot; {{ $question->answers->count() }} válasz
                        </div>
                    </div>
                    <a href="{{ route('questions.edit', $question->id) }}" class="text-xs text-blue-600 hover:underline">Szerkesztés</a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 text-center">Nincs saját kérdésed.</p>
    @endif
</div>
@endsection