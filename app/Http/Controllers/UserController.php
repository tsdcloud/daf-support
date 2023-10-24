<?php

namespace App\Http\Controllers;

use App\Mail\CreationCompteMail;
use App\Models\Category;
use App\Models\Department;
use App\Models\Echelon;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){        
        $entities = Entity::all();
        $categories = Category::all();
        $echelons = Echelon::all();
        $departments = Department::all();
        $grades = Grade::all();
        $roles = Role::all();
        $users = User::all();
        return view('users.index', compact('roles','users', 'entities', 'categories', 'echelons', 'departments', 'grades'));
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
    public function store(Request $request){


        $data = $request->validate([
            "fname" => "required|string",
            "lname" => "required|string",
            "email" => "required|email",
            "phone" => "required|Integer",
            "entity_id" => "required|Integer",
            "grade_id" => "required|Integer",
            "department_id" => "required|Integer",
            "fonction" => "required|string",
            "category_id" => "required|Integer",
            "echelon_id" => "required|Integer",
        ]);

        $data['password'] = Hash::make('password');

        if($request->matricule){
            $data['matricule'] = $request->matricule;
        }


        DB::beginTransaction();
            $user = User::Where('email', $data['email'])->first();
            if($user){
                // dump(1);
                $user_entity = $user->user_entity->where('entity_id', $data['entity_id'])->first();
                if($user_entity){
                    $fonction = $user_entity->fonctions->where('fonction', $data['fonction'])->first();

                    if(!$fonction){
                        Fonction::create([
                            'fonction' =>  $data['fonction'],
                            'user_entity_id' => $user_entity->id,
                            'category_id' => $data['category_id'],
                            'echelon_id' => $data['echelon_id'],
                            'department_id' => $data['department_id'],
                        ]);
                        // $this->fonction($line, $user_entity->id, $data['category_id'], $data['echelon_id'], $data['department_id']);
                    }
                }else{

                    $user_entity = UserEntity::create([
                        'user_id' => $user->id,
                        'grade_id' => $data['grade_id'],
                        'entity_id'=>$data['entity_id'],
                    ]);

                    Fonction::create([
                        'fonction' =>  $data['fonction'],
                        'user_entity_id' => $user_entity->id,
                        'category_id' => $data['category_id'],
                        'echelon_id' => $data['echelon_id'],
                        'department_id' => $data['department_id'],
                    ]);
                }
            }else{
                $user = User::create($data);

                $user_entity = UserEntity::create([
                    'user_id' => $user->id,
                    'grade_id' => $data['grade_id'],
                    'entity_id' => $data['entity_id'],
                ]);

                Fonction::create([
                    'fonction' => $data['fonction'],
                    'user_entity_id' => $user_entity->id,
                    'category_id' => $data['category_id'],
                    'department_id' => $data['department_id'],
                    'echelon_id' => $data['echelon_id'],
                ]);
                // dump($user_entity->id);
                // dd($request->all());


                $mailData = [
                    'user' => $user
                ];

                Mail::to($user->email)->send(new CreationCompteMail($mailData));
            }
            // dd(3);

            if($request->role){
                // dd(4);
                // $data['role'] = $request->role;
                foreach($request->role as $key => $value){
                    Privilege::create([
                        'user_id' => $user->id,
                        'role_id' => $value,
                    ]);
                }

            }
        DB::commit();
        return back()->with('success', 'utilisateur ajouté avec succès');
    }

    

    public function update_profile($user){
        // dd(2);
        $user = User::find($user);

        return view('update_profile', compact('user'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function profile()
    {
        return view('users.profile');
    }
    // public function profile(User $user){
    //     return view('profil');
    // }

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
    public function update(Request $request, User $user)
    {
        // $user = User::find($id);
        $data = $request->validate([
            'fname'=>'required|string',
            'lname'=>'required|string',
            // 'email' => ['required', 'email'],
            'email' => ['required', 'email',Rule::unique('users')->ignore($user->id)],
            // 'email' => ['required', 'email:rfc,dns',Rule::unique('users')->ignore($user->id)],
            'phone'=>'required|numeric',
        ],[
            'fname.string' => 'Le nom doit etre une chaine de caractères',
            'lname.string' => 'Le prénom doit etre une chaine de caractères',
            'phone.numeric' => 'Le numéro doit etre de type numérique',
            'email.email' => 'L\'adresse email ne respecte pas le standard libele@domaine.com',
            'email.unique' => 'Cette adresse email est déjà utilisé',
        ]);

        // dd($data);

        if($request->password){
            $password = $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'password.confirmed' => 'Les mots de passe ne correspondent pas',
            ]);

            $data['password'] = Hash::make($password['password']);
        }


        $user->update($data);
        // alert()->success('Opération réussie', 'Utilisateur mis à jour avec succès');

        return back()->with('success', 'Utilisateur mis à jour avec succès');
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
