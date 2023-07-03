<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Edit Task</title>
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
    <input type="text" id="title" name="title" value="{{ $task->title }}" required><br><br>

    <label for="content">Popis:</label>
    <textarea id="content" name="content">{{ $task->content }}</textarea><br><br>

    <label for="deadline">Termín:</label>
    <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}" required><br><br>

    <button type="submit">Uložit</button>
</form>
</body>
</html>
