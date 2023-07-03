<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<h1 class="h1">Vítejte v aplikaci TODO-app. Zde můžete tvořit, upravovat a mazat úkoly.</h1>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'title']) }}">
                <button type="button" class="btn btn-secondary">
                    Seřadit dle názvů
                </button>
            </a>
        </th>
        <th>
        </th>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'deadline']) }}">
                <button type="button" class="btn btn-secondary">
                    Seřadit dle termínů
                </button>
            </a>
        </th>
        <th>
        </th>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'completed']) }}">
                <button type="button" class="btn btn-secondary">
                    Seřadit dle stavu
                </button>
            </a>
        </th>
    </tr>
    <tr class="subhead">
        <th>Název</th>
        <th>Popis</th>
        <th>Termín</th>
        <th>Možnosti</th>
        <th>Stav</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->content }}</td>
            <td>{{ date('d.m.Y', strtotime($task->deadline)) }}</td>
            <td class="options">

                <a href="{{ route('tasks.edit', $task) }}">
                    <button type="submit" class="btn btn-secondary m-2">
                        Upravit
                    </button>
                </a>

                <form method="post" action="{{ route('tasks.destroy', $task) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary m-2">
                        Smazat
                    </button>
                </form>

            </td>
            <td>
                <form method="POST" action="{{ route('tasks.status.update', $task->id) }}">
                    @method('PUT')
                    @csrf
                    <label>Nesplněno</label>
                    <input type="range" min="0" max="1" name="completed" value="{{$task->completed}}" >
                    <label>Splněno</label>
                    <button type="submit" class="btn btn-secondary">Uložit</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<a href="{{ route('tasks.create') }}">
    <button type="submit" class="btn btn-secondary m-2">
    Nový úkol
    </button>
</a>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</body>
</html>
