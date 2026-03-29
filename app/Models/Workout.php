<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'sport',
        'difficulty',
        'duration',
    ];

    protected $casts = [
        'duration' => 'integer',
    ];

    // ── Relations ────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class)->orderBy('order');
    }

    // ── Scopes ──────────────────────────────────────────────

    public function scopeOfUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeBySport($query, string $sport)
    {
        return $query->where('sport', $sport);
    }

    // ── Accessors ────────────────────────────────────────────

    public function getSportLabelAttribute(): string
    {
        return match ($this->sport) {
            'futebol'    => 'Futebol',
            'basquete'   => 'Basquete',
            'natacao'    => 'Natação',
            'ciclismo'   => 'Ciclismo',
            'corrida'    => 'Corrida',
            'tenis'      => 'Tênis',
            'mma'        => 'MMA',
            'volei'      => 'Vôlei',
            'crossfit'   => 'Crossfit',
            'surf'       => 'Surf',
            'atletismo'  => 'Atletismo',
            'musculacao' => 'Musculação',
            default      => ucfirst($this->sport ?? ''),
        };
    }

    public function getDifficultyLabelAttribute(): string
    {
        return match ($this->difficulty) {
            'iniciante'     => 'Iniciante',
            'intermediario' => 'Intermediário',
            'avancado'      => 'Avançado',
            default         => '',
        };
    }
}
