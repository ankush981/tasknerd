@extends('layouts.app')
@section('content')
    <div class="mb-4">
        <a href="/projects/create">New Project</a>
    </div>
    <div class="row mx-n5">
        @forelse ($projects as $project)
            <a href="{{ $project->path() }}" class="col-4 p-1">
                <div class="bg-white p-2" style="height:100%;"> 
                    <p>{{ $project->title }}</p>
                    <p> {{ Str::limit($project->description, 100) }} </p>
                </div>
            </a>
        @empty
            <div> No projects yet </div>
        @endforelse
    </div>
@endsection