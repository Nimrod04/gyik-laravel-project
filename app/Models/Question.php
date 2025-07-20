<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
        protected $fillable = [
        'authorId',
        'questionTitle',
        'questionBody',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'questionId');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'question_category', 'questionId', 'categoryId');
    }
}
