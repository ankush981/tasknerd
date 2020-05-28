<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>