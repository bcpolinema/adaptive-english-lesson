<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'm_levels';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'subject_id',
        'topic_id',
        'is_pretest',
        'content',
        'video',
        'audio',
        'image',
        'youtube',
        'route1',
        'route2',
        'route3',
        'route4',
    ];

    protected $dates = [
        'ts_entri',
    ];

    public function exercise()
    {
        return $this->hasMany(Exercise::class);
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function stdlearnings()
    {
        return $this->hasMany(StdLearning::class);
    }

    public function topStdLearnings(){
        return $this->hasMany(StdLearning::class)->orderBy('score','DESC')->take(1);
    }

}