<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\CityEntity;
use App\Models\RecipeSheet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RecipeSheetOrderMail;
use App\Models\WordingRecipeSheet;
use Illuminate\Support\Facades\DB;
use App\Mail\CreateRecipeSheetMail;
use Illuminate\Support\Facades\Mail;
use App\Models\AttachementRecipeSheet;
use App\Models\ConfigurationCompte;
use App\Models\Role;
use App\Models\SiteRecipeSheet;

class RecipeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $recipe_sheets = "";
        if(auth()->user()->isAdmin() || auth()->user()->isComptable() || auth()->user()->isControleur() || auth()->user()->isControler_recipe() || auth()->user()->isCaissier()){
            $recipe_sheets = RecipeSheet::where('entity_id', $current_entity_id)->get();
        }else{
            $recipe_sheets = RecipeSheet::where(['user_id' => auth()->user()->id, 'entity_id'=> $current_entity_id])->orWhere('apporteur',auth()->user()->id)->get();
        }
        // dd($recipe_sheets);
        return view('recipe_sheet.index', compact('recipe_sheets'));
    }

    public function by_day()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $recipe_sheets = "";

        if(auth()->user()->isAdmin() || auth()->user()->isComptable() || auth()->user()->isControleur() || auth()->user()->isControler_recipe() || auth()->user()->isCaissier()){
            $recipe_sheets = RecipeSheet::where('entity_id', $current_entity_id)
                                            ->whereDate('created_at', now())
                                            ->get();
        }

        return view('recipe_sheet.index', compact('recipe_sheets'));


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
        $controler_recipes= $ordonateurs = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 9)->get();
        // $cities = Entity::find($fonction->user_entity->entity_id)->cities;
        // $sites = SiteRecipeSheet::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->get();
        // $sites = Site::all();
        // dd($sites);

        return view('recipe_sheet.create', compact('users','controler_recipes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());
        $data = $request->validate([
            "apporteur" => "required",
            "provenance" => "required",
            "mode_paiment" => "required",

            // 'recipe_sheet_id' => "required",
            "addMoreInput.*.libelle" => "required",
            "addMoreInput.*.prix_unitaire" => "required|numeric|min:0",
            "addMoreInput.*.quantite" => "required|numeric|min:0",
            "addMoreInput.*.dossier" => "required",
            "addMoreInput.*.site_prod" => "required",
        ],[
            "apporteur.required" => 'L\'apporteur est à choisir',
            "provenance.required" => 'La provenance est à choisir',
            "mode_paiment.required" => 'Le mode de paiment est à choisir',

            "addMoreInput.*.libelle.required" => 'Le libellé est à renseigner',
            "addMoreInput.*.prix_unitaire.required" => 'Le prix unitaire est à renseigner',
            "addMoreInput.*.prix_unitaire.numeric" => 'Le prix unitaire doit être un nombre',
            "addMoreInput.*.prix_unitaire.min" => 'Le prix unitaire doit être positif',
            "addMoreInput.*.quantite.required" => 'La quantite est à renseigner',
            "addMoreInput.*.quantite.numeric" => 'La quantite doit être un nombre',
            "addMoreInput.*.quantite.min" => 'La quantite doit être positif',
            "addMoreInput.*.dossier.required" => 'Le numero de dossier est à renseigner',
            "addMoreInput.*.site_prod.required" => 'Le site de production est à renseigner',
        ]);
        // dd($data);
        // dd($request->all());
        if($request->raison_sociale){
            $data['raison_sociale'] = $request->raison_sociale;
        }

        if($request->numero_contribuable){
            $data['numero_contribuable'] = $request->numero_contribuable;
        }

        if($request->contact){
            $data['contact'] = $request->contact;
        }

        if($request->montant){
            $data['montant'] = $request->montant;
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

        $data['user_id'] = auth()->user()->id;

        $city_entity = CityEntity::find($data['city_entity_id']);

        $data['entity_id'] = $city_entity->entity_id;



        DB::beginTransaction();

        $recipe_sheet = RecipeSheet::create($data);

        $addMoreInput = $request->addMoreInput;
        foreach($addMoreInput as $wordin_recipe_shees){
            WordingRecipeSheet::create([
                'recipe_sheet_id' => $recipe_sheet->id,
                'libelle' => $wordin_recipe_shees['libelle'],
                'prix_unitaire' => $wordin_recipe_shees['prix_unitaire'],
                'quantite' => $wordin_recipe_shees['quantite'],
                'prix_total' => $wordin_recipe_shees['prix_unitaire'] * $wordin_recipe_shees['quantite'],
                'dossier' => $wordin_recipe_shees['dossier'],
                'site_prod' => $wordin_recipe_shees['site_prod'],

            ]);
        }

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
                AttachementRecipeSheet::create([
                    'recipe_sheet_id' => $recipe_sheet->id,
                    'filename' => $file->store('images', 'public'),
                ]);
            }
            // dump($libel);
            // dd($libel);
        }

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $contenu = [
            'title' => 'Soumission fiche de recette',
            'recipe_sheet_id' => $recipe_sheet->id,
            'entie' => $entity_sigle
        ];




        $controler_recipe = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 8)->first();
            Mail::to($controler_recipe->email)->send(new CreateRecipeSheetMail($contenu));

        DB::commit();
        return redirect()->route('recipe_sheet.index')->with('success', 'Fiche validée avec succès');
    }


    public function recipe_sheet_validation(Request $request, RecipeSheet $recipe_sheet)
    {

        $data = $request->validate([
            "fonction" => "required",
        ]);
        $data['recipe_sheet_id'] = $recipe_sheet->id;
        // dd($recipe_sheet);


        // validation contôleur recette support client

        if ($request->fonction == 'support_partenaire') {

            $recipe_sheet->observation_support_partenaire = $request->observation_support_partenaire;
            $recipe_sheet->num_rappot_de_shift = $request->num_rappot_de_shift;
            $recipe_sheet->support_partenaire = auth()->user()->id;
            // dd($recipe_sheet->support_partenaire);

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            // $support_partenaire = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            // ->whereRelation('privileges', 'role_id', '=', 8)->first();
            $support_partenaire = auth()->user();
            $comptable = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 1)->first();

            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'recipe_sheet' => $recipe_sheet,
                'fonction' => 'le support partenaire',
                'user' => $support_partenaire,
                'entie' => $entity_sigle
            ];

            Mail::to($comptable->email)->send(new RecipeSheetOrderMail($mailData));
        }

        // validation apporteur

        if ($request->fonction == 'apporteur') {

            $recipe_sheet->statut = 'validée par apporteur';
            $recipe_sheet->observation_apporteur = $request->observation_apporteur;

            $apporteurs = $recipe_sheet->apporteurs;
            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $support_partenaire = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 8)->first();

            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'recipe_sheet' => $recipe_sheet,
                'fonction' => 'l\' apporteur',
                'user' => $apporteurs,
                'entie' => $entity_sigle
            ];

            Mail::to($support_partenaire->email)->send(new RecipeSheetOrderMail($mailData));
        }

                // Validation caisse
        if ($request->fonction == 'caisse') {

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
                ->whereRelation('privileges', 'role_id', '=', 6)->first();

            $apporteurs = $recipe_sheet->apporteurs;

            $recipe_sheet->statut = 'encaissé';
            $recipe_sheet->observation_caisse = $request->observation_caisse;

            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'recipe_sheet' => $recipe_sheet,
                'fonction' => 'Caisse',
                'user' => $caisse,
                'entie' => $entity_sigle
            ];

            Mail::to($apporteurs->email)->send(new RecipeSheetOrderMail($mailData));
        }

        // Validation contrôleur recette = coordonnateur sur le terrain
        if ($request->fonction == 'controler_recipe') {

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $caisse = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 6)->first();

            $controlleur = User::where('id', $recipe_sheet->controlleur)->first();

            $recipe_sheet->statut = 'validée par contrôleur';
            $recipe_sheet->observation_controlleurer = $request->observation_controlleurer;

            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;


            $mailData = [
                'recipe_sheet' => $recipe_sheet,
                'fonction' => 'Contrôleur',
                'user' => $controlleur,
                'entie' => $entity_sigle
            ];


            Mail::to($caisse->email)->send(new RecipeSheetOrderMail($mailData));
        }

        $recipe_sheet->update();

        return back()->with('success', 'Signature effectuée avec succès');
    }

    // addition du numéro comptable
    public function add_num_comptable(Request $request, RecipeSheet $recipe_sheet)
    {
        // dd($recipe_sheet->all());
        $data = $request->validate([
            //"num_comptable" => 'required|unique:recipe_sheet,num_comptable',
            "num_compte_general" => 'required|digits_between:1,8',
            'code_tiers'=> ['required', 'regex:/^([0-9]){4}(([0-9a-zA-Z]){0,10})$/'], //Lien pour tester l'expression reguliere: https://regex101.com/r/0w2Mxa/1 ; Lien pour comprendre les expressions regulieres https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/regex-metacaractere/
            // 'section_analytique'=> 'required|digits_between:1,12',
            'ref_compte'=> 'required',
        ],[
            'num_compte_general.digits_between' => 'Ce champs requiert maximum 8 chiffres',
            'num_comptable.required' => 'Ce champs est requis',
            'num_comptable.unique' => 'Ce numéro est déjà utilisé',
            'code_tiers.required' => 'Ce champs est requis',
            'code_tiers.regex' => 'Ce champs est constitué de 4 chiffres au début et 10 caractères maximum ensuite',
            'ref_compte.required' => 'Ce champs est requis',
        ]);

        // Format du numero comptable;
        if($request->num_comptable){
            $data['num_comptable'] = $request->num_comptable;
        }

        $length_of_num_comptable = Str::length($data['num_compte_general']);
        $zeros = '';

        for($k = 1; $k <= 8 - $length_of_num_comptable; $k++){
            $zeros .= '0';
        }
        $data['num_compte_general'] = $data['num_compte_general'] . '' . $zeros ;


        $data['section_analytique'] = $request->section_analytique;

        if($request->num_cheque_virement){
            $data['num_cheque_virement'] = $request->num_cheque_virement;
        }

        if($request->num_facture){
            $data['num_facture'] = $request->num_facture;
        }
            $data['montant_a_payer'] = $recipe_sheet->montant;

        // dd($data);

        if($request->montant_dette){
            $request->validate([
                "montant_a_payer" => ['numeric','digits_between:1,13'],
                // "montant_dette" => 'numeric|digits_between:1,13|after_or_equal:montant_a_payer',
            ],[
                'montant_dette.numeric' => 'Ce champs doit etre un nombre',
                'montant_dette.digits_between' => 'Ce champs doit avoir 15 chiffres au maximum',
                'montant_dette.after_or_equal' => 'Ce champs ne doit pas etre inferieur au montant payé',
            ]);

            if($request->montant_dette){
                $data['montant_dette'] = $request->montant_dette;
            }


            // if($data['montant_dette'] < $data['montant_a_payer']){
                //     return back()->with('error', 'Le montant dette ne doit pas etre inferieur au montant payé');
                // }
            }

            if($request->retenu_source){
                $data['retenu_source'] = $request->retenu_source;
                $data['num_attestation'] = $request->num_attestation;
            }

            $data['comptable'] = auth()->user()->id;

        


        $recipe_sheet->update($data);

        return back()->with('success', 'Numéro comptable ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show($id)
    {
        // dd($id);
        $current_entity = auth()->user()->current_entity();

        $recipe_sheet = RecipeSheet::find($id);
        $total_montant = $recipe_sheet->labels->sum('prix_total');

        // dd($total_montant);

        $comptes = ConfigurationCompte::where('entity_id',$current_entity->entity_id)->get();
        return view('recipe_sheet.show', compact('recipe_sheet', 'comptes','total_montant'));

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
