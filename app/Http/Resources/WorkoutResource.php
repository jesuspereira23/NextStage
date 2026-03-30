<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'title'            => $this->title,
            'sport'            => $this->sport,
            'sport_label'      => $this->sport_label,
            'difficulty'       => $this->difficulty,
            'difficulty_label' => $this->difficulty_label,
            'duration'         => $this->duration,
            'exercises_count'  => $this->exercises_count ?? $this->exercises->count(),
            'exercises'        => $this->whenLoaded(
                'exercises',
                fn() => $this->exercises->map(fn($ex) => [
                    'id'    => $ex->id,
                    'name'  => $ex->name,
                    'sets'  => $ex->sets,
                    'reps'  => $ex->reps,
                    'rest'  => $ex->rest,
                    'notes' => $ex->notes,
                    'order' => $ex->order,
                ])
            ),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
