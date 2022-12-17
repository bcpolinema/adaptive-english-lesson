<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewScoreRoute extends Model
{
    protected $table = 'v_std_exercises_route';
    public $timestamps = false;

    protected $fillable = [
        'std_learning_id',
        'score_exercise',
        'level_id',
        'ROUTE',
    ];
}
