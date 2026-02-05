@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Project detail</h2>

<div class="space-y-2">
    <div><strong>ID:</strong> {{ $project->id }}</div>
    <div><strong>Naam:</strong> {{ e($project->name) }}</div>
    <div><strong>Omschrijving:</strong> {{ e($project->description) }}</div>
    <div><strong>Aangemaakt op:</strong> {{ $project->created_at }}</div>
</div>
@endsection