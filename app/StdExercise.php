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

    public function stdlearnings()
    {
        return $this->belongsTo(StdLearning::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
     
    public function exercises()
    {
        return $this->belongsTo(Exercise::class);
    }
}
