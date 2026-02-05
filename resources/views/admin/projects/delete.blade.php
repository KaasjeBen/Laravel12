@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Project verwijderen</h2>

<form method="POST" action="{{ route('projects.destroy', $project->id) }}" class="space-y-4">
    @csrf
    @method('DELETE')
    <div>
        <label class="block mb-1">Naam</label>
        <input type="text" name="name" class="w-full border p-2" value="{{ e($project->name) }}" disabled>
    </div>
    <div>
        <label class="block mb-1">Omschrijving</label>
        <textarea name="description" class="w-full border p-2" disabled>{{ e($project->description) }}</textarea>
    </div>
    <button type="submit" class="px-4 py-2 bg-red-600 text-white">Verwijderen</button>
</form>
@endsection