<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Entity;
use App\Models\Echelon;
use App\Models\Category;
use App\Models\Fonction;
use App\Mail\ContactMail;
use App\Models\Department;
use App\Models\FicheRetourCaisse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FicheDepense;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduceController;
use App\Models\FicheApprovisionnementCaisse;
use App\Http\Controllers\SiteSheetController;
use App\Http\Controllers\BookKeeperController;
use App\Http\Controllers\book_keeperController;
use App\Http\Controllers\RecipeSheetController;
use App\Http\Controllers\ExpenseSheetController;
use App\Http\Controllers\EntityController;

use App\Models\FicheDepense as ModelsFicheDepense;
use App\Http\Controllers\FicheRetourCaisseController;
use App\Http\Controllers\ReturnToCachSheetController;
use App\Http\Controllers\MaterialAccountantController;
use App\Http\Controllers\CashRegisterSupplySheetController;
use App\Http\Controllers\AvailabilityRequestSheetController;
use App\Http\Controllers\FicheApprovisionnementCaisseController;
use App\Http\Controllers\MaterialReleaseController;
use App\Http\Controllers\receiptSplitController;
use App\Http\Controllers\SupplyRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'entity'])->group(function () {
    Route::get('/',[HomeController::class, 'index']);

    Route::get('/dashboard',[HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('expense-sheet')->group(function(){
        Route::get('create', [ExpenseSheetController::class, 'create'])->name('expense_sheet.create');
        Route::get('show/{fiche_depense}', [ExpenseSheetController::class, 'show'])->name('expense_sheet.show');
        Route::get('my/encours', [ExpenseSheetController::class, 'my_encours'])->name('expense_sheet.my.encours');
        Route::get('imputable', [ExpenseSheetController::class, 'imputable'])->name('expense_sheet.imputable');
        Route::get('ordonnancable', [ExpenseSheetController::class, 'ordonnancable'])->name('expense_sheet.ordonnancable');
        Route::get('controle_budgetaire', [ExpenseSheetController::class, 'controle_budgetaire'])->name('expense_sheet.controle_budgetaire');
        Route::get('controle_conformite', [ExpenseSheetController::class, 'controle_conformite'])->name('expense_sheet.controle_conformite');
        Route::get('encours', [ExpenseSheetController::class, 'encours'])->name('expense_sheet.encours');
        Route::get('validated', [ExpenseSheetController::class, 'validated'])->name('expense_sheet.validated');
        Route::get('rejected', [ExpenseSheetController::class, 'rejected'])->name('expense_sheet.rejected');
        Route::get('archived', [ExpenseSheetController::class, 'archived'])->name('expense_sheet.archived');
        Route::post('store', [ExpenseSheetController::class, 'store'])->name('expense_sheet.store');
    });

    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('show/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('profile', [UserController::class, 'profile'])->name('users.profile');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::PUT('update/{user}', [UserController::class, 'update'])->name('users.update');
    });
    // Entity gestion
    Route::prefix('entity')->group(function(){
        Route::get('/', [EntityController::class, 'index'])->name('entity.index');
        Route::post('store', [EntityController::class, 'store'])->name('entity.store');
        Route::PUT('update/{entity}', [EntityController::class, 'update'])->name('entyti.update');
    });

    // Fiche approvisionnement caisse
    Route::prefix('cash-register-supply-sheet')->group(function(){
        Route::get('/', [CashRegisterSupplySheetController::class, 'index'])->name('cash_register_supply_sheet.index');
        Route::get('create', [CashRegisterSupplySheetController::class, 'create'])->name('cash_register_supply_sheet.create');
        Route::post('store', [CashRegisterSupplySheetController::class, 'store'])->name('cash_register_supply_sheet.store');
        Route::get('show/{fiche_approv_caisse}', [CashRegisterSupplySheetController::class, 'show'])->name('cash_register_supply_sheet.show');
    });

    // Fiche retour en caisse
    Route::prefix('return-to-cash-sheet')->group(function(){
        Route::get('/', [ReturnToCachSheetController::class, 'index'])->name('return_to_cash_sheet.index');
        Route::get('create', [ReturnToCachSheetController::class, 'create'])->name('return_to_cash_sheet.create');
        Route::get('show/{frc}', [ReturnToCachSheetController::class, 'show'])->name('return_to_cash_sheet.show');
        Route::post('store', [ReturnToCachSheetController::class, 'store'])->name('return_to_cash_sheet.store');
    });

    // Recipe sheet / Fiche recette
    Route::prefix('recipe_sheet')->group(function(){
        Route::get('/', [RecipeSheetController::class, 'index'])->name('recipe_sheet.index');
        Route::get('create', [RecipeSheetController::class, 'create'])->name('recipe_sheet.create');
        Route::get('show/{id}', [RecipeSheetController::class, 'show'])->name('recipe_sheet.show');
        Route::post('store', [RecipeSheetController::class, 'store'])->name('recipe_sheet.store');
        Route::get('FR/jour', [RecipeSheetController::class, 'by_day'])->name('recipe_sheet.by_day');

    });

    // Avaibility Request Sheet / Demande de mise à disposition
    Route::prefix('availability_request_sheet')->group(function(){
        Route::get('/', [AvailabilityRequestSheetController::class, 'index'])->name('availability_request_sheet.index');
        Route::get('create', [AvailabilityRequestSheetController::class, 'create'])->name('availability_request_sheet.create');
        Route::get('show/{id}', [AvailabilityRequestSheetController::class, 'show'])->name('availability_request_sheet.show');
        Route::post('store', [AvailabilityRequestSheetController::class, 'store'])->name('availability_request_sheet.store');
        Route::get('DMD/controllable', [AvailabilityRequestSheetController::class, 'controllable'])->name('availability_request_sheet.controllable');
        Route::get('DMD/ordonnable', [AvailabilityRequestSheetController::class, 'ordonnable'])->name('availability_request_sheet.ordonnable');
        Route::get('DMD/comptabilisable', [AvailabilityRequestSheetController::class, 'comptabilisable'])->name('availability_request_sheet.comptabilisable');
        Route::get('rejected', [AvailabilityRequestSheetController::class, 'rejected'])->name('availability_request_sheet.rejected');
        Route::get('archived', [AvailabilityRequestSheetController::class, 'archived'])->name('availability_request_sheet.archived');
    });

    // Material Release Form / Bon de Sortie de Matériel
    Route::prefix('material_release_form')->group(function(){
        Route::get('/', [MaterialReleaseController::class, 'index'])->name('material_release_form.index');
        Route::get('create', [MaterialReleaseController::class, 'create'])->name('material_release_form.create');
        Route::get('archive', [MaterialReleaseController::class, 'archive'])->name('material_release_form.archive');
        Route::post('store', [MaterialReleaseController::class, 'store'])->name('material_release_form.store');
        Route::POST('validation', [MaterialReleaseController::class, 'material_release_form_validation'])->name('material_release_form.validation');
        Route::POST('exportation/bsm', [MaterialReleaseController::class, 'exportation_list_bsm_archive'])->name('material_release_form.exportation');

        // Route::get('FR/jour', [MaterialReleaseController::class, 'by_day'])->name('material_release_form.by_day');

    });

    // Supply Request Form / Demande d'achat
    Route::prefix('supply_request_form')->group(function(){
        Route::get('/', [SupplyRequestController::class, 'index'])->name('supply_request_form.index');
        Route::get('create', [SupplyRequestController::class, 'create'])->name('supply_request_form.create');
        Route::get('show/{id}', [SupplyRequestController::class, 'show'])->name('supply_request_form.show');
        Route::post('store', [SupplyRequestController::class, 'store'])->name('supply_request_form.store');
        // Route::get('FR/jour', [SupplyRequestController::class, 'by_day'])->name('supply_request_form.by_day');

    });
    // Receipt slip Form / Bon d'entrée
    Route::prefix('receipe_slip_form')->group(function(){
        Route::get('/', [receiptSplitController::class, 'index'])->name('supply_request_form.index');
        Route::get('create', [SupplyRequestController::class, 'create'])->name('supply_request_form.create');
        Route::get('show/{id}', [SupplyRequestController::class, 'show'])->name('supply_request_form.show');
        Route::post('store', [receiptSplitController::class, 'store'])->name('supply_request_form.store');
        // Route::get('FR/jour', [SupplyRequestController::class, 'by_day'])->name('supply_request_form.by_day');

    });

    // Element du comptable
    Route::prefix('book_keeper')->group(function(){

        Route::get('/create',[BookKeeperController::class,'create'])->name('book_keeper.create');
        Route::post('store', [BookKeeperController::class, 'store'])->name('book_keeper.store');
        Route::get('/index',[BookKeeperController::class,'index'])->name('book_keeper.index');

    });
    // Element du comptable matière \ material accountant
    Route::prefix('material_accountant')->group(function(){

        Route::get('/create_af',[MaterialAccountantController::class,'create_af'])->name('material_accountant.create_af');
        Route::post('store_af', [MaterialAccountantController::class, 'store_af'])->name('material_accountant.store_af');

        Route::get('/create_a',[MaterialAccountantController::class,'create_a'])->name('material_accountant.create_a');
        Route::post('store_a', [MaterialAccountantController::class, 'store_a'])->name('material_accountant.store_a');

    });

    // Configuration des site fiche de recette
    Route::prefix('config_site')->group(function(){

        Route::get('/create',[SiteSheetController::class,'create'])->name('config_site.create');
        Route::post('store', [SiteSheetController::class, 'store'])->name('config_site.store');
        Route::get('/index',[SiteSheetController::class,'index'])->name('config_site.index');

    });

    // Configuration des site fiche de recette
    Route::prefix('produce_configuration')->group(function(){

        Route::get('/create',[ProduceController::class,'create'])->name('produce_configuration.create');
        Route::post('store', [ProduceController::class, 'store'])->name('produce_configuration.store');
        Route::get('/index',[ProduceController::class,'index'])->name('produce_configuration.index');

    });




    // à supprimer
    // Route::get('FicheApprovCaisse', function () {
    //     return view('fiche_approv_caisse');
    // })->name('fac');
    // Route::get('ListFAC', function () {
    //     return view('list_fiche_approv_caisse');
    // })->name('listfac');


    // consult FRC
    // Route::get('ConsultFRC', function () {

    //     $fiche_retour_caisse = FicheRetourCaisse::all();

    //     return view('ConsultFRC', compact('fiche_retour_caisse'));
    // })->name('ConsultFRC');

    // route pour fiche retour caisse on press side
    // Route::get('FicheRetourCaisse', function () {
    //     return view('fiche_retour_caisse');
    // })->name('frc');

    // route pour fiche retour caisse on press side

    // Route::get('FicheDepense/show', function () {
    //     return view('ConsultFD');
    // })->name('FicheDepense.show');

    // Route::get('FicheApprovCaisse/show', function () {
    //     return view('ConsultFAC');
    // })->name('FicheApprovCaisse.show');

    // Route::get('visual_fd/{fiche_depense}',function($fiche_depense){

    //     $fiche_depense = ModelsFicheDepense::find($fiche_depense);
    //     // dd($fiche_depense);
    //     return view('visual_fd', compact('fiche_depense'));
    // })->name('visual_fd');


    // Route::get('send-mail',function(){

    //     $contenu = [
    //         'title' => 'Mail de'
    //     ];
    //     Mail::to('paulmenanga@bfclimited.com')->send(new ContactMail($contenu));

    //     dd("Email envoyé avec succès.");
    // });

// <<<<<<< HEAD
//     Route::POST('fiche_depense', [FicheDepense::class, 'store'])->name('fiche_depense');
//     Route::POST('fiche_depense_validation/{user}', [FicheDepense::class, 'fiche_depense_validation'])->name('fiche_depense.validation_fd');

//     Route::POST('add/num_comptable/{fiche_depense}', [FicheDepense::class, 'add_num_comptable'])->name('add.num_comptable');
//     Route::POST('rejet_conf/fiche_depense/{fiche_depense}', [FicheDepense::class, 'rejet_conf_fiche_depense'])->name('rejet_conf.fiche_depense');
//     Route::POST('rejet_budj/fiche_depense/{fiche_depense}', [FicheDepense::class, 'rejet_budj_fiche_depense'])->name('rejet_budj.fiche_depense');
//     Route::POST('rejet_ordonateur/fiche_depense/{fiche_depense}', [FicheDepense::class, 'rejet_ordonateur_fiche_depense'])->name('rejet_ordonateur.fiche_depense');

//     Route::get('fiche_retour_caisse', [FicheRetourCaisseController::class, 'create']);
//     Route::post('fiche_retour_caisse', [FicheRetourCaisseController::class, 'store'])->name('fiche_retour_caisse');
//     Route::get('ConsultFRC',[FicheRetourCaisseController::class, 'index'])->name('ConsultFRC');
//     Route::get('visual_frc/{frc}',[FicheRetourCaisseController::class, 'show'])->name('visual_frc');
// =======
    // Route::POST('fiche_depense', [FicheDepense::class, 'store'])->name('fiche_depense');
    // A ne pas enlever

    //processus de validation des fiches de dépense
    Route::POST('fiche_depense_validation/{user}', [ExpenseSheetController::class, 'fiche_depense_validation'])->name('fiche_depense.validation_fd');
    Route::POST('add/num_comptable/{fiche_depense}', [ExpenseSheetController::class, 'add_num_comptable'])->name('add.num_comptable');
    Route::POST('rejet_conf/fiche_depense/{fiche_depense}', [ExpenseSheetController::class, 'rejet_conf_fiche_depense'])->name('rejet_conf.fiche_depense');
    Route::POST('rejet_budj/fiche_depense/{fiche_depense}', [ExpenseSheetController::class, 'rejet_budj_fiche_depense'])->name('rejet_budj.fiche_depense');
    Route::POST('rejet_ordonateur/fiche_depense/{fiche_depense}', [ExpenseSheetController::class, 'rejet_ordonateur_fiche_depense'])->name('rejet_ordonateur.fiche_depense');

    // validation des fiches approvisionnement caisse
    Route::POST('cash_register_supply_validation/{fiche_approv_caisse}', [CashRegisterSupplySheetController::class, 'cash_register_supply_validation'])->name('cash_register_supply_sheet.validation_fac');
    Route::POST('add/num_comptable_fac/{fiche_approv_caisse}', [CashRegisterSupplySheetController::class, 'add_num_comptable'])->name('add.num_comptable_fac');

    // processus de validation des fiches de recett
    Route::POST('recipe_sheet_validation/{recipe_sheet}', [RecipeSheetController::class, 'recipe_sheet_validation'])->name('recipe_sheet.validation_fr');
    Route::POST('add/num_comptable_fr/{recipe_sheet}', [RecipeSheetController::class, 'add_num_comptable'])->name('add.num_comptable_fr');


    //validation fiche retour caisse
    Route::POST('return_to_cash_validation/{fiche_retour_caisse}', [ReturnToCachSheetController::class, 'return_to_cash_validation'])->name('return_to_cash.validation_frc');
    Route::POST('add/num_comptable_frc/{fiche_retour_caisse}', [ReturnToCachSheetController::class, 'add_num_comptable'])->name('add.num_comptable_frc');
    // Route::POST('observation_retourneur/fiche_retour_caisse/{fiche_retour_caisse}', [ReturnToCachSheetController::class, 'observation_retourneur_frc'])->name('observation_retourneur.fiche_retour_caisse');    // Route::get('fiche_retour_caisse', [FicheRetourCaisseController::class, 'create']);

    // Processus de validation des DMD
    Route::POST('availability_request_validation/{availability_request_sheet}', [AvailabilityRequestSheetController::class, 'availability_request_validation'])->name('availability_request_sheet.validation_dmd');
    Route::POST('chef_depart_rejet/availability_request_sheet/{availability_request_sheet}', [AvailabilityRequestSheetController::class, 'chef_depart_rejet_availability_request'])->name('chef_depart_rejet.availability_request_sheet');
    Route::POST('controleur_rejet/availability_request_sheet/{availability_request_sheet}', [AvailabilityRequestSheetController::class, 'controleur_rejet_availability_request'])->name('controleur_rejet.availability_request_sheet');
    Route::POST('d_g_rejet/availability_request_sheet/{availability_request_sheet}', [AvailabilityRequestSheetController::class, 'd_g_rejet_availability_request'])->name('d_g_rejet.availability_request_sheet');
    Route::POST('president_rejet/availability_request_sheet/{availability_request_sheet}', [AvailabilityRequestSheetController::class, 'president_rejet_availability_request'])->name('president_rejet.availability_request_sheet');


    // Route::post('fiche_retour_caisse', [FicheRetourCaisseController::class, 'store'])->name('fiche_retour_caisse');
    // Route::get('ConsultFRC',[FicheRetourCaisseController::class, 'index'])->name('ConsultFRC');
    // Route::get('visual_frc/{frc}',[FicheRetourCaisseController::class, 'show'])->name('visual_frc');
// >>>>>>> e48ccc99b5457ab407436f7415e152db987c0a1d
    // Route::get('ConsultFAC', [::class, 'create']);
    // Route::post('ConsultFAC', [FicheApprovisionnementCaisseController::class, 'store'])->name('fiche_approv_caisse');
    // Route::get('users/profil/{user}', [UserController::class, 'profile'])->name('users.profile');
// consult FAC
    // Route::get('fiche_approv_caisse', [FicheApprovisionnementCaisseController::class, 'create']);
    // Route::post('fiche_approv_caisse', [FicheApprovisionnementCaisseController::class, 'store'])->name('fiche_approv_caisse');
    // Route::get('ConsultFAC',[FicheApprovisionnementCaisseController::class, 'index'])->name('ConsultFAC');
    // Route::get('visual_fac/{fac}',[FicheApprovisionnementCaisseController::class, 'show'])->name('visual_fac');

});

require __DIR__.'/auth.php';
