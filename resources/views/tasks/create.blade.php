@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
        @csrf
        <h1 style="text-align: center">Add Task</h1>


        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="todo">Todo</option>
            <option value="doing">Doing</option>
            <option value="doe">Done</option>
        </select>

        @php
            $today = date('Y-m-d'); // Mengambil tanggal hari ini dalam format Y-m-d
        @endphp


        <label for="due_date">Due Date Max ( {{ $project->deadline }}) </label>
        <input type="date" name="deadline" id="deadline" min="{{ $today }}" max="{{ $project->deadline }}" required>

        <button type="submit">Add Task</button>
    </form>
@endsection
