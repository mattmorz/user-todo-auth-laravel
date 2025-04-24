<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToDo;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(ToDo::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'boolean',
            'icon_path' => 'nullable|string|max:255',
        ]);

        $todo = ToDo::create($validated);

        return response()->json($todo, 201);
    }

    public function show($id)
    {
        $todo = ToDo::find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        return response()->json($todo, 200);
    }

    public function update(Request $request, $id)
    {
        $todo = ToDo::find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'completed' => 'boolean',
            'icon_path' => 'nullable|string|max:255',
        ]);

        $todo->update($validated);

        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        $todo = ToDo::find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }

        $todo->delete();

        return response()->json(['message' => 'Todo deleted'], 204);
    }
}