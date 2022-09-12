<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Entrega publicada: {{ $exam->name }}</h1>
<p>Tu profesor ha publicado cambios en la nota para {{ $exam->name }}.</p>
<p>Tu nota es: <strong>{{ $exam->mark }} / 10</strong></p>
<p>evaluado: {{ $exam->created_at }}</p>
</body>
</html>
