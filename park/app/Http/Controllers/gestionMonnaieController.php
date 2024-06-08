<?php

namespace App\Http\Controllers;

use App\Models\monnaieuser;
use Illuminate\Http\Request;

class gestionMonnaieController extends Controller
{
    //
    public function monnaieUser(){
        $monnaieusers = monnaieuser::join('users', 'monnaieuser.id_user', '=', 'users.id')
            ->whereNull(['monnaieuser.etat_monnaie', 'monnaieuser.monnaie_sortie'])
            ->get(['monnaieuser.*', 'users.name as nom']);

        return view('monnaie.valide')
            ->with('monnaieusers', $monnaieusers);
    }

    public function val($id){
        monnaieuser::where('id', $id)->update(['etat_monnaie' => 10]);
        return redirect()->route('valide.monnaie');

    }
}
