<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('questions.index');
});

Route::get('/dashboard', function () {
    $questions = \App\Models\Question::where('authorId', auth()->id())->get();
    return view('dashboard', compact('questions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('questions', \App\Http\Controllers\QuestionController::class);
Route::resource('answers', \App\Http\Controllers\AnswerController::class);

Route::post('/answers/{answer}/like', [\App\Http\Controllers\AnswerController::class, 'like'])->name('answers.like');
Route::post('/answers/{answer}/dislike', [\App\Http\Controllers\AnswerController::class, 'dislike'])->name('answers.dislike');

Route::get('/categories/{category}', [\App\Http\Controllers\QuestionController::class, 'byCategory'])->name('categories.show');