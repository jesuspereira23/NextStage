<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Http\Resources\WorkoutResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
{
    /**
     * GET /api/workouts
     * Suporta ?sport=futebol&difficulty=iniciante
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Workout::ofUser(auth()->id())
            ->withCount('exercises')
            ->with('exercises')
            ->latest();

        if ($request->filled('sport')) {
            $query->bySport($request->sport);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        return WorkoutResource::collection($query->get());
    }

    /**
     * POST /api/workouts
     * Cria treino + exercícios em uma transação
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title'              => ['required', 'string', 'max:255'],
            'sport'              => ['nullable', 'string', 'max:50'],
            'difficulty'         => ['nullable', 'in:iniciante,intermediario,avancado'],
            'duration'           => ['nullable', 'integer', 'min:1', 'max:600'],
            'exercises'          => ['nullable', 'array'],
            'exercises.*.name'   => ['required', 'string', 'max:255'],
            'exercises.*.sets'   => ['nullable', 'integer', 'min:1'],
            'exercises.*.reps'   => ['nullable', 'integer', 'min:1'],
            'exercises.*.rest'   => ['nullable', 'integer', 'min:0'],
            'exercises.*.notes'  => ['nullable', 'string', 'max:500'],
        ]);

        $workout = DB::transaction(function () use ($data) {
            $workout = Workout::create([
                'user_id'    => auth()->id(),
                'title'      => $data['title'],
                'sport'      => $data['sport'] ?? null,
                'difficulty' => $data['difficulty'] ?? null,
                'duration'   => $data['duration'] ?? null,
            ]);

            foreach ($data['exercises'] ?? [] as $idx => $ex) {
                $workout->exercises()->create([
                    'name'  => $ex['name'],
                    'sets'  => $ex['sets']  ?? null,
                    'reps'  => $ex['reps']  ?? null,
                    'rest'  => $ex['rest']  ?? null,
                    'notes' => $ex['notes'] ?? null,
                    'order' => $idx,
                ]);
            }

            return $workout->load('exercises');
        });

        return (new WorkoutResource($workout))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * GET /api/workouts/{workout}
     */
    public function show(Workout $workout): WorkoutResource
    {
        $this->authorize($workout);

        return new WorkoutResource($workout->load('exercises'));
    }

    /**
     * PUT /api/workouts/{workout}
     * Recria os exercícios (replace strategy)
     */
    public function update(Request $request, Workout $workout): WorkoutResource
    {
        $this->authorize($workout);

        $data = $request->validate([
            'title'              => ['sometimes', 'required', 'string', 'max:255'],
            'sport'              => ['nullable', 'string', 'max:50'],
            'difficulty'         => ['nullable', 'in:iniciante,intermediario,avancado'],
            'duration'           => ['nullable', 'integer', 'min:1', 'max:600'],
            'exercises'          => ['nullable', 'array'],
            'exercises.*.name'   => ['required', 'string', 'max:255'],
            'exercises.*.sets'   => ['nullable', 'integer', 'min:1'],
            'exercises.*.reps'   => ['nullable', 'integer', 'min:1'],
            'exercises.*.rest'   => ['nullable', 'integer', 'min:0'],
            'exercises.*.notes'  => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($data, $workout) {
            $workout->update([
                'title'      => $data['title']      ?? $workout->title,
                'sport'      => $data['sport']      ?? $workout->sport,
                'difficulty' => $data['difficulty'] ?? $workout->difficulty,
                'duration'   => $data['duration']   ?? $workout->duration,
            ]);

            if (array_key_exists('exercises', $data)) {
                // Substitui todos os exercícios
                $workout->exercises()->delete();

                foreach ($data['exercises'] ?? [] as $idx => $ex) {
                    $workout->exercises()->create([
                        'name'  => $ex['name'],
                        'sets'  => $ex['sets']  ?? null,
                        'reps'  => $ex['reps']  ?? null,
                        'rest'  => $ex['rest']  ?? null,
                        'notes' => $ex['notes'] ?? null,
                        'order' => $idx,
                    ]);
                }
            }
        });

        return new WorkoutResource($workout->fresh()->load('exercises'));
    }

    /**
     * DELETE /api/workouts/{workout}
     */
    public function destroy(Workout $workout): JsonResponse
    {
        $this->authorize($workout);

        $workout->delete();

        return response()->json(null, 204);
    }

    // ── Private ──────────────────────────────────────────────

    private function authorize(Workout $workout): void
    {
        abort_if(
            $workout->user_id !== auth()->id(),
            403,
            'Ação não autorizada.'
        );
    }
}
