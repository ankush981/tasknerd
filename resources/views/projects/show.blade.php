@extends('layouts.app')
@section('content')
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>

    <div class="mt-3">
        <h2>Tasks</h2>
        @forelse ($project->tasks as $task)
            <div class="card"> 
                <div class="card-body">
                    <div class="card-text">
                        {{ $task->body }}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary">No tasks!</div>
        @endforelse
    </div>
    <a href="/projects">Go back</a>
@endsection
