<div>

    <input type="text" wire:model.live="searchTerm" placeholder="Search tasks by name..." class="form-control mb-3 mt-3">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Task</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr id="task-{{ $task->id }}">
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->status }}</td>

                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger"
                            wire:click="deleteTask({{ $task->id }})">Delete</button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
