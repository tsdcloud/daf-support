<?php

use App\Models\FicheDepense;
use App\Models\Fonction;
use App\Models\Inscription;
use App\Models\PropositionSanction;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use App\Models\Role;

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route){
        return 'active';
    }
    if(isContained($routeActuel, $route)){
        return 'active';
    }
    return "";
}

function setMenuOpen($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route){
        return 'menu-open';
    }
    if(isContained($routeActuel, $route)){
        return 'menu-open';
    }
    return "";
}

function stringToLowercase($value){
    return Str::of($value)->lower();
}

function isContained($container, $content){
    return Str::contains($container, $content);
}

function listOfPrivileges($lists){
    $list = "";
    $number_of_privilege = count($lists);

    foreach ($lists as $selfprivilege){
        $list = $list . $selfprivilege->name_of_privilege;

        if($number_of_privilege > 1){
            $list = $list . "; ";
        }

        $number_of_privilege --;
    }
    return $list;
}

function setDate($dateInput){
    $date = Carbon::parse($dateInput, 'UTC');

    return $date->isoFormat('MMMM Do YYYY, h:mm:ss a');
}
function limitString($string){
    return Str::limit($string, 7, '...');
}
function changeDateFormat($date){

    // $date = Carbon::createFromIsoFormat('!YYYY-MMMM-D h:mm:ss a', '2019-January-3 6:33:24 pm', 'UTC');
    // echo $date->isoFormat('M/D/YY HH:mm');

    $date = Carbon::parse($date, 'UTC');

    return $date->isoFormat('d/m/Y à HH:mm');
}

function getEntity($fonction_id){

    if(!session()->has('fonction_id')){
        return route('login');
    }
    $fonction = Fonction::find($fonction_id['fonction_id']);
    return $fonction->fonction;
}
function getEntityAttribute($fonction_id){
    if(!session()->has('fonction_id')){
        return route('login');
    }
    $fonction = Fonction::find($fonction_id['fonction_id']);
    return $fonction->user_entity->entity;
}

function getEntityImg($fonction_id){

    if(!session()->has('fonction_id')){
        return route('login');
    }
    try{
        $fonction = Fonction::find($fonction_id['fonction_id']);
        // dump($fonction_id);
        // dump($fonction_id['fonction_id']);
        // dump($fonction);
        // dump($fonction_id['fonction_id']);
        // return $fonction->user_entity->entity_id;
        return $fonction->user_entity->entity->logo;
    }catch(\Exception $e){
        abort(403);
    }
}

function getFunctions($fonction_id){
    $fonction = Fonction::find($fonction_id['fonction_id']);

    return Fonction::where(['user_entity_id' => $fonction->user_entity_id])->get();
}

function checkFDAccess(FicheDepense $fiche_depense){

    if(auth()->user()->isAdmin() || auth()->user()->isComptable() || auth()->user()->isControleur() || auth()->user()->isControleur_conf() || auth()->user()->isCaissier()){
        return true;
    }

    if(auth()->user()->id == $fiche_depense->user_id || auth()->user()->id == $fiche_depense->beneficiaire || auth()->user()->id == $fiche_depense->ordonateur){
        return true;
    }

    return false;
}
