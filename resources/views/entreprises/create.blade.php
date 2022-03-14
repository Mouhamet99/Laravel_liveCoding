<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formualaire d'enregistrement d'entreprise</title>

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
<div class="container my-5 py-5">
    <div class="col-md-6 mx-auto form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 class="text-center">Registration</h3>
                        <form class="requires-validation" novalidate action="" method="post">
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="text" name="nom" value=""
                                       placeholder="Nom de l'entreprise" required>
                                <div class="valid-feedback">Le Nom est valid!</div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="text" name="siege" value=""
                                       placeholder="Siege de l'entreprise" required>
                                <div class="valid-feedback">Le Nom est valid!</div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="number" name="telephone" value=""
                                       placeholder="Tel" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="date" name="dateCreation" value=""
                                       required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="text" name="registre" value=""
                                       max="20" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="text" name="ninea" value=""
                                       max="15" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 my-4">
                                <input class="form-control "
                                       type="text" name="siteWeb" value=""
                                       required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" name="dispositifFormation"
                                       id="invalidCheck" required>
                                <label class="form-check-label">dispositif Formation</label>
                                <div class="invalid-feedback">Please confirm that the entered data are all correct!
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" name="cotisationSociale"
                                       id="invalidCheck" required>
                                <label class="form-check-label">cotisation Sociale</label>
                                <div class="invalid-feedback">Please confirm that the entered data are all correct!
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" name="organigramme"
                                       id="invalidCheck" required>
                                <label class="form-check-label">organigramme</label>
                                <div class="invalid-feedback">Please confirm that the entered data are all correct!
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" name="contrat"
                                       id="invalidCheck" required>
                                <label class="form-check-label">contrat</label>
                                <div class="invalid-feedback">Please confirm that the entered data are all correct!
                                </div>
                            </div>
                            <div class="col-md-12 my-4">
                                <select class="form-select mt-3" name="quartier_id" required>
                                    <option selected value="">Quartier</option>
                                    @foreach ($quartiers as $quarter)
                                         <option  value="{{$quarter->id}}">{{$quarter->nom}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">You selected a Quartier!</div>
                                <div class="invalid-feedback">Please select a Quartier!</div>
                            </div>


                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
