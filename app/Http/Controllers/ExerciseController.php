<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * GET /api/exercises
     * Lista exercícios do usuário autenticado (via workouts)
     * Suporta ?workout_id=1
     */
    public function index(Request $request): JsonResponse
    {
        // IDs dos treinos do usuário
        $workoutIds = Workout::where('user_id', auth()->id())
            ->pluck('id');

        $query = Exercise::whereIn('workout_id', $workoutIds)
            ->with('workout:id,title,sport')
            ->orderBy('workout_id')
            ->orderBy('order');

        if ($request->filled('workout_id')) {
            $query->where('workout_id', $request->workout_id);
        }

        $exercises = $query->get()->map(fn($ex) => $this->format($ex));

        return response()->json(['data' => $exercises]);
    }

    /**
     * POST /api/exercises
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'workout_id' => ['required', 'integer', 'exists:workouts,id'],
            'name'       => ['required', 'string', 'max:255'],
            'sets'       => ['nullable', 'integer', 'min:1', 'max:99'],
            'reps'       => ['nullable', 'integer', 'min:1', 'max:999'],
            'rest'       => ['nullable', 'integer', 'min:0', 'max:600'],
            'notes'      => ['nullable', 'string', 'max:500'],
            'order'      => ['nullable', 'integer', 'min:0'],
        ]);

        // Garante que o treino pertence ao usuário
        $this->authorizeWorkout($data['workout_id']);

        $exercise = Exercise::create($data);

        return response()->json(
            ['data' => $this->format($exercise->load('workout:id,title,sport'))],
            201
        );
    }

    /**
     * GET /api/exercises/{exercise}
     */
    public function show(Exercise $exercise): JsonResponse
    {
        $this->authorizeExercise($exercise);

        return response()->json(
            ['data' => $this->format($exercise->load('workout:id,title,sport'))]
        );
    }

    /**
     * PUT /api/exercises/{exercise}
     */
    public function update(Request $request, Exercise $exercise): JsonResponse
    {
        $this->authorizeExercise($exercise);

        $data = $request->validate([
            'workout_id' => ['sometimes', 'integer', 'exists:workouts,id'],
            'name'       => ['sometimes', 'required', 'string', 'max:255'],
            'sets'       => ['nullable', 'integer', 'min:1', 'max:99'],
            'reps'       => ['nullable', 'integer', 'min:1', 'max:999'],
            'rest'       => ['nullable', 'integer', 'min:0', 'max:600'],
            'notes'      => ['nullable', 'string', 'max:500'],
            'order'      => ['nullable', 'integer', 'min:0'],
        ]);

        if (isset($data['workout_id'])) {
            $this->authorizeWorkout($data['workout_id']);
        }

        $exercise->update($data);

        return response()->json(
            ['data' => $this->format($exercise->fresh()->load('workout:id,title,sport'))]
        );
    }

    /**
     * DELETE /api/exercises/{exercise}
     */
    public function destroy(Exercise $exercise): JsonResponse
    {
        $this->authorizeExercise($exercise);

        $exercise->delete();

        return response()->json(null, 204);
    }

    /* ── Private ─────────────────────────────────────────── */

    private function format(Exercise $ex): array
    {
        return [
            'id'         => $ex->id,
            'workout_id' => $ex->workout_id,
            'workout'    => $ex->relationLoaded('workout') ? [
                'id'    => $ex->workout->id,
                'title' => $ex->workout->title,
                'sport' => $ex->workout->sport,
            ] : null,
            'name'       => $ex->name,
            'sets'       => $ex->sets,
            'reps'       => $ex->reps,
            'rest'       => $ex->rest,
            'notes'      => $ex->notes,
            'order'      => $ex->order,
            'created_at' => $ex->created_at->toIso8601String(),
        ];
    }

    private function authorizeWorkout(int $workoutId): void
    {
        $belongs = Workout::where('id', $workoutId)
            ->where('user_id', auth()->id())
            ->exists();

        abort_unless($belongs, 403, 'Este treino não pertence a você.');
    }

    private function authorizeExercise(Exercise $exercise): void
    {
        $belongs = Workout::where('id', $exercise->workout_id)
            ->where('user_id', auth()->id())
            ->exists();

        abort_unless($belongs, 403, 'Ação não autorizada.');
    }
}
