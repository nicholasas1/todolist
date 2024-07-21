@extends('layouts.app')
@section('content')
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add New Project</a>
    @livewire('project')
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/tasks/todays')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let taskList = data.map(task => task.name).join(', ');
                        let toastBody = document.getElementById('taskToastBody');
                        toastBody.textContent = 'Tasks to be completed today: ' + taskList;

                        let toast = new bootstrap.Toast(document.getElementById('taskToast'));
                        toast.show();
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
