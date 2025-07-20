<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'questionId' => 'required|exists:questions,id',
            'answerBody' => 'required|string',
        ]);

        $answer = Answer::create([
            'authorId' => auth()->id(),
            'questionId' => $request->questionId,
            'answerBody' => $request->answerBody,
        ]);

        return redirect()->route('questions.show', $validated['questionId']);
    }

    public function edit(string $id)
    {
        $answer = Answer::findOrFail($id);
        return view('answers.edit', compact('answer'));
    }

    public function update(Request $request, string $id)
    {
        $answer = Answer::findOrFail($id);
        $validated = $request->validate([
            'answerBody' => 'required|string',
        ]);
        $answer->update($validated);

        return redirect()->route('questions.show', $answer->questionId);
    }

    public function destroy(string $id)
    {
        $answer = Answer::findOrFail($id);

        if ($answer->authorId !== auth()->id()) {
            abort(403, 'Ezt nem te írtad, nincs jogosultságod törölni.');
        }

        $questionId = $answer->questionId;
        $answer->delete();

        return redirect()->route('questions.show', $questionId);
    }

    public function like($id)
    {
        $answer = Answer::findOrFail($id);
        $userId = auth()->id();

        $existing = \DB::table('answer_votes')->where([
            ['user_id', '=', $userId],
            ['answer_id', '=', $id],
        ])->first();

        if ($existing) {
            if ($existing->type === 'dislike') {
                \DB::table('answer_votes')->where('id', $existing->id)->update(['type' => 'like']);
                $answer->increment('likeCount');
                $answer->decrement('dislikeCount');
            }
        } else {
            \DB::table('answer_votes')->insert([
                'user_id' => $userId,
                'answer_id' => $id,
                'type' => 'like',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $answer->increment('likeCount');
        }

        return back();
    }

    public function dislike($id)
    {
        $answer = Answer::findOrFail($id);
        $userId = auth()->id();

        $existing = \DB::table('answer_votes')->where([
            ['user_id', '=', $userId],
            ['answer_id', '=', $id],
        ])->first();

        if ($existing) {
            if ($existing->type === 'like') {
                \DB::table('answer_votes')->where('id', $existing->id)->update(['type' => 'dislike']);
                $answer->increment('dislikeCount');
                $answer->decrement('likeCount');
            }
        } else {
            \DB::table('answer_votes')->insert([
                'user_id' => $userId,
                'answer_id' => $id,
                'type' => 'dislike',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $answer->increment('dislikeCount');
        }
        return back();
    }
}
