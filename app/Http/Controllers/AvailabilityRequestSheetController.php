<?php

namespace App\Http\Controllers;

use App\Mail\AvailabilityRequestSheetMail;
use App\Mail\AvailabilityRequestSheetRejetMail;
use App\Models\Site;
use App\Models\User;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\CityEntity;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ConfigurationCompte;
use Illuminate\Support\Facades\Mail;
use App\Models\AvailabilityRequestSheet;
use App\Models\WordingAvailabilityRequestSheet;
use App\Mail\CreateAvailabilityRequestSheetMail;
use App\Models\AttachementAvailabilityRequestSheet;

class AvailabilityRequestSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $availability_request_sheets = "";
        if(auth()->user()->isAdmin() || auth()->user()->isCoordonnateur() || auth()->user()->isChef_depart() || auth()->user()->isComptable_matiere() || auth()->user()->isCaissier()){
            $availability_request_sheets = AvailabilityRequestSheet::where('entity_id', $current_entity_id)->get();
        }else{
            $availability_request_sheets = AvailabilityRequestSheet::where('entity_id', $current_entity_id)->where('user_id',auth()->user()->id)->get();
        }
        // dd($recipe_sheets);
        return view('availability_request_sheet.index', compact('availability_request_sheets'));

    }
    // DMD de la journée
    public function controllable()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $availability_request_sheets = "";
        if(auth()->user()->isAdmin() || auth()->user()->isCoordonnateur()){

            $availability_request_sheets = AvailabilityRequestSheet::where([
                'chef_depart_rejet' => null,
                'controleur_rejet' => null,
                'statut' => 'en attente',
                'controlleur' => auth()->user()->id
            ])->get();
        }
        return view('availability_request_sheet.index', compact('availability_request_sheets'));
    }
    // DMD Ordonnançable
    public function ordonnable()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $availability_request_sheets = "";
        if(auth()->user()->isAdmin() || auth()->user()->isChef_depart()){

            $availability_request_sheets = AvailabilityRequestSheet::where([
                'chef_depart_rejet' => null,
                'controleur_rejet' => null,
                'statut' => 'validée par contrôler',
                'chef_depart' => auth()->user()->id
            ])->get();
            // $availability_request_sheets = AvailabilityRequestSheet::where('entity_id', $current_entity_id)
            //                                 ->whereDate('statut', 'validée par contrôler')
            //                                 ->get();
        }
        return view('availability_request_sheet.index', compact('availability_request_sheets'));
    }
    // DMD de la journée
    public function comptabilisable()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $availability_request_sheets = "";
        if(auth()->user()->isAdmin() || auth()->user()->isCoordonnateur() || auth()->user()->isChef_depart() || auth()->user()->isComptable_matiere() || auth()->user()->isCaissier()){

            $availability_request_sheets = AvailabilityRequestSheet::where([
                'chef_depart_rejet' => null,
                'controleur_rejet' => null,
                'statut' => 'validée par ordonnateur',
                // auth()->user()->isComptable_matiere()
            ])->get();
            // $availability_request_sheets = AvailabilityRequestSheet::where('entity_id', $current_entity_id)
            //                                 ->whereDate('statut', 'validée par ordonnateur')
            //                                 ->get();
        }
        return view('availability_request_sheet.index', compact('availability_request_sheets'));
    }

    public function rejected()
    {
        $availability_request_sheets = AvailabilityRequestSheet::where('controleur_rejet', '!=', null)
            ->orWhere(function ($query) {
                $query->where('chef_depart_rejet', '!=', null);
            })->get();
        return view('availability_request_sheet.rejected', compact('availability_request_sheets'));
    }

    public function archived()
    {
        $availability_request_sheets = AvailabilityRequestSheet::where('statut', '=', 'réçu')->get();
        return view('availability_request_sheet.archived', compact('availability_request_sheets'));
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
        $controllers = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 9)->get();
        $chef_departs = User::whereRelation('user_entity', 'entity_id', '=', $fonction->user_entity->entity_id)->whereRelation('privileges', 'role_id', '=', 7)->get();
        $cities = Entity::find(auth()->user()->current_entity()->entity_id)->cities;
        // $service_demandeurs = Department::all();
        // $cities = Entity::find($fonction->user_entity->entity_id)->cities;
        // $service_demandeurs = Department::find(auth()->user()->current_entity()->entity_id)->title;
        $service_demandeurs = Department::find(Fonction::find(auth()->user()->current_user_entity()->id)->department_id)->title;
        // dd($service_demandeurs);

        $sites = Site::all();

        return view('availability_request_sheet.create', compact(
            'users',
            'cities',
            'sites',
            'service_demandeurs',
            'controllers',
            'chef_departs',
            'fonction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        /*configuration des messqges d'erreu*/
        $data = $request->validate([
            "service_demandeur" => 'required|numeric',
            "chef_depart" => 'required|numeric',
            "controlleur" => 'required|numeric',
            "produit" => 'required',
            "city_entity_id" => 'required',
            "site_id"=> 'required',

            "addMoreInput.*.designation" => "required",
            "addMoreInput.*.quantite" => "required|numeric|min:0",
            "addMoreInput.*.motif" => "required",
            "addMoreInput.*.beneficiaire" => "required|numeric",
            "addMoreInput.*.date_debut_usage" => "required",
        ], [
            "service_demandeur.required" => 'Le service demandeur est a choisir',
            "service_demandeur.numeric" => 'Le service demandeur est a choisir',
            "chef_depart.required" => 'Le chef de departement est a choisir',
            "chef_depart.numeric" => 'Le chef de departement est a choisir',
            "controlleur.required" => 'Le controleur est a choisir',
            "controlleur.numeric" => 'Le controleur est a choisir',
            "produit.required" => 'Vous devez selectionner un type de produit',
            "city_entity_id.required" => 'Vous devez selectionner une ville',
            "site_id.required"=> 'Vous devez selectionner un site',

            "addMoreInput.*.designation.required" => 'La designation est à renseigner',
            "addMoreInput.*.quantite.required" => 'La quantite est à renseigner',
            "addMoreInput.*.quantite.numeric" => 'La quantite doit être un nombre',
            "addMoreInput.*.quantite.min" => 'La quantite doit être positif',
            "addMoreInput.*.motif.required" => 'Le motif est à renseigner',
            "addMoreInput.*.beneficiaire.required" => 'Le service beneficiaire est a choisir',
            "addMoreInput.*.beneficiaire.numeric" => 'Le service beneficiaire est a choisir',
            "addMoreInput.*.date_debut_usage.required" => 'La date de début d\'usaga est a choisire',
        ]);

        // if($request->city_entity_id){
        //     $data['city_entity_id'] = $request->city_entity_id;
        // }

        if($request->site_id){
            $data['site_id'] = $request->site_id;
        }
        $city_entity = CityEntity::find($data['city_entity_id']);

        if($request->num_dossier){
            $data['num_dossier'] = $request->num_dossier;
        }
        $data['user_id'] = auth()->user()->id;
        $data['entity_id'] = $city_entity->entity_id;

        // dump($request->all());
        //         dd($data);

        DB::beginTransaction();

        $availability_request_sheet = AvailabilityRequestSheet::create($data);
        // dd($availability_request_sheet->id);
        $addMoreInput = $request->addMoreInput;
        foreach($addMoreInput as $wording_availability_request_sheet){
            WordingAvailabilityRequestSheet::create([
                'availability_request_sheet_id' => $availability_request_sheet->id,
                'designation' => $wording_availability_request_sheet['designation'],
                'quantite' => $wording_availability_request_sheet['quantite'],
                'quantite_reliquat' => $wording_availability_request_sheet['quantite'],
                'motif' => $wording_availability_request_sheet['motif'],
                'beneficiaire' => $wording_availability_request_sheet['beneficiaire'],
                'date_debut_usage' => $wording_availability_request_sheet['date_debut_usage'],

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
                AttachementAvailabilityRequestSheet::create([
                    'availability_request_sheet_id' => $availability_request_sheet->id,
                    'filename' => $file->store('images', 'public'),
                ]);
            }
        }


        $contenu = [
            'title' => 'Soumission d\'une DMD',
            'availability_request_sheet_id' => $availability_request_sheet->id
        ];

        $chef_departs = $availability_request_sheet->chef_departs;


        Mail::to($chef_departs->email)->send(new CreateAvailabilityRequestSheetMail($contenu));

        DB::commit();

        return redirect()->route('availability_request_sheet.index')->with('success', 'Fiche validée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $current_entity = auth()->user()->current_entity();
        $availability_request_sheet = AvailabilityRequestSheet::find($id);
        $comptes = ConfigurationCompte::where('entity_id',$current_entity->entity_id)->get();
        // dump($availability_request_sheet);
        // dd($comptes);
        return view('availability_request_sheet.show', compact('availability_request_sheet', 'comptes'));
    }

    public function availability_request_validation(Request $request, AvailabilityRequestSheet $availability_request_sheet)
    {
        $data = $request->validate([
            "fonction" => "required",
        ],[
            "fonction.required" => 'vous devez vous reconnecter',
        ]);
        $data['availability_request_sheet_id'] = $availability_request_sheet->id;

        // validation controlleur / coordonnateur
        if ($request->fonction == 'controlleur') {


            $availability_request_sheet->statut = 'validée par contrôler';
            $availability_request_sheet->controleur_observation = $request->controleur_observation;
            $controlleur = User::where('id', $availability_request_sheet->controlleur)->first();
            // $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;

            $chef_depart = User::where('id', $availability_request_sheet->chef_depart)->first();

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $entity_c = Entity::where(['id'=> $current_entity_id])->first();
            $entity_sigle = $entity_c->sigle;

            $mailData = [
                'availability_request_sheet' => $availability_request_sheet,
                'fonction' => 'le contrôleur',
                'user' => $controlleur,
                'entie' => $entity_sigle
            ];

            Mail::to($chef_depart->email)->send(new AvailabilityRequestSheetMail($mailData));

        }

        // Validation chef_depart/Ordonnateur
        if ($request->fonction == 'chef_depart') {

            $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
            $comptable_matier = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 11)->first();
            // $availability_request_sheet->comptable_matier = $comptable_matier;

            $chef_depart = User::where('id', $availability_request_sheet->chef_depart)->first();
            $availability_request_sheet->chef_depart_observation = $request->chef_depart_observation;
            $availability_request_sheet->statut = 'validée par ordonnateur';
            $availability_request_sheet->dg_rejet = $request->dg_rejet;
            // dd($request->dg_rejet);
            if($request->dg_rejet == '')
                $availability_request_sheet->dg_rejet = 'normale';

                $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
                $entity_c = Entity::where(['id'=> $current_entity_id])->first();
                $entity_sigle = $entity_c->sigle;

            $mailData = [
                'availability_request_sheet' => $availability_request_sheet,
                'fonction' => 'l\'Ordonnateur',
                'user' => $chef_depart,
                'entie' => $entity_sigle
            ];


            Mail::to($comptable_matier->email)->send(new AvailabilityRequestSheetMail($mailData));
        }

        // Validation comptable matière
        if ($request->fonction == 'comptable_matier') {

            $availability_request_sheet->statut = 'réçu';
            $availability_request_sheet->comptable_matier = auth()->user()->id;
            // dd($availability_request_sheet->comptable_matier);
            // $comptable_matier = auth()->user()->id;
            // $comptable_matier = User::find(auth()->user()->id);
            // $availability_request_sheet->comptable_matier_observation = $request->comptable_matier_observation;

            // $comptable_matier = User::where('id', $availability_request_sheet->comptable_matier)->first();
            // $user_id = User::where('id', $availability_request_sheet->user_id)->first();


            // $mailData = [
            //     'availability_request_sheet' => $availability_request_sheet,
            //     'fonction' => 'le comptable matière',
            //     'user' => $comptable_matier,
            // ];

            // Mail::to($user_id->email)->send(new AvailabilityRequestSheetMail($mailData));
        }

        // Validation reception
        if ($request->fonction == 'initiateur') {

            $availability_request_sheet->statut = 'réçu';
            // $availability_request_sheet->user_observation = $request->user_observation;

            // $comptable_matier = User::where('id', $availability_request_sheet->comptable_matier)->first();
            // $user_id = User::where('id', $availability_request_sheet->user_id)->first();


            // $availability_request_sheet->statut = 'validée par contrôleur';

            // $mailData = [
            //     'availability_request_sheet' => $availability_request_sheet,
            //     'fonction' => 'le comptable matière',
            //     'user' => $comptable_matier,
            // ];

            // Mail::to($user_id->email)->send(new AvailabilityRequestSheetMail($mailData));
        }



        $availability_request_sheet->update();

        return back()->with('success', 'Signature effectuée avec succès');
    }


    // Rejet cheh de département/ordonnateur
    public function chef_depart_rejet_availability_request(Request $request, AvailabilityRequestSheet $availability_request_sheet)
    {
        $data = $request->validate([
            'chef_depart_rejet.*' => 'required'
        ]);

        $availability_request_sheet->chef_depart_rejet = implode(",", $data['chef_depart_rejet']);
        $availability_request_sheet->save();

        $demandeur = $availability_request_sheet->user;

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'availability_request_sheet' => $availability_request_sheet,
            'user' => $demandeur,
            'entie' => $entity_sigle
        ];

        Mail::to($demandeur->email)->send(new AvailabilityRequestSheetRejetMail($mailData));

        return back()->with('success', 'DMD rejétée');
    }

    // Rejet contoller
    public function controleur_rejet_availability_request(Request $request, AvailabilityRequestSheet $availability_request_sheet)
    {

        $data = $request->validate([
            'controleur_rejet.*' => 'required'
        ]);

        $availability_request_sheet->controleur_rejet = implode(",", $data['controleur_rejet']);
        $availability_request_sheet->save();

        $demandeur = $availability_request_sheet->user;

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'availability_request_sheet' => $availability_request_sheet,
            'user' => $demandeur,
            'entie' => $entity_sigle
        ];
        // dd($mailData['availability_request_sheet']);
        Mail::to($demandeur->email)->send(new AvailabilityRequestSheetRejetMail($mailData));

        return back()->with('success', 'DMD rejétée');
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
