<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Entity;
use App\Models\Fonction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\ConfigurationCompte;
use Illuminate\Support\Facades\Mail;
use App\Mail\CashRegisterSupplySheetMail;
use App\Models\FicheApprovisionnementCaisse;
use App\Mail\CreateCashRegisterSupplySheetMail;
use App\Http\Requests\CashRegisterSupplyRequest;
use App\Models\AttachementCashRegisterSupplySheet;

class CashRegisterSupplySheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;

        $fiche_approv_caisses = "";
        if(auth()->user()->isAdmin() || auth()->user()->isComptable() || auth()->user()->isControleur() || auth()->user()->isControleur_conf() || auth()->user()->isCaissier()){
            $fiche_approv_caisses = FicheApprovisionnementCaisse::where(['entity_id'=> $current_entity_id])->get();
        }else{
            $fiche_approv_caisses = FicheApprovisionnementCaisse::where(['user_id' => auth()->user()->id, 'entity_id'=> $current_entity_id])->orWhere('approvisionneur',auth()->user()->id)->get();
        }

        return view('cash_register_supply_sheet.index',compact('fiche_approv_caisses'));
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
        // $controllers = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 3)->get();
        // $ordonateurs = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 2)->get();

        $cities = Entity::find(auth()->user()->current_entity()->entity_id)->cities;
        $sites = Site::all();
        // dd($sites);
        return view('cash_register_supply_sheet.create',compact('users','cities','sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRegisterSupplyRequest $request)
    {
        $data =  $request->validated();
        $data['user_id'] = auth()->user()->id;

        // dd($request->all());

        DB::beginTransaction();
        $fiche_approv_caisses = FicheApprovisionnementCaisse::create([

                                    'user_id' => auth()->user()->id,
                                    'approvisionneur' =>$request->approvisionneur,
                                    'montant' =>   $request->montant,
                                    'provenance' => $request->provenance,
                                    'libelle' => $request->libelle,
                                    'num_dossier' => $request->num_dossier,
                                    'Contact' => $request->Contact,
                                    'numero_contribuable' => $request->numero_contribuable,
                                    'fonction' => $request->fonction,
                                    'Matricule' => $request->Matricule,
                                    'mode_approv' => $request->mode_approv,
                                    'entity_id' =>  auth()->user()->current_entity()->entity_id,
                                    'city_entity_id' =>  $request->city_entity_id,
                                    'site_id' => $request->site_id,

                                ]);
                            // dd($request->all());
        if($request->has('filenames')){
            $request->validate([
                'filenames.*' => 'required|image|mimes:jpeg,png,jpg,tiff,bipmap,svg,raw|max:10240',
            ],[
                'filenames.*.required' => 'Fichier requis',
                'filenames.*.image' => 'Fichier doit etre de type image',
                'filenames.*.mimes' => 'Fichier doit etre de type image (jpeg, png, jpg)',
            ]);

            foreach($request->filenames as $file){
                AttachementCashRegisterSupplySheet::create([
                    'fiche_approvisionnement_caisse_id' => $fiche_approv_caisses->id,
                    'filename' => $file->store('images', 'public'),
                ]);
            }

        }

        $contenu = [
            'title' => 'Soumission fiche retour caisse',
            'fiche_approvisionnement_caisse_id' => $fiche_approv_caisses->id
        ];

        $contenu = [
            'title' => 'Soumission de la fiche approvisionnement caisse',
            'fiche_approv_caisse_id' => $fiche_approv_caisses->id
        ];
        $approvisionneurs = $fiche_approv_caisses->approvisionneurs;
        // dd($contenu);

            Mail::to($approvisionneurs->email)->send(new CreateCashRegisterSupplySheetMail($contenu));

        DB::commit();

        return redirect()->route('cash_register_supply_sheet.index')->with('success', 'Fiche enregistrée avec succès');



    }

    public function cash_register_supply_validation(Request $request, FicheApprovisionnementCaisse $fiche_approv_caisse)
    {

        $data = $request->validate([
            "fonction" => "required",
        ]);
        $data['fiche_approv_caisse_id'] = $fiche_approv_caisse->id;


        // validation approvisionneur

        if ($request->fonction == 'approvisionneur') {

            $fiche_approv_caisse->statut = 'validée par approvisionneur';
            $fiche_approv_caisse->observation_approvisionneur = $request->observation_approvisionneur;

            $approvisionneurs = $fiche_approv_caisse->approvisionneurs;

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 6)->first();

                $mailData = [
                    'fiche_approv_caisse' => $fiche_approv_caisse,
                    'fonction' => 'l\' approvisionneur',
                    'user' => $approvisionneurs,
                ];
                // dd($mailData['user']->email);

            Mail::to($caisse->email)->send(new CashRegisterSupplySheetMail($mailData));
        }

                // Validation caisse
        if ($request->fonction == 'caisse') {

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 6)->first();
            $comptable = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 1)->first();

                $fiche_approv_caisse->statut = 'encaissé';
                $fiche_approv_caisse->observation_caisse = $request->observation_caisse;


                $mailData = [
                    'fiche_approv_caisse' => $fiche_approv_caisse,
                    'fonction' => 'Caisse',
                    'user' => $caisse,
                ];

            Mail::to($comptable->email)->send(new CashRegisterSupplySheetMail($mailData));
        }

        $fiche_approv_caisse->update();
        // dd($fiche_approv_caisse);

        return back()->with('success', 'Signature effectuée avec succès');
    }

    public function add_num_comptable(Request $request, FicheApprovisionnementCaisse $fiche_approv_caisse)
    {

        // dd($request->all());
        $data = $request->validate([
            "num_comptable" => 'required|unique:fiche_approvisionnement_caisses,num_comptable',
            "num_compte_general" => 'required|digits_between:1,8',
            'code_tiers'=> ['required', 'regex:/^([0-9]){4}(([0-9a-zA-Z]){0,10})$/'], //Lien pour tester l'expression reguliere: https://regex101.com/r/0w2Mxa/1 ; Lien pour comprendre les expressions regulieres https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/regex-metacaractere/
            // 'section_analytique'=> 'required|digits_between:1,12',
            'ref_compte'=> 'required',
            'num_attestation' => 'required_with:retenu_source',
        ],[
            'num_compte_general.digits_between' => 'Ce champs requiert maximum 8 chiffres',
            'num_comptable.required' => 'Ce champs est requis',
            'num_comptable.unique' => 'Ce numéro est déjà utilisé',
            'code_tiers.required' => 'Ce champs est requis',
            'code_tiers.regex' => 'Ce champs est constitué de 4 chiffres au début et 10 caractères maximum ensuite',
            'section_analytique.required' => 'Ce champs est requis',
            'ref_compte.required' => 'Ce champs est requis',
            'num_attestation.required_with' => 'Ce champs est obligatoire, car retenu source est non nul',
        ]);

        // Format du numero comptable;
        $length_of_num_comptable = Str::length($data['num_compte_general']);
        $zeros = '';

        for($k = 1; $k <= 8 - $length_of_num_comptable; $k++){
            $zeros .= '0';
        }
        $data['num_compte_general'] = $data['num_compte_general'] . '' . $zeros ;

        // Format du code tier
        // $data['code_tiers'] =

        // dd($data['num_comptable']);



        // dd($fiche_depense);




        $data['section_analytique'] = $fiche_approv_caisse->num_dossier;

        if($request->num_cheque_virement){
            $data['num_cheque_virement'] = $request->num_cheque_virement;
        }

        if($request->num_facture){
            $data['num_facture'] = $request->num_facture;
        }


        $data['montant_a_payer'] = $fiche_approv_caisse->montant;

        if($request->montant_dette){
            $request->validate([
                "montant_dette" => ['numeric','digits_between:1,13'],
                // "montant_dette" => 'numeric|digits_between:1,13|after_or_equal:montant_a_payer',
            ],[
                'montant_dette.numeric' => 'Ce champs doit etre un nombre',
                'montant_dette.digits_between' => 'Ce champs doit avoir 15 chiffres au maximum',
                'montant_dette.after_or_equal' => 'Ce champs ne doit pas etre inferieur au montant payé',
            ]);

            $data['montant_dette'] = $request->montant_dette;

            // if($data['montant_dette'] < $data['montant_a_payer']){
            //     return back()->with('error', 'Le montant dette ne doit pas etre inferieur au montant payé');
            // }
            // dd(1);
        }

        if($request->retenu_source){
            $data['retenu_source'] = $request->retenu_source;
            $data['num_attestation'] = $request->num_attestation;
        }

        $data['comptable'] = auth()->user()->id;

        // dump($data['montant_dette']);
        // dd($data);
        $fiche_approv_caisse->update($data);

        return back()->with('success', 'Numéro comptable ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FicheApprovisionnementCaisse $fiche_approv_caisse)
    {
        $current_entity = auth()->user()->current_entity();

        $comptes = ConfigurationCompte::where('entity_id',$current_entity->entity_id)->get();
        // dd($fiche_approv_caisse);

        return view('cash_register_supply_sheet.show', compact('fiche_approv_caisse','comptes'));
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
