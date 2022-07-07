<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StdLearning extends Model
{
    protected $table = 'm_std_learnings';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subject_id',
        'ts_start',
        'is_validated',
        'ts_exercise',
        'score',
        'next_learning',
        'comment',
        'is_termination',
    ];

    protected $dates = [
        'ts_entri',
    ];
}
