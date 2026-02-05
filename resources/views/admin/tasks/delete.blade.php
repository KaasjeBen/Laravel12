@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Taak verwijderen</h2>

<form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="space-y-4">
    @csrf
    @method('DELETE')
    <div>
        <label class="block mb-1">Taak</label>
        <input type="text" name="task" class="w-full border p-2" value="{{ $task->task }}" disabled>
    </div>
    <div>
        <label class="block mb-1">Begindatum</label>
        <input type="date" name="begindate" class="w-full border p-2" value="{{ $task->begindate?->toDateString() }}" disabled>
    </div>
    <div>
        <label class="block mb-1">Einddatum</label>
        <input type="date" name="enddate" class="w-full border p-2" value="{{ $task->enddate?->toDateString() }}" disabled>
    </div>
    <div>
        <label class="block mb-1">Gebruiker</label>
        <select name="user_id" class="w-full border p-2" disabled>
            <option value="">-- kies gebruiker --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" @selected($task->user_id == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Project</label>
        <select name="project_id" class="w-full border p-2" disabled>
            @foreach($projects as $project)
            <option value="{{ $project->id }}" @selected($task->project_id == $project->id)>{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Activity</label>
        <select name="activity_id" class="w-full border p-2" disabled>
            @foreach($activities as $activity)
            <option value="{{ $activity->id }}" @selected($task->activity_id == $activity->id)>{{ $activity->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Labels</label>
        <select name="labels[]" class="w-full border p-2" multiple disabled>
            @foreach($task->labels as $label)
            <option value="{{ $label->id }}" selected>{{ $label->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-4 py-2 bg-red-600 text-white">Verwijderen</button>
</form>
@endsection