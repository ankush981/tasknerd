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
                        <form action="{{ $project->path() . '/tasks/' . $task->id }}" method="post" class="d-flex">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <input name="body" type="text" value="{{ $task->body }}" class="w-100 h-100">
                            <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </form>
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
