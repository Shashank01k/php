<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterviewQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'interview_id',
        'question_type',
        'question',
        'answer_type',
        'media_type',
        'instructions',
        'max_file_size',
        'question_order',
        'marks',
        'is_required',
        'is_active',
        'created_by',
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }


    public function options()
    {
        return $this->hasMany(
            InterviewQuestionOption::class,
            'question_id'
        )->orderBy('option_order');
    }
}
