<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewLevelRoute extends Model
{
    protected $table = 'v_level_title';
    public $timestamps = false;

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

}