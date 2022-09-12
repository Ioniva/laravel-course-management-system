<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Entrega publicada: {{ $work->name }}</h1>
<p>Tu profesor ha publicado cambios en la nota para {{ $work->name }}.</p>
<p>Tu nota es: <strong>{{ $work->mark }} / 10</strong></p>
<p>evaluado: {{ $work->created_at }}</p>
</body>
</html>
