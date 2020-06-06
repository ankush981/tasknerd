@csrf
<div class="form-group">
    <label>Title</label>
    <input 
        type="text" 
        class="form-control" 
        name="title"
        value="{{ $project->title }}"
    >
</div>
<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="description"> {{ $project->description }} </textarea>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ $project->path() }}">Cancel</a>