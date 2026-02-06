@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Taak bewerken</h2>

<form method="POST" action="{{ route('tasks.update', $task->id) }}" class="space-y-4">
    @csrf
    @method('PUT')
    @if($errors->any())
    <div class="p-3 bg-red-100 text-red-800 rounded">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div>
        <label class="block mb-1">Taak</label>
        <input type="text" name="task" class="w-full border p-2" value="{{ old('task', $task->task) }}">
        @error('task')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Begindatum</label>
        <input type="date" name="begindate" class="w-full border p-2" value="{{ old('begindate', $task->begindate?->toDateTimeString()) }}">
        @error('begindate')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Einddatum</label>
        <input type="date" name="enddate" class="w-full border p-2" value="{{ old('enddate', $task->enddate?->toDateTimeString()) }}">
        @error('enddate')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Gebruiker</label>
        <select name="user_id" class="w-full border p-2">
            <option value="">-- kies gebruiker --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" @selected(old('user_id', $task->user_id) == $user->id)>{!! $user->name !!}</option>
            @endforeach
        </select>
        @error('user_id')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Project</label>
        <select name="project_id" class="w-full border p-2">
            @foreach($projects as $project)
            <option value="{{ $project->id }}" @selected(old('project_id', $task->project_id) == $project->id)>{{ $project->name }}</option>
            @endforeach
        </select>
        @error('project_id')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Activity</label>
        <select name="activity_id" class="w-full border p-2">
            @foreach($activities as $activity)
            <option value="{{ $activity->id }}" @selected(old('activity_id', $task->activity_id) == $activity->id)>{{ $activity->name }}</option>
            @endforeach
        </select>
        @error('activity_id')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Labels</label>
        <select name="labels[]" class="w-full border p-2" multiple>
            @foreach($labels as $label)
            <option value="{{ $label->id }}" @selected(collect(old('labels', $task->labels->pluck('id')->all()))->contains($label->id))>{{ $label->name }}</option>
            @endforeach
        </select>
        <p class="text-sm text-gray-500">Houd Ctrl/Cmd ingedrukt om meerdere labels te kiezen.</p>
        @error('labels')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('labels.*')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white">Opslaan</button>
</form>
@endsection