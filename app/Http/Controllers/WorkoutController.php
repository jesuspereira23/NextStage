<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use App\Http\Resources\WorkoutResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
{
    /**
     * GET /api/workouts
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        // Garante que pegamos apenas os treinos do usuário logado
        $query = Workout::where('user_id', auth()->id())
            ->withCount('exercises')
            ->with('exercises')
            ->latest();

        if ($request->filled('sport')) {
            $query->where('sport', $request->sport);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        return WorkoutResource::collection($query->get());
    }

    /**
     * POST /api/workouts
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title'              => ['required', 'string', 'max:255'],
            'sport'              => ['required', 'string', 'max:50'],
            'difficulty'         => ['nullable', 'string'],
            'duration'           => ['nullable', 'integer', 'min:1'],
            'exercises'          => ['nullable', 'array'],
            'exercises.*.name'   => ['required_with:exercises', 'string', 'max:255'],
            'exercises.*.sets'   => ['nullable', 'integer'],
            'exercises.*.reps'   => ['nullable', 'integer'],
        ]);

        try {
            $workout = DB::transaction(function () use ($data) {
                $workout = Workout::create([
                    'user_id'    => auth()->id(),
                    'title'      => $data['title'],
                    'sport'      => $data['sport'],
                    'difficulty' => $data['difficulty'] ?? null,
                    'duration'   => $data['duration'] ?? null,
                ]);

                if (!empty($data['exercises'])) {
                    foreach ($data['exercises'] as $idx => $ex) {
                        $workout->exercises()->create([
                            'name'  => $ex['name'],
                            'sets'  => $ex['sets'] ?? null,
                            'reps'  => $ex['reps'] ?? null,
                            'order' => $idx,
                        ]);
                    }
                }

                return $workout->load('exercises');
            });

            return (new WorkoutResource($workout))
                ->response()
                ->setStatusCode(201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao salvar treino',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Workout $workout): WorkoutResource
    {
        $this->checkOwner($workout);
        return new WorkoutResource($workout->load('exercises'));
    }

    /**
     * PUT /api/workouts/{workout}
     */
    public function update(Request $request, Workout $workout): WorkoutResource
    {
        $this->checkOwner($workout);

        $data = $request->validate([
            'title'              => ['sometimes', 'required', 'string', 'max:255'],
            'sport'              => ['nullable', 'string', 'max:50'],
            'difficulty'         => ['nullable', 'string'],
            'duration'           => ['nullable', 'integer', 'min:1'],
            'exercises'          => ['nullable', 'array'],
            'exercises.*.name'   => ['required', 'string', 'max:255'],
            'exercises.*.sets'   => ['nullable', 'integer'],
            'exercises.*.reps'   => ['nullable', 'integer'],
        ]);

        DB::transaction(function () use ($data, $workout) {
            $workout->update([
                'title'      => $data['title']      ?? $workout->title,
                'sport'      => $data['sport']      ?? $workout->sport,
                'difficulty' => $data['difficulty'] ?? $workout->difficulty,
                'duration'   => $data['duration']   ?? $workout->duration,
            ]);

            if (isset($data['exercises'])) {
                $workout->exercises()->delete();
                foreach ($data['exercises'] as $idx => $ex) {
                    $workout->exercises()->create([
                        'name'  => $ex['name'],
                        'sets'  => $ex['sets']  ?? null,
                        'reps'  => $ex['reps']  ?? null,
                        'order' => $idx,
                    ]);
                }
            }
        });

        return new WorkoutResource($workout->fresh()->load('exercises'));
    }

    public function destroy(Workout $workout): JsonResponse
    {
        $this->checkOwner($workout);
        $workout->delete();
        return response()->json(null, 204);
    }

    /**
     * Substitui o $this->authorize para evitar erro 500 caso não tenha Policies
     */
    private function checkOwner(Workout $workout): void
    {
        if ($workout->user_id !== auth()->id()) {
            abort(403, 'Ação não autorizada.');
        }
    }
}
