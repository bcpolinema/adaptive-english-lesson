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
}
