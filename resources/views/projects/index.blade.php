@extends('layouts.app')
@section('content')
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}">Add New Project</a>
    <ul>
        @foreach ($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
