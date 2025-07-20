@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-2">{{ $question->questionTitle }}</h1>
    <p class="text-gray-700 mb-2">{{ $question->questionBody }}</p>
    <p class="text-gray-600 mb-4">Szerző: <span class="font-semibold">{{ $question->author->name ?? 'Ismeretlen' }}</span></p>

    <h2 class="text-xl font-semibold mb-4">Válaszok ({{ $question->answers->count() }})</h2>
    <ul class="space-y-4 mb-6">
        @foreach($question->answers as $answer)
        <li class="bg-gray-100 rounded p-4">
            <div class="flex justify-between items-center mb-2">
                <span class="font-semibold">{{ $answer->author->name ?? 'Ismeretlen' }}</span>
                <span class="text-xs text-gray-400">{{ $answer->created_at->diffForHumans() }}</span>
            </div>
            <p class="mb-2">{{ $answer->answerBody }}</p>
            <div class="flex gap-4 text-sm text-gray-500 mb-2">
                <span>👍 {{ $answer->likeCount }}</span>
                <span>👎 {{ $answer->dislikeCount }}</span>
            </div>
            @auth
            <div class="flex gap-2 mb-2">
                <form action="{{ route('answers.like', $answer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-2 py-1 bg-green-100 rounded hover:bg-green-200">👍</button>
                </form>
                <form action="{{ route('answers.dislike', $answer->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-2 py-1 bg-red-100 rounded hover:bg-red-200">👎</button>
                </form>
                <a href="{{ route('answers.edit', $answer->id) }}" class="text-indigo-600 hover:underline">Szerkesztés</a>
                <form action="{{ route('answers.destroy', $answer->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Törlés</button>
                </form>
            </div>
            @endauth
        </li>
        @endforeach
    </ul>

    @auth
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Új válasz beküldése</h3>
        <form action="{{ route('answers.store') }}" method="POST">
            @csrf
            <input type="hidden" name="questionId" value="{{ $question->id }}">
            <textarea name="answerBody" rows="3" required class="w-full border rounded p-2 mb-2" placeholder="Írd be a válaszodat..."></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Válasz beküldése</button>
        </form>
    </div>
    @else
    <p class="mb-6"><a href="{{ route('login') }}" class="text-blue-600 hover:underline">Jelentkezz be</a> a válaszadáshoz vagy szavazáshoz!</p>
    @endauth

    <div class="flex gap-4 mt-4">
        @auth
            <a href="{{ route('questions.edit', $question->id) }}" class="text-indigo-600 hover:underline">Kérdés szerkesztése</a>
            <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Kérdés törlése</button>
            </form>
        @endauth
        <a href="{{ route('questions.index') }}" class="text-gray-600 hover:underline">Vissza a kérdésekhez</a>
    </div>
</div>
@endsection