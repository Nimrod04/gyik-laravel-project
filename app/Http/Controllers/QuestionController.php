<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();

        $questions = \App\Models\Question::with(['answers', 'author', 'categories'])
            ->get()
            ->sortByDesc(function ($q) {
                // Összes válasz like+dislike összege
                return $q->answers->sum(function ($a) {
                    return $a->likeCount + $a->dislikeCount;
                });
            })
            ->take(10);

        return view('questions.index', compact('questions', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('questions.create', compact('categories'));
    }


    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'questionTitle' => 'required|string|max:255',
            'questionBody' => 'required|string',
            'categories' => 'array',
        ]);

        $question = Question::create([
             'authorId' => auth()->id(),
            'questionTitle' => $validated['questionTitle'],
            'questionBody' => $validated['questionBody'],
        ]);

        if ($request->has('categories')) {
            $question->categories()->sync($request->categories);
        }

        return redirect()->route('questions.show', $question->id);
    }

    public function show(string $id)
    {
        $question = Question::with(['answers.author', 'author'])->findOrFail($id);
        return view('questions.show', compact('question'));
    }

    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        $categories = Category::all();
        $selectedCategories = $question->categories->pluck('id')->toArray();
        return view('questions.edit', compact('question', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'questionTitle' => 'required|string|max:255',
            'questionBody' => 'required|string',
            'categories' => 'array',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'questionTitle' => $validated['questionTitle'],
            'questionBody' => $validated['questionBody'],
        ]);

        if ($request->has('categories')) {
            $question->categories()->sync($request->categories);
        } else {
            $question->categories()->detach();
        }

        return redirect()->route('questions.show', $question->id);
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);

        if ($question->authorId !== auth()->id()) {
            abort(403, 'Ezt nem te írtad, nincs jogosultságod törölni.');
        }

        $question->delete();

        return redirect()->route('questions.index');
    }

    public function byCategory(Category $category)
    {
        $questions = $category->questions()->with(['answers', 'author', 'categories'])->get();
        $categories = Category::all();
        return view('questions.index', compact('questions', 'categories', 'category'));
    }
}
