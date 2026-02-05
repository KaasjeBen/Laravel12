@extends('layouts.layoutadmin')
@php use Illuminate\Support\Str; @endphp

@section('content')
@if(session('status'))
<div class="mb-4 p-3 bg-green-100 text-green-800">{{ session('status') }}</div>
@endif

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Projecten</h2>
    <a href="{{ route('projects.create') }}" class="text-blue-600">Nieuw project</a>
</div>

<table class="w-full border border-gray-200">
    <thead>
        <tr class="bg-gray-50">
            <th class="p-2 text-left">ID</th>
            <th class="p-2 text-left">Naam</th>
            <th class="p-2 text-left">Omschrijving</th>
            <th class="p-2 text-left">Edit</th>
            <th class="p-2 text-left">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr class="border-t">
            <td class="p-2">{{ $project->id }}</td>
            <td class="p-2">{{ e($project->name) }}</td>
            <td class="p-2">{{ Str::limit(e($project->description), 50) }}</td>
            <td class="p-2">
                <a href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600">Bewerk</a>
            </td>
            <td class="p-2">
                <form method="POST" action="{{ route('projects.destroy', $project) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600" onclick="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">Verwijder</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection