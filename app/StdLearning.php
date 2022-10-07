<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StdLearning extends Model
{
    protected $table = 'm_std_learnings';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'level_id',
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

    public function stdexercises()
    {
        return $this->hasMany(StdExercise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
