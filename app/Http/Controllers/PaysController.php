<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaysController extends Controller
{
    /**
     * La fonction recupere tous les pays et le nombre de regions
     * @return View liste des pays
     */
    public function index(): View
    {
//        $sql = "select count(r.id) as nombre , pays_id as id, p.nom as pays from regions as r join pays p on p.id = r.pays_id group by pays_id";

        $paysRegions = DB::table('regions')
            ->select(DB::raw('pays_id as id,  pays.nom as pays, indicatif , count(regions.id) as nombre_regions'))
            ->groupBy('pays_id', 'pays.nom', 'pays.indicatif')
            ->join('pays', 'pays.id', '=', 'pays_id')
            ->get();

        return view('pays.index', [
            'paysRegions' => $paysRegions
        ]);
    }

    /**
     * @param $id l'id du pays en question
     * @return View liste des regions du pays dont l'id correspond à l'id recu en parametre
     */
    public function getRegions($id)
    {
        $pays = Pays::find($id);

        $regions = Region::all()->where('pays_id', "=", $id);
        return view('pays.regions', [
            'regions' => $regions,
            'pays' => $pays
        ]);
    }

}
