<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MaterialRealiseForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaterterialReleaseFormMail;
use App\Models\AvailabilityRequestSheet;
use Box\Spout\Common\Entity\Style\Color;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Mail\CreateMaterterialReleaseMail;
use App\Models\WordingAvailabilityRequestSheet;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

class MaterialReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $material_realise_forms = "";
        // $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'statut'=> 'en attente'])->get();

        if(auth()->user()->isAdmin() || auth()->user()->isComptable_matiere() ){
            $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'statut'=> 'en attente'])->get();
        }else{
            $material_realise_forms = MaterialRealiseForm::where(['beneficiaire' => auth()->user()->id,'entity_id'=> $current_entity_id,'statut'=> 'en attente'])->get();
        }

        $users = User::all();
        $departments = Department::all();

        return view('material_release_form.index', compact('material_realise_forms','users','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    public function create()
    {
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id])->get();
        $cnt_mrf = MaterialRealiseForm::where(['entity_id'=> $current_entity_id])->count();

        if($cnt_mrf == 0 ){

            $wording_availability_request_sheets = WordingAvailabilityRequestSheet::get();
            foreach($wording_availability_request_sheets as $wording_availability_request_sheet){

                $wording_availability_request_sheet->quantite_reliquat=$wording_availability_request_sheet->quantite;
                $wording_availability_request_sheet->save();
            }

        }

        $wording_availability_request_sheets = WordingAvailabilityRequestSheet::whereRelation('label','statut','=','réçu')
                                                                                ->where('quantite_reliquat','>',0 )
                                                                                ->whereRelation('label','entity_id','=',$current_entity_id )->get();
        $users = User::all();


        return view('material_release_form.create', compact('wording_availability_request_sheets','users','material_realise_forms'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    public function archive()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $material_realise_forms = "";
        $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'statut'=> 'reçu'])->get();

        $users = User::all();

        return view('material_release_form.archive', compact('material_realise_forms','users'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*configuration des messqges d'erreu*/
        $data = $request->validate([
            "max" => 'required',
            "wordinavailability_request_sheet_id" => 'required|numeric',
            "quantite" => 'required|numeric|min:0',
        ], [
            "max.required" => 'Le service demandeur est a choisir',
            "wordinavailability_request_sheet_id.required" => 'Le service demandeur est a choisir',
            "wordinavailability_request_sheet_id.numeric" => 'Le service demandeur est a choisir',
            "quantite.required" => 'Saisissez la quantité',
            "quantite.numeric" => 'La quantité est numérique',
        ]);
        $wording_availability_request_sheet = WordingAvailabilityRequestSheet::find($request->wordinavailability_request_sheet_id);

        $availability_request_sheet = AvailabilityRequestSheet::find($wording_availability_request_sheet->availability_request_sheet_id);
        $material_realise_form = MaterialRealiseForm::where(['wordinavailability_request_sheet_id'=> $wording_availability_request_sheet->id,
                                                                'availability_request_sheet_id'=> $wording_availability_request_sheet->availability_request_sheet_id,
                                                                'beneficiaire'=> $wording_availability_request_sheet->beneficiaire,
                                                                'designation'=> $wording_availability_request_sheet->designation,
                                                                ])->latest()->first();

        $last_bsm_qnt_sorted = MaterialRealiseForm::where(['wordinavailability_request_sheet_id'=> $wording_availability_request_sheet->id,
                                                                'availability_request_sheet_id'=> $wording_availability_request_sheet->availability_request_sheet_id,
                                                                'beneficiaire'=> $wording_availability_request_sheet->beneficiaire,
                                                                'designation'=> $wording_availability_request_sheet->designation,
                                                                ])->count();



        if($last_bsm_qnt_sorted!= 0 ){

            $data['quantite_reliquat'] = $wording_availability_request_sheet->quantite_reliquat - $request->quantite;
            $wording_availability_request_sheet->quantite_reliquat = $wording_availability_request_sheet->quantite_reliquat - $request->quantite;
            $wording_availability_request_sheet->save();
        }
        else{
            $data['quantite_reliquat'] = $wording_availability_request_sheet->quantite_reliquat - $request->quantite;
            $wording_availability_request_sheet->quantite_reliquat = $wording_availability_request_sheet->quantite_reliquat - $request->quantite;
            $wording_availability_request_sheet->save();
        }


        $data['comptable_matiere'] = auth()->user()->id;
        $data['availability_request_sheet_id'] = $wording_availability_request_sheet->availability_request_sheet_id;
        $data['wordinavailability_request_sheet_id'] = $wording_availability_request_sheet->id;
        $data['designation'] = $wording_availability_request_sheet->designation;
        $data['motif'] = $wording_availability_request_sheet->motif;
        $data['beneficiaire'] = $wording_availability_request_sheet->beneficiaire;
        $data['chef_depart'] = $availability_request_sheet->chef_depart;
        $data['date_debut_usage'] = $wording_availability_request_sheet->date_debut_usage;
        $data['service_demandeur'] = $availability_request_sheet->service_demandeur;
        $data['quantite_compta_mat'] = $request->quantite;
        $data['entity_id'] = $availability_request_sheet->entity_id;
        $data['city_entity_id'] = $availability_request_sheet->city_entity_id;
        $data['site_id'] = $availability_request_sheet->site_id;

        // Récupérer l'année actuelle
        $anneeActuelle = Carbon::now()->year;
        $annee_init = 2023;
        $annee_offset = 559;
        // Vérifiez si la table est vide
        if (MaterialRealiseForm::count() == 0) {
            $compteur = 0;
            $exercice = $annee_init;
        } else {
            $material_realise_form = MaterialRealiseForm::latest()->first();
            $compteur  = $material_realise_form->compteur;
            $exercice = $material_realise_form->exercice;
        }

        // Comparer les deux nombres
        if ($anneeActuelle > $exercice) {
            // L'année actuelle est supérieure au nombre comparé
            $compteur = 1;
            $exercice = $anneeActuelle;
            $data['exercice'] = $anneeActuelle;
            $numero_bon_sortie = strval(Carbon::now()->day).'/'.strval(Carbon::now()->month).'/'.strval(str_pad($compteur, 4, '0', STR_PAD_LEFT)).'/'.strval(Carbon::now()->year);

        } else {
            // L'année actuelle est inférieure ou égale au nombre comparé
            if ($anneeActuelle == $annee_init) {
                // L'année actuelle est supérieure au nombre comparé
                $compteur = $compteur+1;
                $numero_bon_sortie = strval(Carbon::now()->day).'/'.strval(Carbon::now()->month).'/'.strval(str_pad(($compteur+$annee_offset) , 4, '0', STR_PAD_LEFT)).'/'.strval(Carbon::now()->year);
            } else {
                // L'année actuelle est inférieure ou égale au nombre comparé
                $compteur = $compteur +1;
                $numero_bon_sortie = strval(Carbon::now()->day).'/'.strval(Carbon::now()->month).'/'.strval(str_pad($compteur , 4, '0', STR_PAD_LEFT)).'/'.strval(Carbon::now()->year);
            }
        }
        $data['exercice'] = $anneeActuelle;
        $data['compteur'] = $compteur;
        $data['date_sortie'] =  strval(Carbon::now()->format('d-m-y H:i:s'));
        $data['numero_bon_sortie'] = $numero_bon_sortie;
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        DB::beginTransaction();
            $material_realise_form=MaterialRealiseForm::create($data);

            $contenu = [
                'title' => 'Création de bon de sorti',
                'material_realise_form_id' => $material_realise_form->id,
                'entie' => $entity_sigle
            ];

            $demandeur_id = User::where('id', $data['beneficiaire'])->first();


            // dd($demandeur_id->email);
            Mail::to($demandeur_id->email)->send(new CreateMaterterialReleaseMail($contenu));
        DB::commit();

        return back()->with('success','Bon de sortie matériel crée avec succès');
    }
    /**
     * Exportation a newly created resource in xls,csv.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportation_list_bsm_archive(Request $request)
    {
        // dump($request->all());
        $data = $request->validate([
            'date_debut' => 'required',
            'extension' => 'required',
            // 'date_fin' => 'after_or_equal:date_debut'
        ]);
        // dd(auth()->user()->id);
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $material_realise_forms = "";
        $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'comptable_matiere'=> auth()->user()->id,'statut'=>'reçu'])
        ->whereBetween('created_at', [$data['date_debut'],now()])->get();

        $nb_bsn = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'comptable_matiere'=> auth()->user()->id,'statut'=>'reçu'])
        ->whereBetween('created_at', [$data['date_debut'],now()])->count();
        // dump($nb_bsn);
        // dump($nb_bsn != 0);

        if($nb_bsn != 0){
            if($request->date_fin){
                $request->validate([
                    'date_fin' => 'after_or_equal:date_debut'
                ]);

                $data['date_fin'] = $request->date_fin;
                $material_realise_forms = MaterialRealiseForm::where(['entity_id'=> $current_entity_id,'comptable_matiere'=> auth()->user()->id,'statut'=>'reçu'])
                                                                ->whereBetween('created_at', [$data['date_debut'],$data['date_fin']])->get();

                // $demande_explications = DemandeExplication::whereBetween('created_at', [$data['date_debut'],$data['date_fin']])->get();
            }

            $line[] = [];
            $k = 0;
            foreach($material_realise_forms as $material_realise_form){
                $line[$k]['bon de sortie'] = $material_realise_form->id;
                $line[$k]['Date de sortie'] = $material_realise_form->date_sortie;
                $line[$k]['Initiateur'] = User::find($material_realise_form->comptable_matiere)->lname . ' ' . User::find($material_realise_form->comptable_matiere)->fname.' ' . User::find($material_realise_form->comptable_matiere)->email;
                $line[$k]['Bénéficiaire'] = User::find($material_realise_form->beneficiaire)->lname . ' ' . User::find($material_realise_form->beneficiaire)->fname.' ' . User::find($material_realise_form->beneficiaire)->email;
                $line[$k]['Désignation'] = $material_realise_form->designation;
                $line[$k]['Qte sortie'] = $material_realise_form->quantite_compta_mat;
                $line[$k]['N° DMD'] = $material_realise_form->availability_request_sheet_id;
                $line[$k]['Statut'] = $material_realise_form->statut;

                $k++;
            }
            // dd($line);

            $nom_entity= Entity::find($current_entity_id)->sigle;
            $nom_compta=User::find($material_realise_form->comptable_matiere)->lname;
            // 2. Le nom du fichier avec l'extension : .xlsx ou .csv
            $file_name = "Export_bon_sortie_matériel"."_".$nom_entity."_".$nom_compta."_". $request->name.".".$request->extension;

            // 4. $writer : Objet Spatie\SimpleExcel\SimpleExcelWriter
            $writer = SimpleExcelWriter::streamDownload($file_name)->addRows($line)->toBrowser();

            // 5. On insère toutes les lignes au fichier Excel $file_name
            // $writer->addRows($line);
            // 6. Lancer le téléchargement du fichier
            // $writer->toBrowser();
            return redirect()->route('material_release_form.archive')->with('success', 'Exportation réusite');
        }


        return redirect()->route('material_release_form.archive')->with('Acun bon de sortie n\'été trouvée dans cette Entité');
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
        $material_realise_form = MaterialRealiseForm::find($id);
        $availability_request_sheet = AvailabilityRequestSheet::find($material_realise_form->dmd_id);
        $comptable_matiere = User::find($material_realise_form->comptable_matiere);
        return view('material_release_form.show', compact('material_realise_form','availability_request_sheet','comptable_matiere'));
    }

    /**
     * Exportation a newly created resource in xls,csv.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function material_release_form_validation(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            "bsm_id" => "required",
            // "quantite" => "required|numeric",
        ], [
            "bsm_id.required" => 'Le service demandeur est a choisir',
            // "quantite.required" => 'Saisissez la quantité',
            // "quantite.numeric" => 'La quantité est numérique',
        ]);

        // validation bénéficiaire

        $material_realise_form = MaterialRealiseForm::find($request->bsm_id);

        $material_realise_form->date_sortie = strval(Carbon::now()->format('d-m-y H:i:s'));
        $material_realise_form->statut = 'reçu';

        $material_realise_form->update();
        $material_realise_form->save();

        $beneficiaire = User::find($material_realise_form->beneficiaire);

        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $entity_c = Entity::where(['id'=> $current_entity_id])->first();
        $entity_sigle = $entity_c->sigle;

        $mailData = [
            'material_realise_form' => $material_realise_form,
            'user' => $beneficiaire,
            'entie' => $entity_sigle
        ];
        // dd($mailData);

        $chef_depart = User::find($material_realise_form->chef_depart);

        Mail::to($chef_depart->email)->send(new MaterterialReleaseFormMail($mailData));

        return back()->with('success', 'Retait effectuée avec succès');
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
