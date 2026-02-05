@extends('layouts.layoutadmin')
@php use Illuminate\Support\Str; @endphp

@section('content')
@if(session('status'))
<div class="mb-4 p-3 bg-green-100 text-green-800">{{ session('status') }}</div>
@endif

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Taken</h2>
    <a href="{{ route('tasks.create') }}" class="text-blue-600">Nieuwe taak</a>
</div>

<table class="w-full border border-gray-200">
    <tbody>
        @foreach($tasks as $task)
        <tr class="border-t">
            <td class="p-2">{{ $task->id }}</td>
            <td class="p-2">{{ Str::limit($task->task, 50) }}</td>
            <td class="p-2">{{ $task->begindate }}</td>
            <td class="p-2">{{ $task->enddate ? $task->enddate : '' }}</td>
            <td class="p-2">{{ $task->user?->name ?? 'N/A' }}</td>
            <td class="p-2">{{ $task->project->name }}</td>
            <td class="p-2">{{ $task->activity->name }}</td>
            <td class="p-2">{{ $task->labels->pluck('name')->join(', ') }}</td>
            <td class="p-2 space-x-2">
                <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-600">Bekijk</a>
                <a href="{{ route('tasks.edit', $task->id) }}" class="text-indigo-600">Bewerk</a>
                <a href="{{ route('tasks.delete', $task->id) }}" class="text-red-600">Verwijder</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $tasks->links() }}
</div>
@endsection