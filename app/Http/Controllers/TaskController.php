<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    // Store a newly created task in storage
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:todo,doing,done',
            'due_date' => 'nullable|date',
        ]);

        $project->tasks()->create($request->all());

        // Redirect back to the same create task page with a session flag
        return redirect()->route('projects.show', ['project' => $project->id])
            ->with('task_added', true);
    }

    public function getTodaysTasks()
    {
        $today = now()->toDateString();
        $tasksDueToday = Task::where('due_date', $today)
            ->where('status', '!=', 'done')
            ->get();

        return $tasksDueToday;
    }
}
