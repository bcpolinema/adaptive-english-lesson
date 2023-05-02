<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'm_subjects';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'thumbnail',
    ];

    protected $dates = [
        'ts_entri',
    ];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function viewlevel()
    {
        return $this->hasMany(ViewLevelRoute::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
    
}