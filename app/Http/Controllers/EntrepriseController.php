<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function store()
    {
       return view('entreprises.create', [
        ]);
    }
}
