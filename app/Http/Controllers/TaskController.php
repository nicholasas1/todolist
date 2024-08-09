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

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        // Mendapatkan proyek terkait dengan tugas ini
        $project = Project::findOrFail($task->project_id);

        // Mengirimkan data task dan project ke view
        return view('tasks.edit', compact('task', 'project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'status' => 'required|in:todo,doing,done',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        // Get the project associated with this task
        $project = $task->project;

        return redirect()->route('projects.show', ['project' => $project->id])
            ->with('success', 'Task updated successfully');
    }
}
