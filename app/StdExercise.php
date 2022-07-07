<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StdExercise extends Model
{
    protected $table = 'm_std_exercises';
    public $timestamps = false;

    protected $fillable = [
        'learning_id',
        'user_id',
        'exercise_id',
        'answer',
        'is_correct',
        'score',
    ];

    protected $dates = [
        'ts_entri',
    ];
}
