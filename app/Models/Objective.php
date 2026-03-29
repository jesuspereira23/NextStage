<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objective extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',       // ✅ necessário para o firstOrCreate funcionar
        'name',
        'description',
        'category',
        'priority',
        'due_date',
        'completed',
        'completed_at',
    ];

    protected $casts = [
        'completed'    => 'boolean',
        'due_date'     => 'date',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
