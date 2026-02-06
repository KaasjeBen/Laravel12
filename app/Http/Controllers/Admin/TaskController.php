<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Models\Activity;
use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:index task')->only('index');
        $this->middleware('permission:create task')->only(['create', 'store']);
        $this->middleware('permission:show task')->only('show');
        $this->middleware('permission:edit task')->only(['edit', 'update']);
        $this->middleware('permission:delete task')->only(['delete', 'destroy']);
    }

    public function index(): View
    {
        $tasks = Task::with(['user', 'project', 'activity', 'labels'])
            ->orderBy('id')
            ->paginate(15);

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $users = User::all();
        $projects = Project::all();
        $activities = Activity::all();
        $labels = Label::all();

        return view('admin.tasks.create', compact('users', 'projects', 'activities', 'labels'));
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $task = new Task();
        $task->task = $data['task'];
        $task->begindate = $data['begindate'];
        $task->enddate = $data['enddate'] ?? null;
        $task->user_id = $data['user_id'] ?? null;
        $task->project_id = $data['project_id'];
        $task->activity_id = $data['activity_id'];
        $task->save();

        $task->labels()->sync($data['labels'] ?? []);

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Taak: ' . $task->task . ' is aangemaakt');
    }

    public function show(Task $task): View
    {
        $task->load(['user', 'project', 'activity', 'labels']);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $users = User::all();
        $projects = Project::all();
        $activities = Activity::all();
        $labels = Label::all();
        $task->load(['user', 'project', 'activity', 'labels']);

        return view('admin.tasks.edit', compact('task', 'users', 'projects', 'activities', 'labels'));
    }

    public function update(TaskStoreRequest $request, Task $task): RedirectResponse
    {
        $data = $request->validated();

        $task->task = $data['task'];
        $task->begindate = $data['begindate'];
        $task->enddate = $data['enddate'] ?? null;
        $task->user_id = $data['user_id'] ?? null;
        $task->project_id = $data['project_id'];
        $task->activity_id = $data['activity_id'];
        $task->save();

        $task->labels()->sync($data['labels'] ?? []);

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Taak: ' . $task->task . ' is gewijzigd');
    }

    public function delete(Task $task): View
    {
        $task->load(['user', 'project', 'activity', 'labels']);

        $users = User::all();
        $projects = Project::all();
        $activities = Activity::all();

        return view('admin.tasks.delete', compact('task', 'users', 'projects', 'activities'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $taskName = $task->task;

        $task->labels()->detach();
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('status', 'Taak: ' . $taskName . ' is verwijderd');
    }
}
