@extends('layouts.app')
@section('content')
    <form method="POST"
        action="{{ $project->path() }}"
    >
        @method('PATCH')
        @include('projects._form', [
            'buttonText' => 'Edit project'
        ])
    </form>
@endsection