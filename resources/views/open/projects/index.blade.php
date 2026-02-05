@extends('layouts.layoutpublic')
@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container mx-auto max-w-4xl py-8">
    <h1 class="text-2xl font-semibold mb-6">Projecten</h1>

    @foreach($projects as $project)
    <div class="mb-4 p-4 border border-gray-200">
        <div class="text-sm text-gray-500">ID: {{ $project->id }}</div>
        <div class="text-lg font-semibold">{{ e($project->name) }}</div>
        <p class="text-gray-700">{{ Str::limit(e($project->description), 350) }}</p>
        <div class="mt-3">
            <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center text-blue-700 hover:text-blue-900 font-medium">
                Bekijk details
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
    @endforeach

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection