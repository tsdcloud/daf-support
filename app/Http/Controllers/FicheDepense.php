<?php

namespace App\Http\Controllers;

use SweetAlert;
use App\Models\User;
use App\Models\Fonction;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\facades\DB;
use App\Mail\FicheDepenseOrderMail;

use App\Mail\FicheDepenseRejetMail;
use App\Models\FicheDepense as ModelsFicheDepense;
use Illuminate\Support\Facades\Mail;


class FicheDepense extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        /*configuration des messqges d'erreu*/
         $request->validate([

            "beneficiaire" => 'required|numeric',
            "montant" => 'required|numeric',
            "mode_paiment" => 'required',
            "controlleur" => 'required|numeric',
            "ordonateur" => 'required|numeric',
            "description" => 'required',
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
        ]);

        $beneficiaire = !is_null($request->beneficiaire) ? $request->beneficiaire : '';
        $montant = !is_null($request->montant) && is_numeric($request->montant) ?
            number_format($request->montant) : null;
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

        $fiche_depense = ModelsFicheDepense::create([
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
        ]);

        $contenu = [
            'title' => 'Soumission fiche depense',
            'fiche_depense_id' => $fiche_depense->id

        ];
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;

        $user_controllers = User::whereRelation('user_entity', 'entity_id', '=', $current_entity_id)
            ->whereRelation('privileges', 'role_id', '=', 4)->get();

        foreach($user_controllers as $user){
            Mail::to($user->email)->send(new ContactMail($contenu));
        }

        return redirect()->route('ConsultFD')->with('message', 'Fiche de dépense créée avec succès');
    }

    public function rejet_conf_fiche_depense(Request $request, ModelsFicheDepense $fiche_depense)
    {
        
        $data = $request->validate([
            'controleur_conf_rejet.*' => 'required'
        ]);

        // dd($data['controleur_conf_rejet']);
        $fiche_depense->controleur_conf_rejet = implode(",", $data['controleur_conf_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
        ];
        Mail::to($demandeur->email)->send(new FicheDepenseRejetMail($mailData));

        return back()->with('success', 'Fiche de dépense rejétée');
    }
    public function rejet_budj_fiche_depense(Request $request, ModelsFicheDepense $fiche_depense)
    {

        $data = $request->validate([
            'controleur_rejet.*' => 'required'
        ]);

        $fiche_depense->controleur_rejet = implode(",", $data['controleur_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
        ];
        Mail::to($demandeur->email)->send(new FicheDepenseRejetMail($mailData));

        return back()->with('success', 'Fiche de dépense rejétée');
    }

    public function rejet_ordonateur_fiche_depense(Request $request, ModelsFicheDepense $fiche_depense)
    {

        $data = $request->validate([
            'ordonateur_rejet.*' => 'required'
        ]);

        $fiche_depense->ordonateur_rejet = implode(",", $data['ordonateur_rejet']);
        $fiche_depense->save();

        $demandeur = $fiche_depense->user;

        $mailData = [
            'fiche_depense' => $fiche_depense,
            'user' => $demandeur,
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
        $fiche_depense = ModelsFicheDepense::find($request->fiche_depense_id);

        if ($request->fonction == 'ordonateur') {
            $fiche_depense->statut = 'validée';

            $ordonateur = $fiche_depense->ordonateurs;
            $beneficiaires = $fiche_depense->beneficiaires;
            $caisse = User::whereRelation('privileges', 'role_id', '=', 6)->first();

            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'l\'ordonateur',
                'user' => $ordonateur,
            ];
            Mail::to($beneficiaires->email)->send(new FicheDepenseOrderMail($mailData));
            Mail::to($caisse->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'controlleur') {
            $fiche_depense->statut = 'en cours';

            $controlleur = $fiche_depense->controlleurs;
            $ordonateur = $fiche_depense->ordonateurs;

            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le controleur budgétaire',
                'user' => $controlleur,
            ];
            Mail::to($ordonateur->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'controlleur_conf') {
            $fiche_depense->statut = 'en cours_conf';

            $controlleur_confs = User::find(auth()->user()->id);
            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le controleur conformité',
                'user' => $controlleur_confs,
            ];

            $controlleur = $fiche_depense->controlleurs;

            Mail::to($controlleur->email)->send(new FicheDepenseOrderMail($mailData));
        }

        if ($request->fonction == 'beneficiaire') {
            $fiche_depense->statut = 'décaissé';

            $beneficiaires = $fiche_depense->beneficiaires;
            $comptable = User::whereRelation('privileges', 'role_id', '=', 1)->first();

            $mailData = [
                'fiche_depense' => $fiche_depense,
                'fonction' => 'le bénéficiaire',
                'user' => $comptable,
            ];
            Mail::to($comptable->email)->send(new FicheDepenseOrderMail($mailData));
        }

        $fiche_depense->update();

        return back()->with('success', 'Signature effectuée avec succès');
    }

    public function add_num_comptable(Request $request, ModelsFicheDepense $fiche_depense)
    {

        $data = $request->validate([
            "num_comptable" => 'required'
        ]);

        $fiche_depense->num_comptable =  $data['num_comptable'];
        $fiche_depense->save();

        return back()->with('success', 'Numero comptable ajouter avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
