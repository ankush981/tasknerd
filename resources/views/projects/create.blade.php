@extends('layouts.app')
@section('content')
    <h1>Create Project</h1>
    <form method="POST" action="/projects">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Creare project</button>
    </form>
@endsection