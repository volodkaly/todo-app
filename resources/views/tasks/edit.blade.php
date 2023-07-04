<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<h1>Upravit úkol</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')

    <label for="title">Název:</label>
    <input type="text" id="title" name="title" value="{{ htmlspecialchars($task->title) }}" required><br><br>

    <label for="content">Popis:</label>
    <textarea id="content" name="content">{{ htmlspecialchars($task->content) }}</textarea><br><br>

    <label for="deadline">Termín:</label>
    <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}" required><br><br>

    <button type="submit" class="btn btn-secondary">Uložit</button>
</form>
</body>
</html>
