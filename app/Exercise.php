<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'm_exercises';
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'answer_key',
        'weight',
    ];

    protected $dates = [
        'ts_entri',
    ];

    public function level()
    {
        return $this->belongsTo(Subject::class);
    }

    public function stdexercises()
    {
        return $this->hasMany(StdExercise::class);
    }
}
