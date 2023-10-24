<?php

namespace App\Http\Controllers;
use SweetAlert;
use App\Models\Site;
use App\Models\Entity;
use App\Models\User;
use App\Models\Fonction;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\FicheRetourCaisse;
use App\Mail\FicheRetourCaisseMail;
use App\Models\LibelleRetourCaisse;

class FicheRetourCaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiche_retour_caisse = FicheRetourCaisse::all();

        return view('ConsultFRC', compact('fiche_retour_caisse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::all();
        $fonction = Fonction::find(session('fonction_id')['fonction_id']);
        $users = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->get();
        $cities = Entity::find(auth()->user()->current_entity()->entity_id)->cities;
        $sites = Site::all();

        return view('fiche_retour_caisse', compact('users','cities','sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data = $request->validate([
            "retourneur" => "required",
            // "numero_contribuable" => "required",
            // "destinataire" => "required",
            // "num_dossier" => "required",
            "montant"=> "required|numeric",
            "reliquat" => "required",
            "reference_fd_original" => "required",
            "date_fd_original" => "required",
            "addMoreInput.*.libelle" => "required",
            "addMoreInput.*.montant" => "required",
            "addMoreInput.*.dossier" => "required",
        ],
        [
            "retourneur.required" => 'L\'retourneur est à choisir',
            // "numero_contribuable.required" => 'Le numero contribuable n\'est pas vide',
            "montant.required" => 'Le montant est à choisir',
            "montant.numeric" => 'Le montant doit être un nombre',
            "reliquat.required" => 'Le reliquat est à choisir',
            "reliquat.numeric" => 'Le reliquat doit être un nombre',
            "date_fd_original.required" => 'La date de la fiche de dépense originelle est à déterminer',
            "reference_fd_original.required" => 'Le numéro de la fiche de dépense originelle est à déterminer',
            "libelle.required" => 'detail sur l\'aprivisionnement',
            "num_dossier.required" => 'Précissez le numéro de dossier',
        ]);
        if($request->numero_contribuable){
            $data['numero_contribuable'] = $request->numero_contribuable;
        }

        if($request->numero_contribuable){
            $data['numero_contribuable'] = $request->numero_contribuable;
        }

        $data['user_id'] = auth()->user()->id;

        $fiche_retour_caisse = FicheRetourCaisse::create($data);

        $addMoreInput = $request->addMoreInput;
        foreach($addMoreInput as $libelle_retour_caisses){
            LibelleRetourCaisse::create([
                'fiche_retour_caisse_id' => $fiche_retour_caisse->id,
                'libelle' => $libelle_retour_caisses['libelle'],
                'dossier' => $libelle_retour_caisses['dossier'],
                'montant' => $libelle_retour_caisses['montant'],
            ]);
        }

        // dd(2);
        return redirect()->route('ConsultFRC')->with('success', 'Fiche validée vec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiche_retour_caisse = FicheRetourCaisse::find($id);
        return view('visual_frc', compact('fiche_retour_caisse'));
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
