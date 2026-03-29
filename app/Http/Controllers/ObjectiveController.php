<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function index()
    {
        return auth()->user()->objectives;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'priority'    => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        return auth()->user()->objectives()->create($data);
    }

    public function show(Objective $objective)
    {
        return $objective;
    }

    public function update(Request $request, Objective $objective)
    {
        $data = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'priority'    => 'nullable|string',
            'due_date'    => 'nullable|date',
            'completed'   => 'nullable|boolean',
        ]);

        $objective->update($data);
        return $objective;
    }

    public function destroy(Objective $objective)
    {
        $objective->delete();
        return response()->json(['ok' => true]);
    }

    public function toggle(Objective $objective)
    {
        $objective->update([
            'completed'    => !$objective->completed,
            'completed_at' => !$objective->completed ? now() : null,
        ]);
        return $objective;
    }
}
