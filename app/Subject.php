<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'm_subjects';
    public $timestamps = false;

    protected $fillable = [
        'title',
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
}
