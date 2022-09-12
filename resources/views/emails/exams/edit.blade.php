<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>La nota ha cambiado: {{ $exam->name }}</h1>
<p>Se ha modificado la nota de tu {{ $exam->name }}</p>
<p>Tu nota es: <strong>{{ $exam->mark }} / 10</strong></p>
<p>reevaluado: {{ $exam->updated_at }}</p>
</body>
</html>
