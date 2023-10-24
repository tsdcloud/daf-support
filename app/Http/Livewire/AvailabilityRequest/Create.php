<?php

namespace App\Http\Livewire\AvailabilityRequest;

use App\Models\Site;
use App\Models\User;
use App\Models\Entity;
use App\Models\Article;
use Livewire\Component;
use App\Models\Fonction;
use App\Models\CityEntity;
use App\Models\Department;
use App\Models\FamilyArticle;
use Illuminate\Support\Facades\DB;
use App\Mail\CreateRecipeSheetMail;
use Illuminate\Support\Facades\Mail;
use App\Models\AvailabilityRequestSheet;
use App\Models\WordingAvailabilityRequestSheet;
use App\Mail\CreateAvailabilityRequestSheetMail;

class Create extends Component
{


    public $cities;
    public $sites;
    public $users;
    public $service_demandeur;
    public $chef_depart;
    public $controlleur;
    public $fonction;

    public $designation;
    public $quantite;
    public $motif;
    public $beneficiaire;
    public $date_debut_usage;
    public $user_observation;

    public $family_articles;
    public $articles;
    // $availability_request_sheet->user_observation = $request->user_observation;


    // public $prixTotalGlobal;

    public $arrayData = [];
    public $arrayIndex = 0;

    public $city_entity_id;
    public $site_id;

    public $family_article_id ;
    public $article_id;

    public $numero_contribuable;
    public $num_dossier;
    public $produit;
    public $controllers;
    public $chef_departs;
    public $service_demandeurs;
    public $current_user_entity;
    public $validatedData;


    public $filenames = [];

    // public $rules = [
    //     "designation" => 'required|string',
    //     "beneficiaire" => 'required|numeric',
    //     "quantite" => 'required|integer',
    //     "motif" => 'required|string',
    //     "date_debut_usage" => 'required',
    // ];

    public $messages = [
        "designation.required" => 'Ce champ est requis',
        "quantite.required" => 'Ce champ est requis',
        "motif.required" => 'Ce champ est requis',
        "beneficiaire.required" => 'Ce champ est requis',

        "designation.string" => 'Ce champ doit etre une chaine de caractere',
        "quantite.integer" => 'Ce champ doit etre un nombre',
        "motif.string" => 'Ce champ doit etre une chaine de caractere',
        "beneficiaire.numeric" => 'choisissez un bénéficiaire',
        "date_debut_usage.required" => 'Ce champ est requis',
    ];

    // public function updatedFamilyArticleId($new_fa){

    //     // $articles = Article::where('family_article_id',$this->family_article_id)->first();
    //     $this->articles = Article::where('family_article_id',$new_fa)->orderBy("label")->get;

    //     // $this->emit('reinitializeSelectScript');
    // }


    public function updated($propertyName)
{
    $this->validateOnly($propertyName, [
        'arrayData' => 'required|array',
        'arrayData.*' => 'required|string',
    ]);
}

    public function mount($cities,$sites, $users,$controllers,$chef_departs,$service_demandeurs,$fonction,){

        $this->cities = $cities;
        $this->sites = $sites;
        $this->users = $users;
        $this->controllers = $controllers;
        $this->chef_departs = $chef_departs;
        $this->service_demandeurs = $service_demandeurs;
        $this->fonction = $fonction;
        $this->family_articles = FamilyArticle::all();
        $this->articles = Article::all();
        // $this->articles = collect();
        // dd($this->articles);


        $this->reinitializeVariables();
    }

    public function render()
    {
        // On récupère les famille d'article
        $family_articles = FamilyArticle::select("id", "label")->get();
        $articles = Article::select("id", "label")->get();
        return view('livewire.availability-request.create',[
            'family_articles' =>$family_articles,
            'articles' =>$articles,
        ]);
    }

    public function updatedCityEntityId(){
        $city_entity = CityEntity::find($this->city_entity_id);
        $this->sites = $city_entity->city->sites;

        $this->emit('reinitializeSelectScript');
    }



    // public function updatedService_demandeur(){

    //     $service_demandeur = Department::find(auth()->user()->current_entity()->entity_id)->title;

    // }

    public function hydrate(){
        // $fonction = Fonction::find(session('fonction_id')['fonction_id']);
        $this->cities = Entity::find($this->fonction->user_entity->entity_id)->cities;
        // $this->articles = Article::find('family_article_id','=',$this->family_articles_id)->id;

    }

    public function reinitializeVariables(){
        $this->designation = null;
        $this->quantite = null;
        $this->motif = null;
        $this->beneficiaire = null;
        $this->date_debut_usage = null;
    }

    // public function updatedQuantite(){

    //     if($this->quantite === ''){

    //         $this->prixTotal = "";
    //         return 0;
    //     }

    //     if($this->prixUnitaire === '')
    //     {

    //         $this->prixTotal = "";
    //         return 0;
    //     }

    //    $this->prixTotal = $this->prixUnitaire * $this->quantite;
    //     // dd($this->quantite);
    // }

    public function reverseRowData(){
        $this->arrayData = array_reverse($this->arrayData, true);
    }

    public function addRowData(){
        $this->validate([
            "designation" => 'required|string',
            "quantite" => 'required|integer',
            "motif" => 'required|string',
            "beneficiaire" => 'required|integer',
            "date_debut_usage" => 'required',
        ],[
            "designation.required" => 'Ce champ est requis',
            "quantite.required" => 'Ce champ est requis',
            "motif.required" => 'le bénéficiaire est requis',
            "beneficiaire.required" => 'Ce champ est requis',

            "designation.string" => 'Ce champ doit etre une chaine de caractere',
            "quantite.integer" => 'Ce champ doit etre un nombre',
            "motif.string" => 'Ce champ doit etre une chaine de caractere',
            "beneficiaire.integer" => 'le bénéficiaire doit être choisi',
            "date_debut_usage.required" => 'Ce champ est requis',
        ]);

        // dump($this->all());
        // dump($this->beneficiaire);
        // dd(auth()->user()->id);
        if($this->beneficiaire=="null"){
            $this->arrayData[] = [
                "designation"=>$this->designation,
                "quantite"=>$this->quantite,
                "motif"=>$this->motif,
                // "beneficiaire"=>$this->beneficiaire,
                "beneficiaire"=>auth()->user()->id,
                "date_debut_usage"=>$this->date_debut_usage,
            ];
        }
        else{
            $this->arrayData[] = [
                "designation"=>$this->designation,
                "quantite"=>$this->quantite,
                "motif"=>$this->motif,
                "beneficiaire"=>$this->beneficiaire,
                // "beneficiaire"=>auth()->user()->id,
                "date_debut_usage"=>$this->date_debut_usage,
            ];
        }
        // dd($this->arrayData);

        $this->reverseRowData();
        $this->reinitializeVariables();
    }

    public function removeRowData($item){
        //on retire l'index $item du tableau
        unset($this->arrayData[$item]);

        // On reorganise les index du tableau
        array_values($this->arrayData);
        $this->reverseRowData();
        $this->arrayIndex --;
    }

    public function editRowData($item){

        $this->designation = $this->arrayData[$item]['designation'];
        $this->quantite = $this->arrayData[$item]['quantite'];
        $this->motif = $this->arrayData[$item]['motif'];
        $this->beneficiaire = $this->arrayData[$item]['beneficiaire'];
        $this->date_debut_usage = $this->arrayData[$item]['date_debut_usage'];

        //on retire l'index $item du tableau
        unset($this->arrayData[$item]);

        // On reorganise les index du tableau
        array_values($this->arrayData);
        $this->reverseRowData();
        $this->arrayIndex --;
    }

    public function submitData(){
        // dd($this);
        $current_user_entity = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $this->validate([
            // "service_demandeur" => "required",
            "chef_depart" => "required",
            "controlleur" => "required",
            "produit" => "required",
            "city_entity_id" => "required",
            "site_id" => "required",
            "user_observation" => "required",
            // 'arrayData.*' => 'required',
            // 'arrayData.*' => 'required|string',

        ],[
            // "service_demandeur.required" => 'Ce champ est requis',
            "chef_depart.required" => 'Ce champ est requis',
            "controlleur.required" => 'Ce champ est requis',
            "produit.required" => 'Ce champ est requis',
            "produit.user_observation" => 'Ce champ est requis',
            // "tableau.*.required" => 'Les éléments du tableau sont requis.',
        ]);

        $validatedData = $this->validate([
            'arrayData' => 'required|array',
            'arrayData.*' => 'required',
        ],
        [
            // "service_demandeur.required" => 'Ce champ est requis',
            'arrayData.required' => 'Le tableau est requis.',
            'arrayData.array' => 'Le tableau doit être de type tableau.',
            'arrayData.*.required' => 'Les éléments du tableau sont requis.',
            // 'arrayData.*.string' => 'Les éléments du tableau doivent être de type chaîne de caractères.',
        ]);

        if (empty($this->arrayData)) {
            // Le tableau est vide.
            $this->addError('tableau', 'Le tableau est requis.');
            return;
        }

        // Le tableau est valide et n'est pas vide.
        // dd($this);

        $data = [];

        // dd(Department::find(auth()->user()->current_entity()->entity_id)->title);
        // $data["service_demandeur"] = Department::find(Fonction::find(auth()->user()->current_user_entity()->id)->department_id)->id;
        $data["service_demandeur"] = Fonction::find(auth()->user()->current_user_entity()->id)->department_id;
        $data["chef_depart"] = $this->chef_depart;
        $data["controlleur"] = $this->controlleur;
        $data["produit"] = $this->produit;
        $data["user_observation"] = $this->user_observation;

        if($this->num_dossier){
            $data['num_dossier'] = $this->num_dossier;
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
        // dd($data);

        DB::beginTransaction();
        // dd($data);
        $availability_request_sheet = AvailabilityRequestSheet::create($data);

        $addMoreInput = $this->arrayData;

        // dd($addMoreInput);

        foreach($addMoreInput as $wordin_availability_request_shees){
            WordingAvailabilityRequestSheet::create([
                'availability_request_sheet_id' => $availability_request_sheet->id,
                'designation' => $wordin_availability_request_shees['designation'],
                'quantite' => $wordin_availability_request_shees['quantite'],
                'quantite_reliquat' => $wordin_availability_request_shees['quantite'],
                'motif' => $wordin_availability_request_shees['motif'],
                'beneficiaire' => $wordin_availability_request_shees['beneficiaire'],
                'date_debut_usage' => $wordin_availability_request_shees['date_debut_usage'],

            ]);
        }
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;
        $contenu = [
            'title' => 'Soumission DMD',
            'availability_request_sheet_id' => $availability_request_sheet->id,
            'availability_request_sheet' => $availability_request_sheet,
            'entie' => $entity_sigle
        ];

        // $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        // $controler_recipe = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
        //     ->whereRelation('privileges', 'role_id', '=', 8)->first();

            $controlleur = User::where('id', $this->controlleur)->first();

            Mail::to($controlleur->email)->send(new CreateAvailabilityRequestSheetMail($contenu));

        DB::commit();
        return redirect()->route('availability_request_sheet.index')->with('success', 'Fiche validée avec succès');

    }

}
