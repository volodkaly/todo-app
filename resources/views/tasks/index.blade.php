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
                <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
                    Seřadit dle názvů
                </button>
            </a>
        </th>
        <th>
        </th>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'deadline']) }}">
                <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
                    Seřadit dle termínů
                </button>
            </a>
        </th>
        <th>
        </th>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'completed']) }}">
                <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
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
            <td>{{ htmlspecialchars($task->title) }}</td>
            <td>{{ htmlspecialchars($task->content) }}</td>
            <td>{{ htmlspecialchars(date('d.m.Y', strtotime($task->deadline))) }}</td>
            <td style="white-space: nowrap;">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary m-2" style="display: inline-block;">
                    Upravit
                </a>
                <form method="post" action="{{ route('tasks.destroy', $task) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary m-2" style="display: inline-block;">
                        Smazat
                    </button>
                </form>
            </td>
            <td style="white-space: nowrap;">
                <form method="POST" action="{{ route('tasks.status.update', $task->id) }}">
                    @method('PUT')
                    @csrf
                    <label>Nesplněno</label>
                    <input type="range" min="0" max="1" name="completed" value="{{$task->completed}}">
                    <label>Splněno</label>
                    <button type="submit" class="btn btn-secondary">Uložit</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<a id="cb" href="{{ route('tasks.create') }}" class="btn btn-secondary m-2">
        Nový úkol
</a>

</body>
</html>
