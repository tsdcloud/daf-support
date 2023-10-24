<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityEntity;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuration_entities = Entity::get();
        $cities = City::get();
        // dd($cities);

        return view('entity.index',compact('configuration_entities','cities'));
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
        $data = $request->validate([
            "title" => "required|string",
            "sigle" => "required|string",
            "logo" => "required|string",
            "city" => "required|",
        ],
        [
            "title.required" => 'Précissez le nom de l\'entité',
            "sigle.required" => 'Précissez le sigle de l\'entité',
            "logo.required" => 'Choisissez de l\'entité',
            "city.required" => 'Choisissez au moins un site pour l\'entité',
        ]);

        $title = $request->title;
        $sigle = $request->sigle;
        $logo = $request->logo;
        $cities = $request->city;

        // dump($request);

            Entity::create([
                'title' => $title,
                'sigle' => $sigle,
                'logo' => $logo,
            ]);

            $entity_id = Entity::where([
                'title' => $title,
            ])->first()->id;

            // dump($entity_id);

            foreach($cities as $city){
                CityEntity::create([
                    'entity_id' => $entity_id,
                    'city_id' => $city,
                ]);
            }

            // dd('ok');

        return back()->with('success', 'utilisateur ajouté avec succès');

        // try{
        //     Entity::create([
        //         'title' => $title,
        //         'sigle' => $sigle,
        //         'logo' => $logo,
        //     ]);
        //     $entity_id = Entity::where([
        //         'title' => $title,
        //     ])->get();
        //     dd($entity_id);
        //     foreach($cities as $city){
        //         CityEntity::create([
        //                     'entity_id' => $entity_id,
        //                     'city_id' => $city,
        //                 ]);
        //         }
        //     return back()->with('success','Configuration reussie');
        // }catch(\Exception $e){
        //     DB::rollback();
        //     return back()->with('error', 'Une erreur s\'est produite. Veuillez reprendre ou contactez votre administrateur');
        // }

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
