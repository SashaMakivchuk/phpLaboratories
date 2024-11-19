<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'creator_user_id',
    ];

    public $timestamps = true;

    // Відношення до моделі User
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
}
