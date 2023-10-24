<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\FicheDepenseOrderMail;
use App\Mail\FicheDepenseRejetMail;
use App\Models\AttachmentExpenseSheet;
use App\Models\CityEntity;
use App\Models\ConfigurationCompte;
use App\Models\Entity;
use App\Models\FicheDepense;
use App\Models\Fonction;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_encours()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'user_id' => auth()->user()->id
        ])->get();
        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imputable()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'statut' => 'décaissé',
            // 'user_id' => auth()->user()->id
        ])->get();
        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    /**
     * Display a listing of the expense sheet ordonnancable.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordonnancable()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'statut' => 'en cours',
            'ordonateur'=>auth()->user()->id,
        ])->get();
        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    /**
     * Display a listing of the expense sheet controller bubjetary.
     *
     * @return \Illuminate\Http\Response
     */
    public function controle_budgetaire()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'statut' => 'en cours_conf',
            'controlleur' => auth()->user()->id
        ])->get();
        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    /**
     * Display a listing of the expense sheet controller conformity.
     *
     * @return \Illuminate\Http\Response
     */
    public function controle_conformite()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'statut' => 'en attente',
        ])->get();
        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function encours()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where([
            'entity_id'=> $current_entity_id,
            'ordonateur_rejet' => null,
            'controleur_rejet' => null,
            'controleur_conf_rejet' => null,
            'num_comptable' => null,
            'entity_id' => auth()->user()->current_entity()->entity_id,
            // 'city_id' => auth()->user()->current_entity()->entity_id->ent,
        ])->get();


        return view('expense_sheet.encours', compact('fiche_depenses'));
    }

    public function validated()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where('num_comptable', '!=', null)->get();
        $fiche_depenses = FicheDepense::where(['entity_id'=> $current_entity_id])
                                        ->whereNotNull('num_comptable')->get();
        return view('expense_sheet.validated', compact('fiche_depenses'));
    }

    public function rejected()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $fiche_depenses = FicheDepense::where(['entity_id'=> $current_entity_id])
        ->where('controleur_conf_rejet', '!=', null)
            ->orWhere(function ($query) {
                $query->where('ordonateur_rejet', '!=', null)
                    ->orWhere('controleur_rejet', '!=', null);
            })->get();


        return view('expense_sheet.rejected', compact('fiche_depenses'));
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
        $controllers = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 3)->get();
        $ordonateurs = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 2)->get();

        $cities = Entity::find(auth()->user()->current_entity()->entity_id)->cities;
        $sites = Site::all();
        // $sites = Site::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->get();
        //   $cities = Entity::whereHas('city_entities',function($q){
        //         $q->where('entity_id',auth()->user()->current_entity()->entity_id);
        //   })->get();
        // prendre les données pour les retourner à la vue du formulaire

        // $cities = Entity::
        return view('expense_sheet.create', compact('users','cities', 'controllers', 'ordonateurs','sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        /*configuration des messqges d'erreu*/
        $request->validate([
            "beneficiaire" => 'required|numeric',
            "montant" => 'required|numeric',
            "mode_paiment" => 'required',
            "controlleur" => 'required|numeric',
            "ordonateur" => 'required|numeric',
            "description" => 'required',
            "city_entity_id" => 'required',
            "site_id"=> 'required',
        ], [
            "beneficiaire.required" => 'Le beneficiaire est a choisir',
            "beneficiaire.numeric" => 'Le beneficiaire est a choisir',
            "montant.required" => 'Le montant est à préciser',
            "montant.numeric" => 'Le montant est de nombre',
            "mode_paiment.required" => 'choisissez un mode de paiment',
            "controlleur.numeric" => 'Choisissez un controlleur',
            "controlleur.required" => 'Choisissez un controlleur',
            "ordonateur.required" => 'Choisissez un ordonnateur',
            "ordonateur.numeric" => 'Choisissez un ordonnateur',
            "description.required" => 'vous devez faire une description de votre fiche',
            "city_entity_id.required" => 'Vous devez selectionner une ville',
            "site_id.required"=> 'Vous devez selectionner un site',
        ]);

        $beneficiaire = !is_null($request->beneficiaire) ? $request->beneficiaire : '';
        $montant = !is_null($request->montant) && is_numeric($request->montant) ?
            $request->montant : null;
        $mode_paiment = !is_null($request->mode_paiment) ? $request->mode_paiment : '';
        $controlleur = !is_null($request->controlleur) ? $request->controlleur : '';
        $ordonateur = !is_null($request->ordonateur) ? $request->ordonateur : '';
        $description = !is_null($request->description) ? $request->description : '';
        $numero_contribuable = !is_null($request->numero_contribuable) ?
            $request->numero_contribuable : '';
        $destinataire = !is_null($request->destinataire) ?
            $request->destinataire : '';
        $num_dossier = !is_null($request->num_dossier) ?
            $request->num_dossier : '';
        $city_entity_id = $request->city_entity_id;
        $site_id = $request->site_id;

        //  Si le destinataire est vide
        if($request->destinataire = is_null($request->destinataire)){

            // $beneficiaire = auth()->user()->current_entity();

            $destinataire = User::where('id',$beneficiaire)->first();

             $destinataire = $destinataire->fname.' '.$destinataire->lname;
        }

        DB::beginTransaction();
        $fiche_depense = FicheDepense::create([
            'beneficiaire' =>  $beneficiaire,
            'montant' =>      $montant,
            'mode_paiment' => $mode_paiment,
            'controlleur' => $controlleur,
            'ordonateur' => $ordonateur,
            'description' => $description,
            'numero_contribuable' => $numero_contribuable,
            'destinataire' => $destinataire,
            'num_dossier' => $num_dossier,
            'user_id' => auth()->user()->id,
            'date_etablissement' => date('Y-m-d H:i:s'),
            'entity_id' =>  auth()->user()->current_entity()->entity_id,
            'city_entity_id' =>  $city_entity_id,
            'site_id' => $site_id,
        ]);

        if($request->has('filenames')){
            $request->validate([
                'filenames.*' => 'required|image|mimes:jpeg,png,jpg,tiff,bipmap,svg,raw|max:10240',
            ],[
                'filenames.*.required' => 'Fichier requis',
                'filenames.*.image' => 'Fichier doit etre de type image',
                'filenames.*.mimes' => 'Fichier doit etre de type image (jpeg, png, jpg)',
            ]);

            foreach($request->filenames as $file){
                AttachmentExpenseSheet::create([
                    'fiche_depense_id' => $fiche_depense->id,
                    'filename' => $file->store('images', 'public'),
                ]);
            }
        }

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;
        // dd($entity_c->sigle);

        $contenu = [
            'title' => 'Soumission fiche depense',
            'fiche_depense_id' => $fiche_depense->id,
            'entie' => $entity_sigle

        ];

        $user_controllers = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 4)->get();

        foreach ($user_controllers as $user) {
            Mail::to($user->email)->send(new ContactMail($contenu));
        }
        DB::commit();
        return redirect()->route('expense_sheet.encours')->with('message', 'Fiche de dépense créée avec succès');
    }

    public function rejet_conf_fiche_depense(Request $request, FicheDepense $fiche_depense)
    {

        $data = $request->validate([
            'controleur_conf_rejet.*' => 'required'
        ]);

        // dd($data['controleur_conf_rejet']);
        $fiche_depense->controleur_conf_rejet = implode(",", $data['controleur_conf_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
            'entie' => $entity_sigle
        ];
        Mail::to($demandeur->email)->send(new FicheDepenseRejetMail($mailData));

        return back()->with('success', 'Fiche de dépense rejétée');
    }

    public function rejet_budj_fiche_depense(Request $request, FicheDepense $fiche_depense)
    {

        $data = $request->validate([
            'controleur_rejet.*' => 'required'
        ]);

        $fiche_depense->controleur_rejet = implode(",", $data['controleur_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
            'entie' => $entity_sigle
        ];
        Mail::to($demandeur->email)->send(new FicheDepenseRejetMail($mailData));

        return back()->with('success', 'Fiche de dépense rejétée');
    }

    public function rejet_ordonateur_fiche_depense(Request $request, FicheDepense $fiche_depense)
    {

        $data = $request->validate([
            'ordonateur_rejet.*' => 'required'
        ]);

        $fiche_depense->ordonateur_rejet = implode(",", $data['ordonateur_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
            'entie' => $entity_sigle
        ];
        Mail::to($demandeur->email)->send(new FicheDepenseRejetMail($mailData));

        return back()->with('success', 'Fiche de dépense rejétée');
    }

    public function fiche_depense_validation(Request $request, User $user)
    {

        $data = $request->validate([
            "fiche_depense_id" => "required",
            "fonction" => "required",
        ]);
        $fiche_depense = FicheDepense::find($request->fiche_depense_id);

        if ($request->fonction == 'ordonateur') {
            $fiche_depense->statut = 'validée';

            $ordonateur = $fiche_depense->ordonateurs;
            $beneficiaires = $fiche_depense->beneficiaires;
            $caisse = User::whereRelation('privileges', 'role_id', '=', 6)->first();

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;


            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'l\'ordonateur',
                'user' => $ordonateur,
                'entie' => $entity_sigle
            ];
            Mail::to($beneficiaires->email)->send(new FicheDepenseOrderMail($mailData));
            Mail::to($caisse->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'controlleur') {
            $fiche_depense->statut = 'en cours';

            $controlleur = $fiche_depense->controlleurs;
            $ordonateur = $fiche_depense->ordonateurs;

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le controleur budgétaire',
                'user' => $controlleur,
                'entie' => $entity_sigle
            ];
            Mail::to($ordonateur->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'controlleur_conf') {
            $fiche_depense->statut = 'en cours_conf';

            $controlleur_confs = User::find(auth()->user()->id);
            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;
            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le controleur conformité',
                'user' => $controlleur_confs,
                'entie' => $entity_sigle
            ];

            $controlleur = $fiche_depense->controlleurs;

            Mail::to($controlleur->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'beneficiaire') {
            $fiche_depense->statut = 'décaissé';

            $beneficiaires = $fiche_depense->beneficiaires;
            $comptable = User::whereRelation('privileges', 'role_id', '=', 1)->first();

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le bénéficiaire',
                'user' => $beneficiaires,
                'entie' => $entity_sigle
            ];
            Mail::to($comptable->email)->send(new FicheDepenseOrderMail($mailData));
        }

        $fiche_depense->update();

        return back()->with('success', 'Signature effectuée avec succès');
    }

    public function add_num_comptable(Request $request, FicheDepense $fiche_depense)
    {

        // dd($request->all());
        $data = $request->validate([
            "num_comptable" => 'required|unique:fiche_depenses',
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

        $data['section_analytique'] = $fiche_depense->num_dossier;

        if($request->num_cheque_virement){
            $data['num_cheque_virement'] = $request->num_cheque_virement;
        }

        if($request->num_facture){
            $data['num_facture'] = $request->num_facture;
        }


        $data['montant_a_payer'] = $fiche_depense->montant;

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
        $fiche_depense->update($data);

        return back()->with('success', 'Numéro comptable ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FicheDepense $fiche_depense)
    {

        $current_entity = auth()->user()->current_entity();

        $comptes = ConfigurationCompte::where('entity_id',$current_entity->entity_id)->get();


        return view('expense_sheet.show', compact('fiche_depense', 'comptes'));
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
