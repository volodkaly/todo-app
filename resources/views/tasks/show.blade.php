<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Detail úkolu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
