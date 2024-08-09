<div>
    <div class="row">
        <div class="col-6">
            <label>Search</label>
            <input type="text" wire:model.live="searchTerm" placeholder="Search projects by name..."
                class="form-control mb-3 mt-3">
        </div>
        <div class="col-6">
            <label for="user_id">Assign To</label>
            <select name="user_id" id="user_id" required class="form-control mb-3 mt-3"
                wire:model.live="selectedUserId">
                <option value="">All</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                <th scope="col">Assign To</th>
                <th scope="col">Progres</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->deadline }}</td>
                    <td>{{ $project->user_name }}</td>
                    <td>{{ $project->completed_task_count }} task selesai dari {{ $project->task_count }} task
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
