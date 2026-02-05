<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index project')->only(['index', 'show']);
        $this->middleware('permission:create project')->only(['create', 'store']);
        $this->middleware('permission:edit project')->only(['edit', 'update']);
        $this->middleware('permission:delete project')->only(['delete', 'destroy']);
    }

    public function index(): View
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(ProjectStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $project = new Project();
        $project->name = $data['name'];
        $project->description = $data['description'];
        $project->save();

        return redirect()->route('projects.index')
            ->with('status', "Project {$project->name} is aangemaakt");
    }

    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectUpdateRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        $project->name = $data['name'];
        $project->description = $data['description'];
        $project->save();

        return redirect()->route('projects.index')
            ->with('status', "Project {$project->name} is gewijzigd");
    }

    public function delete(Project $project): View
    {
        return view('admin.projects.delete', compact('project'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $name = $project->name;
        $project->delete();

        return redirect()->route('projects.index')
            ->with('status', "Project {$name} is verwijderd");
    }
}
