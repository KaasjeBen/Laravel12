<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

class ProjectIndexController extends Controller
{
    public function __invoke(): View
    {
        $projects = Project::paginate(10);

        return view('open.projects.index', compact('projects'));
    }
}
