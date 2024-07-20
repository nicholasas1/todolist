@extends('layouts.app')

@section('content')
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <p>Deadline: {{ $project->deadline }}</p>

    <h2>Progress</h2>
    <canvas id="projectProgressChart" width="400" height="400"></canvas>

    <h2>Tasks</h2>
    <ul>
        @foreach ($project->tasks as $task)
            <li>{{ $task->name }} - {{ $task->status }}</li>
        @endforeach
    </ul>

    <a href="{{ route('projects.tasks.create', $project) }}">Add New Task</a>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('projectProgressChart').getContext('2d');
            const projectProgressChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'In Progress', 'Completed'],
                    datasets: [{
                        label: 'Task Status',
                        data: [
                            @json($project->tasks->where('status', 'pending')->count()),
                            @json($project->tasks->where('status', 'in_progress')->count()),
                            @json($project->tasks->where('status', 'completed')->count())
                        ],
                        backgroundColor: ['red', 'orange', 'green']
                    }]
                }
            });
        });
    </script>
@endsection
