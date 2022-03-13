<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pays</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="container my-5 pt-5">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Indicatif</th>
            <th scope="col">Nom</th>
            <th scope="col">Nbre regions</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($paysRegions as $pays)
            <tr>
                <th scope="row">{{$loop->index}}</th>
                <td>{{$pays->indicatif}}</td>
                <td>{{$pays->pays}}</td>
                <td>{{$pays->nombre_regions}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary">Regions</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
