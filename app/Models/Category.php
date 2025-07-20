<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function questions()
    {
        return $this->belongsToMany(\App\Models\Question::class, 'question_category', 'categoryId', 'questionId');
    }
}
