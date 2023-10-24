<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ConfigurationCompte;

class BookKeeperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $configuration_comptes = ConfigurationCompte::get();
        // dd($configuration_comptes);

        return view('book_keeper.index',compact('configuration_comptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entites = Entity::get();
       return view('book_keeper.create',compact('entites'));
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

        $request->validate([

            "entity_id" => 'required|numeric',
            "banque" => 'required',
            "intitule" => 'required',
            "numero_compte" => 'required',
        ], [
            "entity_id.required" => 'Précissez l\'entité du compte',
            "banque.required" => 'précissez la banque',
            "intitule.required" => 'déterminez l\'intitulé de compte',
            "numero_compte.required" => 'la référence du compte est à déterminer',
        ]);

        // $entity_id = !is_null($request->entity_id) ? $request->entity_id : '';
        // $banque = !is_null($request->banque) ? $request->banque : '';
        // $Intitule = !is_null($request->Intitule) ? $request->Intitule : '';
        // $numero_compte = !is_null($request->numero_compte) ? $request->numero_compte : '';

        $entity_id = $request->entity_id;
        $banque = $request->banque;
        $intitule = $request->intitule;
        $numero_compte = $request->numero_compte;

        try{
            ConfigurationCompte::create([
                'entity_id' =>  $entity_id,
                'banque' =>      $banque,
                'intitule' => $intitule,
                'numero_compte' => $numero_compte,
            ]);
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
        // $users = User::all();
        // $fiche_depenses = ConfigurationCompte::where('num_comptable', '!=', null)->get();
        // return view('book_keeper.index', compact('entites'));
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
