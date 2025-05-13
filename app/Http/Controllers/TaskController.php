<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function index(Request $request)
{
    $query = Task::query();

    // Search by title
    if ($request->has('title') && $request->title != '') {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    // Filter by status
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $tasks = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('tasks.index', compact('tasks'));
}
	
	public function create()
{
    return view('tasks.create'); // This should point to your Blade form view
}


   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|min:3',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in-progress,completed',
        'due_date' => 'nullable|date',
    ]);

    \App\Models\Task::create($validated);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}


	public function edit($id)
{
    $task = Task::findOrFail($id);
    return view('tasks.edit', compact('task'));
}
	
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return $task;
    }

    // Update a task
  public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);

    $request->validate([
        'title' => 'required|min:3',
        'description' => 'required',
        'status' => 'required|in:pending,in-progress,completed',
        'due_date' => 'nullable|date',
    ]);

    $task->update($request->all());

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

    // Delete a task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

}
