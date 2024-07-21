@extends('layouts.app')
@section('content')
    <h1>Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add New Project</a>
    @livewire('project')
@endsection
