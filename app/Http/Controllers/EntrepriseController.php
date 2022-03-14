<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Quartier;
use Cassandra\Date;
use Faker\Guesser\Name;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        return view('entreprises.index', [
            'entreprises' => Entreprise::all()
        ]);
    }

    public function destroy($id)
    {
        Entreprise::destroy($id);
        return redirect()->route('entreprises.index');
    }

    public function create()
    {
        $quartiers = Quartier::all();
        return view('entreprises.create', [
            'quartiers' => $quartiers
        ]);
    }

    public function store(Request $request)
    {
        $request['dispositifFormation'] = $request->has('dispositifFormation');
        $request['cotisationSociale'] = $request->has('cotisationSociale');
        $request['organigramme'] = $request->has('organigramme');
        $request['contrat'] = $request->has('contrat');

        Entreprise::create($request->all());

        return redirect()->route('entreprises.index');
    }
}
