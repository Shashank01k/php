<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'option_key',
        'option_text',
        'is_correct',
        'option_order',
    ];

    public function question()
    {
        return $this->belongsTo(
            InterviewQuestion::class,
            'question_id'
        );
    }
}
