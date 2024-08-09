<?php

namespace App\Livewire;

use App\Models\Project as ModelsProject;
use App\Models\Task;
use Livewire\Component;

class Project extends Component
{
    public $searchTerm = '';
    public $selectedUserId = '';

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

        // Join with users table to get user names
        $projects = $projectsQuery
            ->join('users', 'projects.user_id', '=', 'users.id')
            ->select('projects.*', 'users.name as user_name')
            ->get();

        // Add task statistics to each project
        foreach ($projects as $project) {
            $project->task_count = Task::where('project_id', $project->id)->count();
            $project->completed_task_count = Task::where('project_id', $project->id)->where('status', 'done')->count();
            $project->progress = $project->task_count > 0 ? ($project->completed_task_count / $project->task_count) * 100 : 0;
        }


        return view('livewire.project', [
            'projects' => $projects,
            'users' => $users
        ]);
    }
}
