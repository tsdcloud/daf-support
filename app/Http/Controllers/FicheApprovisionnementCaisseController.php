<?php

namespace App\Http\Controllers;

use App\Models\FicheApprovisionnementCaisse;
use App\Models\User;
use Illuminate\Http\Request;

class FicheApprovisionnementCaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiche_approv_caisse = FicheApprovisionnementCaisse::all();

        return view('ConsultFAC', compact('fiche_approv_caisse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('fiche_approv_caisse', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $data = $request->validate([
            "approvisionneur" => "required",
            "montant"=> "required|numeric",
            "provenance" => "required",
            "libelle" => "required",
            "num_dossier" => "required",
            "num_dossier" => "required",
            "num_comptable" => "required",
            "Contact" => "required",
            "numero_contribuable" => "required",
            "fonction" => "required",
            "Matricule" => "required",
            "mode_approv" => "required",
        ],
        [
            "approvisionneur.required" => 'L\'approvisionneur est à choisir',
            "montant.required" => 'Le montant est à choisir',
            "montant.numeric" => 'Le montant doit être un nombre',
            "provenance.required" => 'La provenance est à déterminer',
            "libelle.required" => 'detail sur l\'aprivisionnement',
            "num_dossier.required" => 'Précissez le numéro de dossier',

        ]);

        // dd($request->all());
        $data['user_id'] = auth()->user()->id;

        FicheApprovisionnementCaisse::create($data);

        return redirect()->route('ConsultFAC')->with('success', 'Fiche validée vec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiche_approv_caisse = FicheApprovisionnementCaisse::find($id);
        return view('visual_fac', compact('fiche_approv_caisse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
