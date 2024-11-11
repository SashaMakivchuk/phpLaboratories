<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'code',
        'author',
        'budget',
        'rating1',
        'rating2',
        'rating3',
    ];

    public $timestamps = true;
}
