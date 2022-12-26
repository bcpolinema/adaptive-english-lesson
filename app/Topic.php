<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'm_topics';
    public $timestamps = false;

    protected $fillable = [
        'subject_id',
        'title',
    ];

    protected $dates = [
        'ts_entri',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function viewlevel()
    {
        return $this->hasMany(ViewLevelRoute::class);
    }

    public function level()
    {
        return $this->hasMany(Level::class);
    }
}