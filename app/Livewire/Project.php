<?php

namespace App\Livewire;

use App\Models\Project as ModelsProject;
use App\Models\Task;
use Livewire\Component;

class Project extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $projects = ModelsProject::where('name', 'like', '%' . $this->searchTerm . '%')->get();

        // Add task statistics to each project
        foreach ($projects as $project) {
            $project->task_count = Task::where('project_id', $project->id)->count();
            $project->completed_task_count = Task::where('project_id', $project->id)->where('status', 'done')->count();
            $project->progress = $project->task_count > 0 ? ($project->completed_task_count / $project->task_count) * 100 : 0;
        }


        return view('livewire.project', [
            'projects' => $projects,
        ]);
    }
}
