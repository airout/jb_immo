<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page='Users';
        $users=DB::table('Users')->get();
        return view('/users/users', compact('users', 'page'));

    }
    public function indexProfil($id)
    {
        $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        $user=User::find($id);
        $page='Profil';

        return view('/users/detail_profil', compact('user', 'page','nbre_appel_recu'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function ajouterUser()
    {
        $page='Nouvel Utilisateur';
        return view('/users/ajouter_user', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'prenom'=>'required',
            'email'=>'required|unique:users,email' ,
            'type'=>'required',
            'password'=>'required',
        ],
            [
                'name.required' => 'Veuillez renseigner le nom de l\'utilisateur',
                'prenom.required' => 'Veuillez renseigner le prénom de l\'utilisateur',
                'email.email' => 'Veuillez renseigner une adresse email valide',
                'email.unique' => 'L\'e-mail que vous avez saisi existe déja.',
                'email.required' => 'Veuillez renseigner une adresse email de l\'utilisateur',
                'type.required' => 'Veuillez renseigner le type de l\'utilisateur',
                'password.required' => 'Veuillez renseigner un mot de passe'
            ]

        );

        $user=User::create([
            'name'=>$request->get('name'),
            'prenom'=>$request->get('prenom'),
            'email'=>$request->get('email'),
            'is_admin'=>$request->get('is_admin'),
            'password'=>Hash::make($request->get('password')),
            //'remember_token'=>$request->get('remember_token'),

        ]);

        if($user){
            $page='users';
            $success="nouvel utilisateur créé avec succès !!";
            $users=DB::table('users')->get();
            return redirect('/users')->with('users', 'page');

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
        $user=User::find($id);
        $page=$user->name;


        return view('/users/detail_user', compact('user', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page='Modifier Utilsateur';
        $user=User::find($id);

        return view('/users/modifier_user', compact('user', 'page'));
    }
    public function editProfil($id)
    {
        $page='Modifier Profil';
        $user=User::find($id);

        return view('/users/modifier_profil', compact('user', 'page'));
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
        $user=User::find($id);
        $user->update([
            'name'=>$request->get('name'),
            'prenom'=>$request->get('prenom'),
            'email'=>$request->get('email'),
            'is_admin'=>$request->get('is_admin'),
            'password'=>bcrypt($request->get('password')),
           // 'remember_token'=>$request->get('remember_token'),

        ]);



        $page='users';
        $users=DB::table('users')->get();
        return redirect('/users')->with('users', 'page');

    }
    public function updateProfil(Request $request, $id)
    {
        $user=User::find($id);
        $user->update([
            'name'=>$request->get('name'),
            'prenom'=>$request->get('prenom'),
            'email'=>$request->get('email'),
            'is_admin'=>$request->get('is_admin'),
            'password'=>bcrypt($request->get('password')),
            // 'remember_token'=>$request->get('remember_token'),

        ]);


        $page='users';
        $users=DB::table('users')->get();
        return redirect('/profil/detail_profil')->with('users', 'page');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $nom=$user->name;
        if($user->delete()){
            $delete_msg="l'utilisateur ".$nom." a été supprimé avec succès";
            $users=DB::table('Users')->get();
            $page='users';
            return redirect('/users')->with('users', 'delete_msg', 'page');
        }
    }
/*
    public function userSearch($name)
    { echo $name;

        $page='Search User';
         $users = User::where('name',$name)->get();
        return view('/users/index', compact('users', 'page'));
    }*/

    public function searchUser(Request $request)
    {
        if($request->ajax()){
            $output="";
            $users=DB::table('users')
                ->where('name','LIKE','%'.$request->search."%")
                ->orWhere('prenom','LIKE','%'.$request->search."%")
                ->orWhere('email','LIKE','%'.$request->search."%")
                ->get();
            if($users){
                foreach ($users as $user) {
                    $output.='<tr>';
                    $output.='<td>'.$user->name.'</td>';
                    $output.='<td>'.$user->prenom.'</td>';
                    $output.='<td>'.$user->email.'</td>';
                    if($user->is_admin==1){
                        $output.='<td>Administrateur</td>';

                    }
                    elseif($user->is_admin==0){
                        $output.='<td>Commercial</td>';

                    }
                    elseif($user->is_admin==2){
                        $output.='<td>Assistante</td>';

                    }
                    $output.='<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/users/detail/'.$user->id.'"><i class="fas fa-eye"></i></a>';
                        if(Auth::user()->is_admin==1){
                            $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/users/modifier_user/'.$user->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                                      '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteUser'.$user->id.'"><i class="fas fa-trash"></i></a>';
                        }
                        $output.='</td>'.


                    '</tr>';
                }
                return $output;
            }

        }



    }
}
