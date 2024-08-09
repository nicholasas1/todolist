@extends('layouts.app')

@section('content')
    <h1>Create Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="user_id">Assign To:</label>
        <select name="user_id" id="user_id" required>
            <option value="" hidden>Select</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        @php
            $today = date('Y-m-d'); // Mengambil tanggal hari ini dalam format Y-m-d
        @endphp
        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" min="{{ $today }}" required>

        <button type="submit">Create Project</button>
    </form>
@endsection
