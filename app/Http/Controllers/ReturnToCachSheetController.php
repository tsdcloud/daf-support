<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\CityEntity;
use Illuminate\Support\Str;
use App\Models\FicheDepense;
use Illuminate\Http\Request;
use App\Models\FicheRetourCaisse;
use Illuminate\Support\Facades\DB;
use App\Mail\ReturnToCashSheetMail;
use App\Models\ConfigurationCompte;
use App\Models\LibelleRetourCaisse;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateReturnToCashSheetMail;
use App\Models\AttachementReturnToCashSheet;

class ReturnToCachSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_retour_caisses = "";
        if(auth()->user()->isAdmin() || auth()->user()->isComptable() || auth()->user()->isControleur() || auth()->user()->isControleur_conf() || auth()->user()->isCaissier()){
            $fiche_retour_caisses = FicheRetourCaisse::where(['entity_id'=> $current_entity_id])->get();

        }else{
            $fiche_retour_caisses = FicheRetourCaisse::where(['user_id' => auth()->user()->id, 'entity_id'=> $current_entity_id])->orWhere('retourneur',auth()->user()->id)->get();

        }


        return view('return_to_cash_sheet.index', compact('fiche_retour_caisses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fonction = Fonction::find(session('fonction_id')['fonction_id']);
        $users = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->get();
        $cities = Entity::find($fonction->user_entity->entity_id)->cities;
        $sites = Site::all();
        $users = User::all();
        $fiche_depenses = FicheDepense::where('num_comptable', '!=', null)->get();
        return view('return_to_cash_sheet.create', compact(
            'users',
        'fiche_depenses',
        'cities',
        'sites'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "retourneur" => "required",
            "montant"=> "required|numeric|min:0",
            "reliquat" => "required|numeric|min:0",
            'fiche_depense_id' => "required",
            // "reference_fd_original" => "required",
            // "date_fd_original" => "required",
            "addMoreInput.*.libelle" => "required",
            "addMoreInput.*.montant" => "required|numeric|min:0",
            "addMoreInput.*.dossier" => "required",
        ],[
            "retourneur.required" => 'L\'retourneur est à choisir',
            "montant.required" => 'Le montant est à choisir',
            "montant.numeric" => 'Le montant doit être un nombre',
            "reliquat.required" => 'Le reliquat est à choisir',
            "reliquat.numeric" => 'Le reliquat doit être un nombre',
            "date_fd_original.required" => 'La date de la fiche de dépense originelle est à déterminer',
            "reference_fd_original.required" => 'Le numéro de la fiche de dépense originelle est à déterminer',
            "libelle.required" => 'detail sur l\'aprivisionnement',
            "num_dossier.required" => 'Précissez le numéro de dossier',
            "addMoreInput.*.libelle.required" => 'Le libellé est à renseigner',
            "addMoreInput.*.montant.required" => 'Le montant est à renseigner',
            "addMoreInput.*.montant.numeric" => 'Le montant doit être un nombre',
            "addMoreInput.*.montant.min" => 'Le montant doit être positif',
            "addMoreInput.*.dossier.required" => 'Le numero de dossier est à renseigner',
        ]);

        if($request->numero_contribuable){
            $data['numero_contribuable'] = $request->numero_contribuable;
        }

        if($request->num_dossier){
            $data['num_dossier'] = $request->num_dossier;
        }


        if($request->city_entity_id){
            $data['city_entity_id'] = $request->city_entity_id;
        }

        if($request->site_id){
            $data['site_id'] = $request->site_id;
        }

        $city_entity = CityEntity::find($data['city_entity_id']);
        $data['entity_id'] = $city_entity->entity_id;

        $data['user_id'] = auth()->user()->id;

        DB::beginTransaction();

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
        if($request->has('filenames')){
            $request->validate([
                'filenames.*' => 'required|image|mimes:jpeg,png,jpg,tiff,bipmap,svg,raw|max:10240',
            ],[
                'filenames.*.required' => 'Fichier requis',
                'filenames.*.image' => 'Fichier doit etre de type image',
                'filenames.*.mimes' => 'Fichier doit etre de type image (jpeg, png, jpg)',
            ]);

            foreach($request->filenames as $file){
                AttachementReturnToCashSheet::create([
                    'fiche_retour_caisse_id' => $fiche_retour_caisse->id,
                    'filename' => $file->store('images', 'public'),
                ]);
            }
        }
        $contenu = [
            'title' => 'Soumission fiche retour caisse',
            'fiche_retour_caisse_id' => $fiche_retour_caisse->id
        ];
        $retourneurs = $fiche_retour_caisse->retourneurs;
        // dump($contenu);
        // dd($retourneurs);

            Mail::to($retourneurs->email)->send(new CreateReturnToCashSheetMail($contenu));
        DB::commit();

        return redirect()->route('return_to_cash_sheet.index')->with('success', 'Fiche validée vec succès');
    }

    public function return_to_cash_validation(Request $request, FicheRetourCaisse $fiche_retour_caisse)
    {

        $data = $request->validate([
            "fonction" => "required",
        ]);
        $data['fiche_retour_caisse_id'] = $fiche_retour_caisse->id;


        if ($request->fonction == 'retourneur') {
            $fiche_retour_caisse->statut = 'validée par retourneur';
            $fiche_retour_caisse->observation_retourneur = $request->observation_retourneur;

            $retourneurs = $fiche_retour_caisse->retourneurs;

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 6)->first();

            $mailData = [
                'fiche_retour_caisse' => $fiche_retour_caisse,
                'fonction' => 'le retourneur',
                'user' => $retourneurs,
            ];

            Mail::to($caisse->email)->send(new ReturnToCashSheetMail($mailData));
        }

                // Validation caisse
        if ($request->fonction == 'caisse') {

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 6)->first();
            $comptable = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 1)->first();

                $fiche_retour_caisse->statut = 'encaissé';
                $fiche_retour_caisse->observation_caisse = $request->observation_caisse;

                $mailData = [
                    'fiche_retour_caisse' => $fiche_retour_caisse,
                    'fonction' => 'Caisse',
                    'user' => $caisse,
                ];

            Mail::to($comptable->email)->send(new ReturnToCashSheetMail($mailData));
        }

        $fiche_retour_caisse->update();

        return back()->with('success', 'Signature effectuée avec succès');
    }



    // addition du numéro comptable
    public function add_num_comptable(Request $request, FicheRetourCaisse $fiche_retour_caisse)
    {

        // dd($request->all());
        $data = $request->validate([
            "num_comptable" => 'required|unique:fiche_retour_caisses,num_comptable',
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

        // dd($fiche_depense);

        $data['section_analytique'] = $fiche_retour_caisse->num_dossier;

        if($request->num_cheque_virement){
            $data['num_cheque_virement'] = $request->num_cheque_virement;
        }

        if($request->num_facture){
            $data['num_facture'] = $request->num_facture;
        }


        $data['montant_a_payer'] = $fiche_retour_caisse->montant;

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
        $fiche_retour_caisse->update($data);

        return back()->with('success', 'Numéro comptable ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_entity = auth()->user()->current_entity();
        $fiche_retour_caisse = FicheRetourCaisse::find($id);
        $comptes = ConfigurationCompte::where('entity_id',$current_entity->entity_id)->get();
        // dd($fiche_retour_caisse);

        return view('return_to_cash_sheet.show', compact('fiche_retour_caisse', 'comptes'));
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
