@extends('layouts.app')
@section('content')
    <h1>Create Project</h1>
    <form 
        method="POST" 
        action="/projects">
        @include('projects._form', [
            'project' => new App\Project,
            'buttonText' => 'Create project'
        ])
    </form>
@endsection