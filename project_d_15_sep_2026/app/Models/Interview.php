<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'instructions',
        'duration',
        'status',
        'is_active',
        'created_by',
    ];

    public function questions()
    {
        return $this->hasMany(InterviewQuestion::class)
            ->orderBy('question_order');
    }
}
