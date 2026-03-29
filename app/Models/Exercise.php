<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_id',
        'name',
        'sets',
        'reps',
        'rest',
        'notes',
        'order',
    ];

    protected $casts = [
        'sets'  => 'integer',
        'reps'  => 'integer',
        'rest'  => 'integer',
        'order' => 'integer',
    ];

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
