<!DOCTYPE html>
<html>

<head>
    <title>TO-DO App - Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                    <a href="{{ route('tasks.index', ['showWithStatus' => 'incompleted']) }}">
                        <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
                            Zobrazit jen aktivní
                        </button>
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['showWithStatus' => 'completed']) }}">
                        <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
                            Zobrazit jen dokončené
                        </button>
                    </a>
                </th>
                <th>
                    <a href="{{ route('tasks.index', ['showWithStatus' => 'all']) }}">
                        <button type="button" class="btn btn-secondary" style="white-space: nowrap";>
                            Zobrazit všechny
                        </button>
                    </a>
                </th>
            </tr>
            <tr class="subhead">
                <th>Název</th>
                <th>Popis</th>
                <th>Termín</th>
                <th>Možnosti</th>
                <th></th>
                <th>Stav</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="{{ $task->completed ? 'row-completed' : 'row-incompleted' }}">
                    <td>{{ htmlspecialchars($task->title) }}</td>
                    <td>{{ htmlspecialchars($task->content) }}</td>
                    <td>{{ htmlspecialchars(date('d.m.Y', strtotime($task->deadline))) }}</td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary m-2"
                            style="display: inline-block;">
                            Upravit
                        </a>
                        <form method="post" action="{{ route('tasks.destroy', $task) }}"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-2" style="display: inline-block;">
                                Smazat
                            </button>
                        </form>
                    </td>
                    <td>
                        @if ($task->completed)
                            Splněno
                        @else
                            Nesplněno
                        @endif
                    </td>
                    <td style="white-space: nowrap;">
                        <form method="POST" action="{{ route('tasks.status.update', $task->id) }}">
                            @method('PUT')
                            @csrf

                            <button type="submit" class="btn btn-secondary">Změnit status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a id="cb" href="{{ route('tasks.create') }}" class="btn btn-secondary">
        Nový úkol
    </a>

</body>

</html>
