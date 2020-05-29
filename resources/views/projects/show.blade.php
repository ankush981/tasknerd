@extends('layouts.app')
@section('content')
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>

    <div class="my-3">
        <h2>Tasks</h2>
        @foreach ($project->tasks as $task)
            <div class="card mb-1"> 
                <div class="card-body">
                    <div class="card-text">
                        {{ $task->body }}
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            <form action="{{ $project->path() . '/tasks' }}" method="POST">
                @csrf
                <input type="text" name="body" placeholder="Add a new task ...">
            </form>
        </div>
    </div>
    <a href="/projects">Go back</a>
@endsection
