<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
        'question_diagram', // Add the question_diagram field
    ];

    // Fix the relationship method to belong to one Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);  // Corrected to belongTo
    }
}
