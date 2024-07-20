@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>

        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" id="due_date">

        <button type="submit">Add Task</button>
    </form>
@endsection
