<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fonction;
use App\Models\UserEntity;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        if($user->user_entity->count() == 1){
            $count = 0;
            $fonction_id = null;
            foreach($user->user_entity as $user_entity){
                $count++;
                $fonction_id = Fonction::where('user_entity_id', $user_entity->id)->first()->id;
            }
            // dump($fonction_id);
            // dump($user->user_entity);
            // dd($user);

            if($count <= 1){
                $request->session()->put('fonction_id', ['fonction_id'=>$fonction_id]);
                // dd(2);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            // dd("Veuillez choisir votre fonction");
            abort(403);

        }else{
            return redirect()->route('entity');
        }
    }

    public function entity(){
        // return view('auth.choose_entity');
        abort(403);
    }

    public function entity_post(Fonction $fonction){
        // dd($fonction);
        session()->put('fonction_id', ['fonction_id' => $fonction->id]);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function entity_get($user_entity){
        try{
            $user_entity = UserEntity::find($user_entity);
            $fonction = $user_entity->fonctions->first();
            //user()
            session()->put('fonction_id', ['fonction_id' => $fonction->id]);
            return redirect()->intended(RouteServiceProvider::HOME);
        }catch(\Exception $e){
            return back();
        }
    }
    public function change_function_post(Fonction $fonction){
        // dd($fonction);
        session()->put('fonction_id', ['fonction_id' => $fonction->id]);
        return back();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // dd(2);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
