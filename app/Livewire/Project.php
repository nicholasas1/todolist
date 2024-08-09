<?php

namespace App\Livewire;

use App\Models\Project as ModelsProject;
use App\Models\Task;
use Livewire\Component;

class Project extends Component
{
    public $searchTerm = '';
    public $selectedUserId = '';
    public $status = 'in-progress'; 

    public function render()
    {

        $users = \App\Models\User::all();

        $projectsQuery = ModelsProject::query();

        // Filter by project name
        if ($this->searchTerm) {
            $projectsQuery->where('projects.name', 'like', '%' . $this->searchTerm . '%');
        }

        // Filter by selected user ID
        if ($this->selectedUserId) {
            $projectsQuery->where('projects.user_id', $this->selectedUserId);
        }

        if ($this->status) {
            $projectsQuery->where('projects.status', $this->status);
        }

        // Join with users table to get user names
        $projects = $projectsQuery
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->select('projects.*', 'users.name as user_name')
            ->orderBy('deadline', 'asc')
            ->get();

        // Add task statistics to each project
        foreach ($projects as $project) {
            $taskCount = Task::where('project_id', $project->id)->count();
            $completedTaskCount = Task::where('project_id', $project->id)->where('status', 'done')->count();
            $progress = $taskCount > 0 ? ($completedTaskCount / $taskCount) * 100 : 0;

            // Check if project is completed
            if ($progress == 100 && $project->status !== 'completed') {
                $project->status = 'completed';
                $project->save(); // Only save the status, not the calculated fields
            }

            // Assign calculated values for display purposes only
            $project->task_count = $taskCount;
            $project->completed_task_count = $completedTaskCount;
            $project->progress = $progress;
        }


        return view('livewire.project', [
            'projects' => $projects,
            'users' => $users
        ]);
    }

    public function deleteProject($projectId)
    {
        $project = ModelsProject::findOrFail($projectId);
        $project->delete();

        // Refresh the project list after deletion
        $this->render();
    }
}
