@extends('layouts.app')
@section('content')
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>

    <a href="{{ $project->path() . '/edit' }}">Edit project</a>

    <div class="my-3">
        <h2>Tasks</h2>
        @foreach ($project->tasks as $task)
            <div class="card mb-1"> 
                <div class="card-body">
                    <div class="card-text">
                        <form action="{{ $task->path() }}" method="post" class="d-flex">
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

        <div class="my-3">
            <form action="{{ $project->path() }}" method="POST">
                @csrf
                @method('patch')
                <textarea name="notes" id="" cols="30" rows="10">{{ $project->notes }}</textarea>
                <button type="submit">Save</button>
            </form>

            @if($errors->any())
                <ul class="error mt-5">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <a href="/projects">Go back</a>
@endsection
