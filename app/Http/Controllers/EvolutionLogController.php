<?php

namespace App\Http\Controllers;

use App\Models\EvolutionLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\EvolutionLogResource;

class EvolutionLogController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $logs = EvolutionLog::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return EvolutionLogResource::collection($logs);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'weight'           => ['nullable', 'numeric', 'min:0'],
            'body_fat'         => ['nullable', 'numeric', 'min:0', 'max:100'],
            'performance_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $log = EvolutionLog::create([
            'user_id'          => auth()->id(),
            'weight'           => $data['weight']           ?? null,
            'body_fat'         => $data['body_fat']         ?? null,
            'performance_note' => $data['performance_note'] ?? null,
        ]);

        return (new EvolutionLogResource($log))
            ->response()
            ->setStatusCode(201);
    }

    public function show(EvolutionLog $evolutionLog): EvolutionLogResource
    {
        $this->checkOwner($evolutionLog);
        return new EvolutionLogResource($evolutionLog);
    }

    public function update(Request $request, EvolutionLog $evolutionLog): EvolutionLogResource
    {
        $this->checkOwner($evolutionLog);

        $data = $request->validate([
            'weight'           => ['nullable', 'numeric', 'min:0'],
            'body_fat'         => ['nullable', 'numeric', 'min:0', 'max:100'],
            'performance_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $evolutionLog->update($data);

        return new EvolutionLogResource($evolutionLog->fresh());
    }

    public function destroy(EvolutionLog $evolutionLog): JsonResponse
    {
        $this->checkOwner($evolutionLog);
        $evolutionLog->delete();
        return response()->json(null, 204);
    }

    private function checkOwner(EvolutionLog $evolutionLog): void
    {
        if ($evolutionLog->user_id !== auth()->id()) {
            abort(403, 'Ação não autorizada.');
        }
    }
}
