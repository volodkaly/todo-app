<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Task List</title>
    <h1>Vítejte v aplikaci TODO-app. Zde můžete tvořit, upravovat a mazat úkoly.</h1>
</head>
<body>
<h1>Seznam úkolů</h1>

<table>
    <thead>
    <tr>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'title']) }}">
                Seřadit dle názvů
            </a>
        </th>
        <th>

        </th>
        <th>
            <a href="{{ route('tasks.index', ['sort' => 'deadline']) }}">
                Seřadit dle termínů
            </a>
        </th>

        <th>
            <a href="{{ route('tasks.index', ['sort' => 'completed']) }}">
                Seřadit dle stavu
            </a>
        </th>
    </tr>
    </thead>
    <tr>
        <th>Název</th>
        <th>Popis</th>
        <th>Termín</th>
        <th>Možnosti</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->content }}</td>
            <td>{{ date('d.m.Y', strtotime($task->deadline)) }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task) }}">Upravit</a>

                <form method="post" action="{{ route('tasks.destroy', $task) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Smazat</button>
                </form>
            </td>
            <td>
                <form method="POST" action="{{ route('tasks.status.update', $task->id) }}">
                    @method('PUT')
                    @csrf
                    <label>Nesplněno</label>
                    <input type="range" min="0" max="1" name="completed" value="{{$task->completed}}">
                    <label>Splněno</label>

                    <button type="submit">Uložit</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ route('tasks.create') }}">Nový úkol</a>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

</body>
</html>
