<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\FamilyArticle;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MaterialAccountantController extends Controller
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
    public function create_af()
    {
        $entites = Entity::get();
        $family_articles = FamilyArticle::get();

        // $family_articles = FamilyArticle::where("id","=",'1')->get();
        // dd($family_articles);
        return view('material_accountant.create_af',compact('family_articles'));    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_a()
    {
        $entites = Entity::get();
        $articles = Article::get();
        $family_articles = FamilyArticle::get();
        // dd($articles->family_article_id);


        return view('material_accountant.create_a',compact('articles', 'family_articles','entites'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_af(Request $request)
    {
        $data=$request->validate([

            "uuid" => 'required|string',
            "label" => 'required|string',
            "description" => 'required|string',
        ], [
            "uuid.required" => 'Précissez le code de la famille d\'article',
            "label.required" => 'Précissez le nom de la famille d\'article',
            "description.required" => 'Faite une description de la famille d\'article',
        ]);
        $data['creator']=auth()->user()->id;
        try{
            // dd($data);
            FamilyArticle::create($data);
            return back()->with('success','Configuration reussie');
        }catch(\Exception $e){
            // dd('echeck');
            DB::rollback();
            return back()->with('error', 'Une erreur s\'est produite. Veuillez reprendre ou contactez votre administrateur');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_a(Request $request)
    {
        // dd($request);
        $data=$request->validate([

            "uuid" => 'required|string',
            "label" => 'required|string',
            "family_article_id" => 'required|integer',
        ], [
            "uuid.required" => 'Précissez le code de l\'article',
            "label.required" => 'Précissez le nom de l\'article',
            "family_article_id.integer" => 'Sélectionnez une famille d\'article',
        ]);
        $data['description'] = $request->description . $data['uuid'];
        // if($request->description){
        // }
        // dd($data);
        $data['creator']=auth()->user()->id;
        // Article::create($data);
        // return back()->with('success','Configuration reussie');

        try{
            Article::create($data);
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
