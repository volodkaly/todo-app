<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Detail úkolu</title>
</head>
<body>
<h1>Detail úkolu</h1>

<div>
    <h2>{{ $task->completed }}</h2>
    <h2>{{ $task->title }}</h2>
    <p>{{ $task->content }}</p>
    <p>Termín: {{ $task->deadline }}</p>
    <p>Stav: {{ $task->completed ? 'Splněno' : 'Nesplněno' }}</p>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</body>
</html>
