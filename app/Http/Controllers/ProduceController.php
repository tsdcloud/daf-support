<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Produce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $configuration_produits = Produce::where('entity_id', $current_entity_id)->get();


        return view('produce_configuration.index',compact('configuration_produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entites = Entity::get();
        return view('produce_configuration.create',compact('entites'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =$request->validate([

            "entity_id" => 'required|numeric',
            "prix_unitaire" => 'required|numeric',
            "label" => 'required',
            // "code" => 'required',
        ], [
            "entity_id.required" => 'Précissez l\'entité du produit',
            "entity_id.numeric" => 'choisissez l\'entité du produit',
            "prix_unitaire.required" => 'Déterminez le prix  unitaire',
            "prix_unitaire.numeric" => 'Le prix unitaire est numérique',
            "label.required" => 'déterminez le titre du site',
        ]);

        if($request->localisation){
            $data['contionnement'] = $request->contionnement;
        }

        if($request->localisation){
            $data['description'] = $request->description;
        }


        try{
            Produce::create($data);
            // return redirect()->route('return_to_cash_sheet.index')->with('success','Configuration reussie');
            return back()->with('success','Configuration reussie');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Une erreur s\'est produite. Veuillez reprendre ou contactez votre administrateur');
        }

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
