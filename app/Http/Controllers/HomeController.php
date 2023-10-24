<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use App\Models\RecipeSheet;
use App\Models\FicheDepense;

use Illuminate\Http\Request;
use App\Models\FicheRetourCaisse;
use App\Models\MaterialRealiseForm;
use App\Models\AvailabilityRequestSheet;
use App\Models\FicheApprovisionnementCaisse;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $nb_fd = FicheDepense::where(['entity_id'=> $current_entity_id])->count();;
        $nb_fac = FicheApprovisionnementCaisse::where(['entity_id'=> $current_entity_id])->count();;
        $nb_frc = FicheRetourCaisse::where(['entity_id'=> $current_entity_id])->count();;

        $nb_fr = RecipeSheet::where(['entity_id'=> $current_entity_id])->count();;
        $nb_dmd = AvailabilityRequestSheet::where(['entity_id'=> $current_entity_id])->count();;

        $nb_bsm = MaterialRealiseForm::where(['entity_id'=> $current_entity_id])->count();;

        // $total_m_fd = FicheDepense::where('id',$id)->sum('quantity');
        // $total_m_fd = FicheDepense::where('id',$id)->sum('montant');
        // dd($total_m_fd);

        return view('dashboard.dashboard', compact('nb_fd','nb_fac','nb_frc','nb_fr', 'nb_dmd','nb_bsm' ));
    }

    public function dashboard(){
        $current_entity_id = Fonction::find(session('fonction_id')['fonction_id'])->user_entity->entity_id;
        $nb_fd = FicheDepense::where(['entity_id'=> $current_entity_id])->count();;
        $nb_fac = FicheApprovisionnementCaisse::where(['entity_id'=> $current_entity_id])->count();;
        $nb_frc = FicheRetourCaisse::where(['entity_id'=> $current_entity_id])->count();;

        $nb_fr = RecipeSheet::where(['entity_id'=> $current_entity_id])->count();;
        $nb_dmd = AvailabilityRequestSheet::where(['entity_id'=> $current_entity_id])->count();;
        $nb_bsm = MaterialRealiseForm::where(['entity_id'=> $current_entity_id])->count();;
        // dd($nb_bsm);

        // $total_m_fd = FicheDepense::where('id',$id)->sum('quantity');
        // $total_m_fd = FicheDepense::where('id',$id)->sum('montant');
        // dd($total_m_fd);

        return view('dashboard.dashboard', compact('nb_fd',
        'nb_fac',
        'nb_frc',
        'nb_fr',
         'nb_dmd',
         'nb_bsm',));
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
        //
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
