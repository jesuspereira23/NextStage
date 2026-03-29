<?php

namespace App\Http\Controllers;

use App\Models\EvolutionLog;
use App\Http\Requests\StoreEvolutionLogRequest;
use App\Http\Requests\UpdateEvolutionLogRequest;
use App\Http\Resources\EvolutionLogResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EvolutionLogController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $logs = request()->user()->evolutionLogs()->orderBy('created_at', 'desc')->get();
        return EvolutionLogResource::collection($logs);
    }

    public function store(StoreEvolutionLogRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $log = EvolutionLog::create($validated);

        return (new EvolutionLogResource($log))->response()->setStatusCode(201);
    }

    public function show(EvolutionLog $evolutionLog)
    {
        $this->authorize('view', $evolutionLog);
        return new EvolutionLogResource($evolutionLog);
    }

    public function update(UpdateEvolutionLogRequest $request, EvolutionLog $evolutionLog)
    {
        $this->authorize('update', $evolutionLog);
        $evolutionLog->update($request->validated());

        return new EvolutionLogResource($evolutionLog);
    }

    public function destroy(EvolutionLog $evolutionLog)
    {
        $this->authorize('delete', $evolutionLog);
        $evolutionLog->delete();

        return response()->noContent();
    }
}
