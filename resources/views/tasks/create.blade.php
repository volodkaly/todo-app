<!DOCTYPE html>
<html>
<head>
    <title>TO-DO App - Create Task</title>
</head>
<body>
<h1>Vytvořit nový úkol</h1>


<form method="post" action="{{ route('tasks.store') }}">
    @csrf
    <label for="title">Název:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="content">Popis (volitelně):</label>
    <textarea id="content" name="content"></textarea><br><br>

    <label for="deadline">Termín (max. 2 úkoly se stejným termínem):</label>
    <input type="date" id="deadline" name="deadline" required><br><br>

    <button type="submit">Uložit</button>
</form>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

</body>
</html>
