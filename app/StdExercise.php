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

    public function stdlearning()
    {
        return $this->belongsTo(StdLearning::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
