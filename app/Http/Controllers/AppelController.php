<?php

namespace App\Http\Controllers;

use App\Appel;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class AppelController extends Controller
{

    public function index(Request $request)
    {

        $page = 'Appels';
        //$appels = Appel::orderByRaw('RAND()')->take(2)->get();

        $appels = DB::table('appel')->get();
        return view('/appels/appels', compact('appels', 'page'));

    }


    /***** liste des appel relancé***/
    public function relanceAppel(Request $request)
    {
        $page = 'Relance Appel';
        $appels = DB::table('appel')->where('injoignable', 1)->get();
        return view('/appels/relances', compact('appels', 'page'));

    }
    /********** add appel by assistance***************/
    public function ajouterAppel()
    {
        $page='Nouvel Appel';
      /*  $users=User::
        select('users.id','users.name',DB::raw('min(nb_appel_recu) as nb')  )
            ->where('is_admin',0)
            ->groupBy('users.id','users.name')
            ->get()
            ->take(1);*/
       $users = User::whereRaw('nb_appel_recu = (select min(`nb_appel_recu`) from users where is_admin=0)')->get()->take(1);
        return view('/appels/ajouter_appel', compact('page','users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'telephone' => 'required',
            'source'=>'required',
            'type_bien'=>'required',
        ],
            [
                'telephone.required' => 'Veuillez renseigner le  numéro du telephone',
                'source.required' => 'Veuillez renseigner la source',
                'type_bien.required' => 'Veuillez renseigner le type de produit',
            ]

        );
        $cc=$request->get('cc_id');
      /* $users=User::
        select('users.id','users.name',DB::raw('min(nb_appel_recu) as nb')  )
            ->where('is_admin',0)
            ->groupBy('users.id','users.name')
            ->get()
            ->take(1);*/


       $users = User::whereRaw('nb_appel_recu = (select min(`nb_appel_recu`) from users where is_admin=0 )')->get()->take(1);

        $appel=Appel::create([
            'date'=>date('y-m-d'),
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'telephone'=>$request->get('telephone'),
            'ville'=>$request->get('ville'),
            'source'=>$request->get('source'),
            'type_bien'=>$request->get('type_bien'),
            'commenatire_assistance'=>$request->get('commenatire_assistance'),
            'cc_id'=>$request->get('cc_id'),

        ]);

        if($appel){

            foreach ($users as $us){
                $new_value=$us->nb_appel_recu;
                $us->update([
                    'nb_appel_recu'=>$new_value+1,
                ]);
            }
            $nbre_appel_recu = DB::table('appel')->where('cc_id',$cc)->where('traite', 0)->count();
            $page='Appels';
            $success="nouvel Appel créé avec succès !!";
            $appels=DB::table('appel')->get();
            return redirect('/appels')->with('appels', 'page','users','nbre_appel_recu');

        }
    }





// liste des appels traité par commercial
    public function indexAppelTrait($id)
    {
        $appels=DB::table('appel')->where('cc_id', $id)->where('traite', 1)->where('injoignable', 0)->get();
        $nbre_appel_recu = DB::table('appel')->where('cc_id',$id)->where('traite', 0)->count();
        $page='Consult appel';
        return view('/appels/appels_traite', compact('appels', 'page','nbre_appel_recu'));
    }


    //appels  recu
    public function indexAppelrecu($id)
    {
        $appels=DB::table('appel')->where('cc_id', $id)->where('traite', 0)->get();
        $nbre_appel_recu = DB::table('appel')->where('cc_id',$id)->where('traite', 0)->count();
        $page='Consult appel';

        return view('/appels/appels_recu', compact('appels', 'page','nbre_appel_recu'));
    }




/***** Commercial traiter appel recu ***/
    public function traiterAppelrecu($id)
    {
        $page='Traiter Appel recu';

        $appel=Appel::find($id);
        $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        return view('/appels/traiter_appel_recu', compact('appel', 'page','nbre_appel_recu'));
    }




    public function updateTraiterAppelrecu(Request $request, $id)
    {
        $cc=$request->get('cc_id');
       // $userss= DB::table('users')->where('id',$cc)->where('is_admin', 0)->get();
       $userss =User::find($cc);
        $appel=Appel::find($id);
        $appel->update([

            'date_relance'=>$request->get('date_relance'),
            'interet'=>$request->get('interet'),
            'frein'=>$request->get('frein'),
            'prochaine_relance'=>$request->get('prochaine_relance'),
            'commentaire_cc'=>$request->get('commentaire_cc'),
            'injoignable'=>$request->get('injoignable'),
             'traite'=>1,
        ]);

        if($appel){
                $new_value=$userss->nb_appel_traite;
                echo $new_value;
            $userss->update([
                    'nb_appel_traite'=>$new_value+1,
                ]);

       return redirect('/appels/traite/'.$cc);


        }
    }

/*********** fin Commercial traiter appel recu  ************/

    public function destroy($id)
    {
        $appel=Appel::find($id);
        $nom=$appel->nom;
        if($appel->delete()){
            $delete_msg="l'appel ".$nom." a été supprimé avec succès";
            $appels=DB::table('Appel')->get();
            $page='users';
            return redirect('/appels')->with('appels', 'delete_msg', 'page');
        }
    }




/************search *********/
    public function searchAppel(Request $request)
    {
        if($request->ajax()){
            $output="";
            $appels=DB::table('appel')
                ->where('telephone','LIKE','%'.$request->search."%")
                ->orWhere('source','LIKE','%'.$request->search."%")
                ->get();
            if($appels){
                foreach ($appels as $app) {
                    $output.='<tr>';
                    $output.='<td>'.$app->nom.'</td>';
                    $output.='<td>'.$app->prenom.'</td>';
                    $output.='<td>'.$app->telephone.'</td>';
                    $output.='<td>'.$app->ville.'</td>';
                    $output.='<td>'.$app->source.'</td>';
                    $output.='<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/appels/detail/'.$app->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==2){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/appels/modifier_appel/'.$app->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteAppel'.$app->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;
            }

        }



    }



/***********detail appel************/
    public function show($id)
    {
        $appel=Appel::find($id);
        $page=$appel->nom;
        return view('/appels/detail_appel', compact('appel', 'page'));
    }


/**********MODIFIER APPEL ASSISTANTE ************/
    public function editappel($id)
    {
        $page='Modifier Appel ';

        $ap=Appel::find($id);

        return view('/appels/modifier_appel', compact('ap', 'page'));
    }
    /************ASSISTANTE*******/
    public function updateAppelAss(Request $request, $id)
    {
        $appel=Appel::find($id);
        $appel->update([
            'date'=>date('y-m-d'),
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'telephone'=>$request->get('telephone'),
            'ville'=>$request->get('ville'),
            'source'=>$request->get('source'),
            'type_bien'=>$request->get('type_bien'),
            'commenatire_assistance'=>$request->get('commenatire_assistance'),

        ]);



        $page='Modifer appel';
        $appels=DB::table('appel')->get();
        return redirect('/appels')->with('appels', 'page');

    }
/**************commercial*********/
    public function updateAppelComm(Request $request, $id)
    {
        $cc=$request->get('cc_id');
        $appel_comm=Appel::find($id);
        $appel_comm->update([
            'date_relance'=>$request->get('date_relance'),
            'interet'=>$request->get('interet'),
            'frein'=>$request->get('frein'),
            'prochaine_relance'=>$request->get('prochaine_relance'),
            'commentaire_cc'=>$request->get('commentaire_cc'),
            'injoignable'=>$request->get('injoignable'),
            'traite'=>1,
        ]);

        $page='Modifer appel';
        return redirect('/appels/traite/'.$cc);

    }





}
