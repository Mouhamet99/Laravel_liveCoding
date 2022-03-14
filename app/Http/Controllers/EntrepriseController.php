<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function create()
    {
        $quartiers = Quartier::all();
        return view('entreprises.create', [
            'quartiers' => $quartiers
        ]);
    }
}
