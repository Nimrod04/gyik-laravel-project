<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
        protected $fillable = [
        'questionId',
        'authorId',
        'answerBody',
        'likeCount',
        'dislikeCount',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }
}
