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

                        @if ($task->status !== 'doing' && $task->status !== 'done')
                            <button type="button" class="btn btn-danger"
                                wire:click="updateStatus({{ $task->id }}, 'doing')">Do</button>
                        @endif
                        @if ($task->status === 'doing')
                            <button type="button" class="btn btn-primary"
                                wire:click="updateStatus({{ $task->id }}, 'done')">Done</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
