@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Project bewerken</h2>

@if ($errors->any())
<div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
    <p class="font-semibold mb-2">Er ging iets mis:</p>
    <ul class="list-disc list-inside space-y-1">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('projects.update', $project->id) }}" class="space-y-4">
    @csrf
    @method('PATCH')
    <div>
        <label class="block mb-1">Naam</label>
        <input type="text" name="name" class="w-full border p-2 @error('name') border-red-400 @enderror" value="{{ old('name', $project->name) }}">
        @error('name')
        <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block mb-1">Omschrijving</label>
        <textarea name="description" class="w-full border p-2 @error('description') border-red-400 @enderror">{{ old('description', $project->description) }}</textarea>
        @error('description')
        <p class="text-sm text-red-700 mt-1">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white">Opslaan</button>
</form>
@endsection