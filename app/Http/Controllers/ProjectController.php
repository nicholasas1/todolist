<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'user_id' => 'required', // Ensure user_id is validated
        ]);

        $project = Project::create($request->all());

        return redirect()->route('projects.tasks.create', ['project' => $project->id]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }
}
