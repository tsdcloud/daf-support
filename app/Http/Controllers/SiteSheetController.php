<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $configuration_sites = Site::get();
        $current_entity_id = auth()->user()->current_entity()->entity_id;
        $configuration_sites = Site::where('entity_id', $current_entity_id)->get();
        // dd($configuration_sites);
        // dd($configuration_comptes);

        return view('config_site.index',compact('configuration_sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entites = Entity::get();
        $cities = Entity::find(auth()->user()->current_entity()->entity_id)->cities;
        // $cities = Entity::find($fonction->user_entity->entity_id)->cities;

       return view('config_site.create',compact('entites','cities'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $data =$request->validate([

            "entity_id" => 'required|numeric',
            "city_id" => 'required',
            "label" => 'required',
            // "code" => 'required',
        ], [
            "entity_id.required" => 'Précissez l\'entité du compte',
            "city_id.required" => 'précissez la ville',
            "label.required" => 'déterminez le titre du site',
            // "code.required" => 'précisez le code du site',
        ]);


        // 'localisation',
        if($request->localisation){
            $data['localisation'] = $request->localisation;
        }

        $data['user_id'] = auth()->user()->id;

        // dd($data);

        // $entity_id = $request->entity_id;
        // $city_entity_id = $request->city_entity_id;
        // $label = $request->label;
        // // $code = $request->code;
        // $localisation = $request->localisation;

        // dd($data);

        try{
            Site::create($data);
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
