<?php

namespace App\Livewire;

use App\Models\Task as ModelsTask;
use Livewire\Component;

class Task extends Component
{
    public $project;
    public $searchTerm = '';

    public function render()
    {
        $tasks = ModelsTask::where('project_id', $this->project->id)
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->get();

        return view('livewire.task', [
            'tasks' => $tasks,
        ]);
    }
    public function updateStatus($taskId, $status)
    {
        $task = ModelsTask::find($taskId);
        $task->status = $status;
        $task->save();

       
    }
}
