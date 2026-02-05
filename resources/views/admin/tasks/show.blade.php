@extends('layouts.layoutadmin')

@section('content')
<h2 class="text-xl font-semibold mb-4">Taak detail</h2>

<div class="space-y-2">
    <div><strong>ID:</strong> {{ $task->id }}</div>
    <div><strong>Taak:</strong> {{ $task->task }}</div>
    <div><strong>Begindatum:</strong> {{ $task->begindate }}</div>
    <div><strong>Einddatum:</strong> {{ $task->enddate?->toDateString() ?? 'N/A' }}</div>
    <div><strong>Gebruiker:</strong> {{ $task->user?->name ?? 'N/A' }}</div>
    <div><strong>Project:</strong> {{ $task->project->name }}</div>
    <div><strong>Activity:</strong> {{ $task->activity->name }}</div>
    <div><strong>Labels:</strong> {{ $task->labels->pluck('name')->join(', ') }}</div>
    <div><strong>Aangemaakt op:</strong> {{ $task->created_at }}</div>
</div>
@endsection