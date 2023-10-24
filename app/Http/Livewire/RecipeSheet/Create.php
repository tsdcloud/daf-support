<?php

namespace App\Http\Livewire\RecipeSheet;

use App\Mail\CreateRecipeSheetMail;
use App\Models\CityEntity;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\Produce;
use App\Models\RecipeSheet;
use App\Models\User;
use App\Models\WordingRecipeSheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Create extends Component
{
    public $cities;
    public $sites;
    public $shift;
    public $montant;

    public $libelle;
    public $libelle_id;

    public $prixUnitaire;
    public $quantite;
    public $dossier;
    public $prixTotal;

    public $prixTotalGlobal;

    public $arrayData = [];
    public $arrayIndex = 0;

    public $city_entity_id;
    public $site_id;

    public $apporteur;
    public $raisonSociale;
    public $numeroContribuable;
    public $contact;
    public $provenance;
    public $modePaiment;
    public $controlleur;
    public $user_name;

    public array $users = [];
    public int $selectedUser = 0;
    public $hiddenUser = "";
    public bool $showDropdown = true;


    public $fonction;

    public $filenames = [];

    public $rules = [
        "libelle" => 'required|string',
        "prixUnitaire" => 'required|integer',
        "quantite" => 'required|integer',
        "dossier" => 'required|string',
        // "rowData.prix_total" => 'required',
    ];

    public $messages = [
        "libelle.required" => 'Ce champ est requis',
        "prixUnitaire.required" => 'Ce champ est requis',
        "quantite.required" => 'Ce champ est requis',
        "dossier.required" => 'Ce champ est requis',

        "libelle.string" => 'Ce champ doit etre une chaine de caractere',
        "prixUnitaire.integer" => 'Ce champ doit etre un nombre',
        "quantite.integer" => 'Ce champ doit etre un nombre',
        "dossier.string" => 'Ce champ doit etre une chaine de caractere',
        // "rowData.prix_total.required" => 'Ce champ est requis',
    ];

    protected $listeners = ['totalPriceToCalculate' => 'totalPriceToCalculate',
                            // 'apporteur',
                            // 'provenance',
                            // 'modePaiment',
                            ];

    public function mount(){
        $this->fonction = Fonction::find(session('fonction_id')['fonction_id']);
        $this->cities = $this->fonction->user_entity->entity->cities;
        // $this->cities = Entity::find($this->fonction->user_entity->entity_id)->cities;

        // $this->sites = $sites;
        $this->sites = null;
        // $this->users = $users;
        // dd($this->cities);

        if(!empty($this->cities)){
            $city = $this->cities->first();
            $this->city_entity_id = $city->pivot->id;
            // dd($city->sites);
            $this->sites = $city->sites;
        }

        $this->reinitializeVariables();

        $this->prixTotalGlobal = 0;
    }

    public function updatedCityEntityId(){
        $city_entity = CityEntity::find($this->city_entity_id);
        $this->sites = $city_entity->city->sites;

        $this->emit('reinitializeSelectScript');
    }

    public function render()
    {
        $fonction = Fonction::find(session('fonction_id')['fonction_id']);

        return view('livewire.recipe-sheet.create',[
            'controlleurs' =>User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)
                                        ->whereRelation('privileges', 'role_id', '=', 9)->get(),

            // 'produces' => Produce::where('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->get(),
            'produces'=> Produce::where('entity_id',$fonction->user_entity->entity_id)->get(),
            // dd('produces'),

        ]);
    }

    public function updatedLibelleId(){

        if($this->city_entity_id!= 0)
        {

            $produce = Produce::where('id',$this->libelle_id)->first();
            $this->libelle = $produce->label;
            $this->prixUnitaire = $produce->prix_unitaire;

            $this->updatedPrixUnitaire();

        }
        else {
            // $produce = Produce::where('id',$this->libelle_id)->first();
            // $this->libelle = $produce->label;
            // $this->prixUnitaire = $produce->prix_unitaire;

            // $this->updatedPrixUnitaire();
        }

    }


    public function hydrate(){
        // $fonction = Fonction::find(session('fonction_id')['fonction_id']);
        // $this->emit('select2');
        $this->cities = Entity::find($this->fonction->user_entity->entity_id)->cities;
    }


    public function hideDropdown(){

        $this->showDropdown = false;
    }


public function selectUser($id = null){


    $user = $this->users[$id] ?? null;

    if ($user) {
        $this->showDropdown = true;
        $this->user_name = $user['email'];
        $this->selectedUser = $user['id'];

        // on masque la liste group
        $this->hiddenUser = "hidden";
    }
}

public function updatedUserName()
    {
        //en cas de modification on l'affiche
        $this->hiddenUser = "";
            $this->users = User::where(function($query){
                $query->orWhere('lname' , 'ilike', '%' . $this->user_name . '%');
                $query->orWhere('fname' , 'ilike', '%' . $this->user_name . '%');
                $query->orWhere('email' , 'ilike', '%' . $this->user_name . '%');
            })
            ->take(4)
            ->get()
            ->toArray();

        if ($this->user_name != null)
            $this->selectedUser = 0;

    }

    public function reinitializeVariables(){
        $this->libelle = null;
        $this->libelle_id = null;
        $this->prixUnitaire = null;
        $this->quantite = null;
        $this->dossier = null;
        $this->prixTotal = null;
    }


    public function updatedQuantite(){

        if($this->quantite === ''){

            $this->prixTotal = "";
            return 0;
        }

        if($this->prixUnitaire === '')
        {

            $this->prixTotal = "";
            return 0;
        }

       $this->prixTotal = $this->prixUnitaire * $this->quantite;
        // dd($this->quantite);
    }
    public function updatedPrixUnitaire(){

        if($this->quantite === ''){

            $this->prixTotal = "";
            return 0;
        }

        if($this->prixUnitaire === '')
        {

            $this->prixTotal = "";
            return 0;
        }

       $this->prixTotal = $this->prixUnitaire * $this->quantite;
        // dd($this->quantite);
    }

 //   public function

    public function reverseRowData(){
        $this->arrayData = array_reverse($this->arrayData, true);
    }
    public function addRowData(){

        if($this->city_entity_id!= 0)
        {

            $this->validate([
                "libelle" => 'required|string',
                // "prixUnitaire" => 'required|integer',
                "quantite" => 'required|integer',
                // "dossier" => 'required|string'
            ],[
                "libelle.required" => 'Ce champ est requis',
                "prixUnitaire.required" => 'Ce champ est requis',
                "quantite.required" => 'Ce champ est requis',
                "dossier.required" => 'Ce champ est requis',

                "libelle.string" => 'Ce champ doit etre une chaine de caractere',
                "prixUnitaire.integer" => 'Ce champ doit etre un nombre',
                "quantite.integer" => 'Ce champ doit etre un nombre',
                "dossier.string" => 'Ce champ doit etre une chaine de caractere'
            ]);

        }
        else {
            // $this->validate([
            //     "libelle" => 'required|string',
            //     "prixUnitaire" => 'required|integer',
            //     "quantite" => 'required|integer',
            //     // "dossier" => 'required|string'
            // ],[
            //     "libelle.required" => 'Ce champ est requis',
            //     "prixUnitaire.required" => 'Ce champ est requis',
            //     "quantite.required" => 'Ce champ est requis',
            //     "dossier.required" => 'Ce champ est requis',

            //     "libelle.string" => 'Ce champ doit etre une chaine de caractere',
            //     "prixUnitaire.integer" => 'Ce champ doit etre un nombre',
            //     "quantite.integer" => 'Ce champ doit etre un nombre',
            //     "dossier.string" => 'Ce champ doit etre une chaine de caractere'
            // ]);
        }


        $this->prixTotal = $this->prixUnitaire * $this->quantite;
        $this->prixTotalGlobal = $this->prixTotalGlobal + $this->prixTotal;

        $this->arrayData[] = [
            "libelle"=>$this->libelle,
            "prixUnitaire"=>$this->prixUnitaire,
            "quantite"=>$this->quantite,
            "dossier"=>$this->dossier,
            "prixTotal"=>$this->prixTotal,
        ];
        $this->reverseRowData();
        $this->reinitializeVariables();
    }
    public function totalPriceToCalculate(){
        // dd($this->rowData);
        // dd('ok');
        // if($this->prixUnitaire != null && $this->quantite != null){
            $this->prixTotal = $this->prixUnitaire * $this->quantite;

            dump($this->libelle);
            dump($this->prixUnitaire);
            dump($this->quantite);
            dump($this->dossier);
            dump($this->prixTotal);
        // }else{
        //     $this->prixTotal = null;
        // }
    }
    public function totalPriceToCalculate2(){
        // dd($this->rowData);
        // dd('ok');
        if($this->quantite != null){
            $this->prixTotal = $this->prixUnitaire * $this->quantite;
        }else{
            $this->prixTotal = null;
        }
    }

    public function removeRowData($item){
        $this->prixTotalGlobal -= $this->arrayData[$item]['prixTotal'];
        //on retire l'index $item du tableau
        unset($this->arrayData[$item]);

        // On reorganise les index du tableau
        array_values($this->arrayData);
        $this->reverseRowData();
        $this->arrayIndex --;
    }

    public function editRowData($item){



        $this->libelle = $this->arrayData[$item]['libelle'];
        $this->prixUnitaire = $this->arrayData[$item]['prixUnitaire'];
        $this->quantite = $this->arrayData[$item]['quantite'];
        $this->dossier = $this->arrayData[$item]['dossier'];
        $this->prixTotal = $this->arrayData[$item]['prixTotal'];

        $this->prixTotalGlobal -= $this->arrayData[$item]['prixTotal'];
        //on retire l'index $item du tableau
        unset($this->arrayData[$item]);

        // On reorganise les index du tableau
        array_values($this->arrayData);
        $this->reverseRowData();
        $this->arrayIndex --;
    }

    public function submitData(){

        // Validation des donnée provenant du formulaire livewire
        $this->validate([
            "selectedUser" => "required",
            "provenance" => "required",
            "modePaiment" => "required",
            "city_entity_id" => "required",
            "site_id" => "required",
            "selectedUser" => "required",
            "controlleur" => "required|numeric",

            "prixTotalGlobal" => "required|min:1",


            "arrayData" => "required",
        ],[
            "selectedUser.required" => 'Ce champ est requis',
            "provenance.required" => 'Ce champ est requis',
            "modePaiment.required" => 'Ce champ est requis',
            "selectedUser.required" => 'Ce champ est requis',
            "controlleur.required" => 'Ce champ est requis',
            "controlleur.numeric" => 'Sélectionnez dans la liste déroulante',

            "prixTotalGlobal.required" => 'Ce champ est requis',
            "prixTotalGlobal.min" => 'Ce champ doit etre non nul',

            "arrayData.required" => 'Ce champ est requis'
        ]);

        // dd($this->all());


        //enregistrement des données dans un tableau data
        $data = [];

        if($this->raisonSociale){
            $data['raison_sociale'] = $this->raisonSociale;
        }

        if($this->numeroContribuable){
            $data['numero_contribuable'] = $this->numeroContribuable;
        }

        if($this->contact){
            $data['contact'] = $this->contact;
        }

        if($this->prixTotalGlobal){
            $data['montant'] = $this->prixTotalGlobal;
        }

        if($this->shift){
            $data['shift'] = $this->shift;
        }

        if($this->city_entity_id){
            $data['city_entity_id'] = $this->city_entity_id;
        }

        if($this->site_id){
            $data['site_id'] = $this->site_id;
        }

        $data['user_id'] = auth()->user()->id;

        $city_entity = CityEntity::find($data['city_entity_id']);

        $data['entity_id'] = $city_entity->entity_id;

        //  Si l'apporteur est vide l'auteur prend sa place
        if($this->selectedUser == is_null($this->selectedUser)){
            // dd('ok_null');
            $data["apporteur"] = auth()->user()->id;
        }
        else{
            $data["apporteur"] = $this->selectedUser;
        }

        // $data["shift"] = $this->shift;
        // $data["apporteur"] = $this->selectedUser;
        $data["provenance"] = $this->provenance;
        $data["mode_paiment"] = $this->modePaiment;
        $data["controlleur"] = $this->controlleur;


        // début enregistrement
        DB::beginTransaction();

        // Enregistrement des données de la fiche
        $recipe_sheet = RecipeSheet::create($data);


        // Enregistrement des libéllés
        $addMoreInput = $this->arrayData;

        foreach($addMoreInput as $wordin_recipe_shees){
            WordingRecipeSheet::create([
                'recipe_sheet_id' => $recipe_sheet->id,
                'libelle' => $wordin_recipe_shees['libelle'],
                'prix_unitaire' => $wordin_recipe_shees['prixUnitaire'],
                'quantite' => $wordin_recipe_shees['quantite'],
                'prix_total' => $wordin_recipe_shees['prixTotal'],
                'dossier' => $wordin_recipe_shees['dossier'],
                'site_prod' => $data['site_id'],
            ]);
        }

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        // envois de mail au coordonnateur désigné a la créeation
        $contenu = [
            'title' => 'Soumission de la fiche de recette',
            'recipe_sheet_id' => $recipe_sheet->id,
            'recipe_sheet' => $recipe_sheet,
            'entie' => $entity_sigle
        ];


        $controlleur = User::where('id', $this->controlleur)->first();
        // dd($contenu);
            Mail::to($controlleur->email)->send(new CreateRecipeSheetMail($contenu));

        DB::commit();
        return redirect()->route('recipe_sheet.index')->with('success', 'Fiche validée avec succès');

    }
}
