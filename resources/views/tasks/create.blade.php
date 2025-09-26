<!DOCTYPE html>
<html>

<head>
    <title>TO-DO App - Create Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <h1>Vytvořit nový úkol</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach

    @endif

    <form method="post" action="{{ route('tasks.store') }}">
        @csrf
        <label for="title">Název (do 30 znaků):</label>
        <input type="text" id="title" name="title" maxlength="30"><br><br>

        <label for="content">Popis (volitelně do 100 znaků):</label>
        <textarea id="content" name="content" maxlength="100"></textarea><br><br>

        <label for="deadline">Termín (jen budoucí datum):</label>
        <input type="date" id="deadline" name="deadline" required><br><br>

        <button type="submit" class="btn btn-secondary">Uložit</button>
    </form>



</body>

</html>
