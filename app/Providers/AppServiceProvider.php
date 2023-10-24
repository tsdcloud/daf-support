<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // View::composer('*', function($view){

        //                   if (auth()->check())
        //                 {

        //                  $user_entities = auth()->user()->user_entity;

        //                 $fonction_id = array();

        //                //  dd($fonctions);

        //                  foreach ($user_entities as $fonction) {

        //                        $fonction_id['fonction_'.$fonction->user_entity] = $fonction->user_entity;
        //                  }
        //                     session(['fonction' => $fonction_id  ]);

        //                     $view->with('fonction' ,$fonction_id);

        //                 }
        //      // $view->with('')


        // });
        // View::composer('*', function ($view) {

        //     if (auth()->check())
        //     {
        //       if (session()->has('fonction_id')){

        //         $fonction_id = session()->get('fonction_id');
        //       }else{

        //         $fonction_id = auth()->user()->user_entity->get(
        //       }
        //     }
        //    // session([''])
        // });
    }
}
