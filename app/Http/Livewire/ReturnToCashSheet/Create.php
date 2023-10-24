<?php

namespace App\Http\Livewire\ReturnToCashSheet;

use App\Models\Entity;
use Livewire\Component;
use App\Models\Fonction;
use App\Models\CityEntity;
use App\Models\FicheRetourCaisse;
use Illuminate\Support\Facades\DB;
use App\Models\LibelleRetourCaisse;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateReturnToCashSheetMail;

class Create extends Component
{
    public function render()
    {
        return view('livewire.return-to-cash-sheet.create');
    }

    // Déclaration des variables d'entrée pour menue déroulant dans le formulaire
    public $cities;
    public $sites;
    public $users;
    public $fiche_depenses;

    // Déclaration des variables du libellé de retour caisse
    public $libelle;
    public $dossier;
    public $montant;

    // Déclaration des variables de stockage intermédiaire des libellés
    public $arrayData = [];
    public $arrayIndex = 0;

    public $city_entity_id;
    public $site_id;
    public $retourneur;
    public $numero_contribuable;
    public $num_dossier;

    public $filenames = [];

    // message de validation du tableau des libellés
    public $messages = [
        "libelle.required" => 'Ce champ est requis',
        "dossier.required" => 'Ce champ est requis',
        "montant.required" => 'Ce champ est requis',

        "libelle.string" => 'Ce champ doit etre une chaine de caractere',
        "montant.integer" => 'Ce champ doit etre un nombre',
        "dossier.string" => 'Ce champ doit etre une chaine de caractere',
    ];

    // fonction mount
    public function mount($cities,$sites, $users,$fiche_depenses){

        // $this->fonction = Fonction::find(session('fonction_id')['fonction_id']);
        // $this->cities = $this->fonction->user_entity->entity->cities;
        // $this->sites = null;

        // if(!empty($this->cities)){
        //     $city = $this->cities->first();
        //     $this->city_entity_id = $city->pivot->id;
        //     $this->sites = $city->sites;
        // }

        $this->cities = $cities;
        $this->sites = $sites;
        $this->users = $users;
        $this->fiche_depenses = $fiche_depenses;

        $this->reinitializeVariables();
    }

    public function hydrate(){
        // $fonction = Fonction::find(session('fonction_id')['fonction_id']);
        $this->cities = Entity::find($this->fonction->user_entity->entity_id)->cities;
    }

    // réinitialisation des variables à 0 après chaque ajout dansla variable temporaire
    public function reinitializeVariables(){
        $this->libelle = null;
        $this->dossier = null;
        $this->montant = null;
    }

    public function reverseRowData(){
        $this->arrayData = array_reverse($this->arrayData, true);
    }

    //  Rangement des données dans le tableau de réserve
    public function addRowData(){
        $this->validate([
            "libelle" => 'required|string',
            "dossier" => 'required|string',
            "montant" => 'required|numeric|min:0',
        ],[
            "libelle.required" => 'Ce champ est requis',
            "dossier.required" => 'le numéro de dossier est requis',
            "montant.required" => 'Ce champ est requis',

            "libelle.string" => 'Ce champ doit etre une chaine de caractere',
            "dossier.string" => 'Ce champ doit etre une chaine de caractere',
            "montant.numeric" => 'Ce champ doit etre un nombre',
        ]);


        $this->arrayData[] = [
            "libelle"=>$this->libelle,
            "dossier"=>$this->dossier,
            "montant"=>$this->montant,
        ];

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

        $this->libelle = $this->arrayData[$item]['libelle'];
        $this->dossier = $this->arrayData[$item]['dossier'];
        $this->montant = $this->arrayData[$item]['montant'];

        //on retire l'index $item du tableau
        unset($this->arrayData[$item]);

        // On reorganise les index du tableau
        array_values($this->arrayData);
        $this->reverseRowData();
        $this->arrayIndex --;
    }

    public function submitData(){
        $this->validate([

            "city_entity_id" => "required",
            "site_id" => "required",
            "retourneur" => "required",
            "montant"=> "required|numeric|min:0",
            "reliquat" => "required|numeric|min:0",
            'fiche_depense_id' => "required",

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
        ]);

        $data = [];

            if($this->retourneur){
                $data['retourneur'] = $this->retourneur;
            }

            if($this->fiche_depense_id){
                $data['fiche_depense_id'] = $this->fiche_depense_id;

                $data['montant'] = $this->fiche_depense->montant;
            }


            if($this->reliquat){
                $data['reliquat'] = $this->reliquat;
            }



        if($this->numero_contribuable){
            $data['numero_contribuable'] = $this->numero_contribuable;
        }

        if($this->num_dossier){
            $data['num_dossier'] = $this->num_dossier;
        }


        if($this->city_entity_id){
            $data['city_entity_id'] = $this->city_entity_id;
        }

        if($this->site_id){
            $data['site_id'] = $this->site_id;
        }

        $city_entity = CityEntity::find($data['city_entity_id']);
        $data['entity_id'] = $city_entity->entity_id;


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

        $fiche_retour_caisse = FicheRetourCaisse::create($data);

        $addMoreInput = $this->arrayData;

        // dd($addMoreInput);

        foreach($addMoreInput as $libelle_retour_caisses){
            LibelleRetourCaisse::create([
                'fiche_retour_caisse_id' => $fiche_retour_caisse->id,
                'libelle' => $libelle_retour_caisses['libelle'],
                'dossier' => $libelle_retour_caisses['dossier'],
                'montant' => $libelle_retour_caisses['montant'],
            ]);
        }

        $contenu = [
            'title' => 'Soumission fiche retour caisse',
            'fiche_retour_caisse_id' => $fiche_retour_caisse->id
        ];
        $retourneurs = $fiche_retour_caisse->retourneurs;


            Mail::to($retourneurs->email)->send(new CreateReturnToCashSheetMail($contenu));
        DB::commit();

        return redirect()->route('return_to_cash_sheet.index')->with('success', 'Fiche validée vec succès');

    }

}
