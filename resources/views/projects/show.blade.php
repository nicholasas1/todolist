@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6">
            <h1>{{ $project->name }}</h1>
            <p>{{ $project->description }}</p>
            <p>End Task: {{ $project->deadline }}</p>

            <p>Progress</p>
            <div style="width: 400px">
                <canvas id="projectProgressChart"></canvas>
            </div>
        </div>
        <div class="col-6">
            <h2>Tasks</h2>

            <a href="{{ route('projects.tasks.create', $project) }}" type="button" class="btn btn-primary">Add New Task</a>
            @livewire('task', ['project' => $project])

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('projectProgressChart').getContext('2d');
            const projectProgressChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Todo', 'Doing', 'Done'],
                    datasets: [{
                        label: 'Task Status',
                        data: [
                            @json($project->tasks->where('status', 'todo')->count()),
                            @json($project->tasks->where('status', 'doing')->count()),
                            @json($project->tasks->where('status', 'done')->count())
                        ],
                        backgroundColor: ['red', 'orange', 'green']
                    }]
                }
            });
        });

        function updateStatus(taskId, status) {
            fetch(`/tasks/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById(`task-${taskId}`);
                        row.querySelectorAll('button').forEach(button => {
                            button.classList.remove('btn-success');
                            button.classList.add('btn-primary');
                        });

                        const button = Array.from(row.querySelectorAll('button')).find(button => button.textContent
                            .trim().toLowerCase() === status);
                        if (button) {
                            button.classList.remove('btn-primary');
                            button.classList.add('btn-success');
                        }
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
