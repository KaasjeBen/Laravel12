@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Taak aanmaken</h2>

<form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
    @csrf
    <div>
        <label class="block mb-1">Taak</label>
        <input type="text" name="task" class="w-full border p-2" value="{{ old('task') }}">
    </div>
    <div>
        <label class="block mb-1">Begindatum</label>
        <input type="date" name="begindate" class="w-full border p-2" value="{{ old('begindate') }}">
    </div>
    <div>
        <label class="block mb-1">Einddatum</label>
        <input type="date" name="enddate" class="w-full border p-2" value="{{ old('enddate') }}">
    </div>
    <div>
        <label class="block mb-1">Gebruiker</label>
        <select name="user_id" class="w-full border p-2">
            <option value="">-- kies gebruiker --</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{!! $user->name !!}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Project</label>
        <select name="project_id" class="w-full border p-2">
            @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Activity</label>
        <select name="activity_id" class="w-full border p-2">
            @foreach($activities as $activity)
            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block mb-1">Labels</label>
        <select name="labels[]" class="w-full border p-2" multiple>
            @foreach($labels as $label)
            <option value="{{ $label->id }}">{{ $label->name }}</option>
            @endforeach
        </select>
        <p class="text-sm text-gray-500">Houd Ctrl/Cmd ingedrukt om meerdere labels te kiezen.</p>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white">Opslaan</button>
</form>
@endsection