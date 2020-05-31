<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Convention;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Dossier;
use App\Aquereur;

class ClientController extends Controller
{
    public function index()
    {
        $page='Clients';
        $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        $clients=DB::table('Client')->get();
        return view('/clients/clients', compact('clients', 'page','nbre_appel_recu'));

    }


    public function ajouterClient()
    {
        $page='Nouveau Client';
        $societes=DB::table('convention')->get();
        return view('/clients/ajouter_client', compact('page','societes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom'=>'required',
            'telephone1'=>'required',
            'cin'=>'required|unique:client,cin',
        ],
            [
                'nom.required' => 'Veuillez renseigner le nom du client',
                'prenom.required' => 'Veuillez renseigner le prénom du client',
                'telephone1.required' => 'Veuillez renseigner le téléphone du client',
                'cin.required' => 'Veuillez renseigner le CIN du client',
                'cin.unique' => 'Le cin que vous avez saisi  existe déjà',

            ]
        );
         $client=Client::create([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'telephone1'=>$request->get('telephone1'),
            'telephone2'=>$request->get('telephone2'),
            'civilite'=>$request->get('civilite'),
            'adresse'=>$request->get('adresse'),
            'ville'=>$request->get('ville'),
            'pays'=>$request->get('pays'),
            'profession'=>$request->get('profession'),
            'situation_pro'=>$request->get('situation_pro'),
            'societe_id'=>$request->get('societe_id'),
            'cin'=>$request->get('cin'),
            'lieu_naissance'=>$request->get('lieu_naissance'),
            'date_naissance'=>$request->get('date_naissance'),
            'age'=>$request->get('age'),
            'nationalite'=>$request->get('nationalite'),
            'nom_responsable'=>$request->get('nom_responsable'),
            'relation_familiale'=>$request->get('relation_familiale'),
            'situation_familiale'=>$request->get('situation_familiale'),
            'nom_mari'=>$request->get('nom_mari'),
            'date_mariage'=>$request->get('date_mariage'),
            'lieu_mariage'=>$request->get('lieu_mariage'),
            'nom_pere'=>$request->get('nom_pere'),
            'nom_mere'=>$request->get('nom_mere'),
            'mode_financement'=>$request->get('mode_financement'),
            'banque'=>$request->get('banque'),
        ]);

        if($client){
            $client_id=$client->id;
            $page='clients';
            $client=DB::table('client')->get();
            return redirect('/clients/detail/'.$client_id);

        }
    }
    public function edit($id)
    {
        $page='Modifier Client';
        echo $page;
        $client=Client::find($id);
        $societes=DB::table('convention')->get();

        return view('/clients/modifier_client', compact('client', 'page','societes'));
    }



    public function update(Request $request, $id)

    {

        $client=Client::find($id);
        $client->update([
                 'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'telephone1'=>$request->get('telephone1'),
            'telephone2'=>$request->get('telephone2'),
            'civilite'=>$request->get('civilite'),
            'adresse'=>$request->get('adresse'),
            'ville'=>$request->get('ville'),
            'pays'=>$request->get('pays'),
            'profession'=>$request->get('profession'),
            'situation_pro'=>$request->get('situation_pro'),
            'societe_id'=>$request->get('societe_id'),
            'cin'=>$request->get('cin'),
            'lieu_naissance'=>$request->get('lieu_naissance'),
            'date_naissance'=>$request->get('date_naissance'),
            'age'=>$request->get('age'),
            'nationalite'=>$request->get('nationalite'),
            'nom_responsable'=>$request->get('nom_responsable'),
            'relation_familiale'=>$request->get('relation_familiale'),
            'situation_familiale'=>$request->get('situation_familiale'),
            'nom_mari'=>$request->get('nom_mari'),
            'date_mariage'=>$request->get('date_mariage'),
            'lieu_mariage'=>$request->get('lieu_mariage'),
            'nom_pere'=>$request->get('nom_pere'),
            'nom_mere'=>$request->get('nom_mere'),
            'mode_financement'=>$request->get('mode_financement'),
            'banque'=>$request->get('banque'),
        ]);



        $client='clients';
        $clients=DB::table('client')->get();
        return redirect('/clients')->with('clients');

    }


    public function show($id)
    {
        $client=Client::find($id);
        $page=$client->nom;
        $nombre_dossiers=DB::table('aquereurs')->where('client_id',$id)->count();
        return view('/clients/detail_client', compact('client', 'nombre_dossiers', 'page'));
    }
    public function destroy($id)
    {
        $client=Client::find($id);
        $nom=$client->nom;
        if($client->delete()){
            $delete_msg='le client '.$nom.' a été supprimé avec succès';
            $clients=DB::table('client')->get();
            return redirect('/clients')->with('clients', 'delete_msg');
        }
    }
      public function searchClient(Request $request)
    {
        if($request->ajax()){
            $output="";
            $clients=DB::table('client')
                ->where('nom','LIKE','%'.$request->search."%")
                ->orWhere('prenom','LIKE','%'.$request->search."%")
                ->orWhere('telephone1','LIKE','%'.$request->search."%")
                ->orWhere('ville','LIKE','%'.$request->search."%")
                ->get();


            if($clients){
                foreach ($clients as $client) {
                    $output.='<tr>';
                    $output.='<td>'.$client->nom.'</td>'.
                        '<td>'.$client->prenom.'</td>'.
                       '<td>'.$client->telephone1.'</td>'.
                        '<td>'.$client->ville.'</td>'.
                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/clients/detail/'.$client->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/clients/modifier_client/'.$client->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$client->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.

                        '</tr>';
                }
                return $output;

            }
        }
    }

     public function nouvel_aquereur($dossier_id)
    {
        $dossier=Dossier::find($dossier_id);
        $page='Nouveau Client';
        $societes=DB::table('convention')->get();
        return view('/clients/ajouter_client', compact('page','societes','dossier'));
    }

    public function store_nouvel_aquereur(Request $request, $dossier_id)
    {
        $client=Client::create([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'telephone1'=>$request->get('telephone1'),
            'telephone2'=>$request->get('telephone2'),
            'civilite'=>$request->get('civilite'),
            'adresse'=>$request->get('adresse'),
            'ville'=>$request->get('ville'),
            'pays'=>$request->get('pays'),
            'profession'=>$request->get('profession'),
            'situation_pro'=>$request->get('situation_pro'),
            'societe_id'=>$request->get('societe_id'),
            'cin'=>$request->get('cin'),
            'lieu_naissance'=>$request->get('lieu_naissance'),
            'date_naissance'=>$request->get('date_naissance'),
            'age'=>$request->get('age'),
            'nationalite'=>$request->get('nationalite'),
            'nom_responsable'=>$request->get('nom_responsable'),
            'relation_familiale'=>$request->get('relation_familiale'),
            'situation_familiale'=>$request->get('situation_familiale'),
            'nom_mari'=>$request->get('nom_mari'),
            'date_mariage'=>$request->get('date_mariage'),
            'lieu_mariage'=>$request->get('lieu_mariage'),
            'nom_pere'=>$request->get('nom_pere'),
            'nom_mere'=>$request->get('nom_mere'),
            'mode_financement'=>$request->get('mode_financement'),
            'banque'=>$request->get('banque'),
        ]);

        if($client){
            $aquereur=Aquereur::create([
                'client_id'=>$client->id,
                'dossier_id'=>$dossier_id,

            ]);


            return redirect('/dossiers/'.$dossier_id.'/detail_dossier');


        }
    }















}
