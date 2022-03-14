<!DOCTYPE html>
<body lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entreprises</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<div class="container-fluid py-5">
    <div class="row py-2">
        <div class="col-lg-11 mx-auto">
            <div class="card rounded shadow border-0">
                <div class="card-body bg-white rounded">
                    <div class="">
                        <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>nom</th>
                                <th>Siege</th>
                                <th>Telephone</th>
                                <th>ninea</th>
                                <th>registre</th>
                                <th>Site Web</th>
{{--                                <th>Disp. Form.</th>--}}
{{--                                <th>organigramme</th>--}}
{{--                                <th>contrat</th>--}}
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($entreprises as $entreprise)
                                <tr>
                                    <td>{{$entreprise->id}}</td>
                                    <td>{{$entreprise->nom}}</td>
                                    <td>{{$entreprise->siege}}</td>
                                    <td>{{$entreprise->telephone}}</td>
                                    <td>{{$entreprise->ninea}}</td>
                                    <td>{{$entreprise->registre}}</td>
                                    <td>{{$entreprise->siteWeb}}</td>
{{--                                    <td>{{$entreprise->dispositifFormation}}</td>--}}
{{--                                    <td>{{$entreprise->organigramme}}</td>--}}
{{--                                    <td>{{$entreprise->contrat}}</td>--}}
                                    <td>
                                        <a href="" class="p-2" title="mofifier entreprise"><i class="fa-solid fa-edit text-warning"></i></a>
                                        <a href="/entreprises/destroy/{{ $entreprise->id }}"  class="p-2" title="supprimer entreprise"><i class="fa-solid fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DEPENDANCY DATATABLE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function () {
        $(document).ready(function () {
            $('#example').DataTable();
        });
    });
</script>
</body>
</html>
