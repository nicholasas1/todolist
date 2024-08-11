<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $user = User::findOrFail($project->user_id);
        $userEmail = $user->email;

        Mail::send('emails.project_created', ['project' => $project], function ($message) use ($project, $userEmail) {
            $message->to($userEmail) // Mengirim email ke user terkait
                ->subject('New Project Created: ' . $project->name);
        });
        return redirect()->route('projects.tasks.create', ['project' => $project->id]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $users = \App\Models\User::all();
        return view('projects.update', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'user_id' => 'required|exists:users,id', // Validate user_id
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully');
    }
}
