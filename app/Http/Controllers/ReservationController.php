<?php

namespace App\Http\Controllers;

use App\Convention;
use Illuminate\Http\Request;
use DB;
use App\Dossier;
use App\Aquereur;
use App\Paiement;
use App\Client;
use App\Projet;
use App\Tranche;
use App\Bloc;
use App\Immeuble;
use App\Bien;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    public function index()
    {
        $page='Reservations';
        $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        $reservations=DB::table('Reservation')->get();
        return view('/reservations/reservations', compact('reservations', 'page','nbre_appel_recu'));

    }


    public function ajouter_dossier($client_id=null)
    {
            $page='Nouveau Dossier';
            $commercials=DB::table('users')->where('is_admin', '0')->get();
            $projets=DB::table('projet')->get();
            $client=Client::find($client_id);

            return view('/reservations/ajouter_dossier', compact('page', 'commercials', 'client', 'projets'));

    }
    public function detail_dossier($dossier_id){
        $page='Dossier';
        $dossier=Dossier::find($dossier_id);
        $nbre_aquereurs=$dossier->nombre_aquereurs;
        $aquereurs=DB::table('aquereurs')->where('dossier_id', $dossier_id)->get();
        $clients=DB::table('client')->get();
        $projets=DB::table('projet')->get();
        $tranches=DB::table('tranche')->get();
        $blocs=DB::table('bloc')->get();
        $immeubles=DB::table('immeuble')->get();
        $biens=DB::table('bien')->get();
        $exist_paiement=DB::table('paiement')->where('dossier_id', $dossier_id)->count();

        if ($exist_paiement>0) {
            $paiement=DB::table('paiement')->where('dossier_id', $dossier_id)->get();
            return view('/reservations/detail_dossier', compact('page','aquereurs', 'clients', 'dossier','nbre_aquereurs', 'projets', 'tranches', 'blocs', 'immeubles', 'biens','paiement'));
        }else{
            if ($dossier->id<10) {
                $num_recu='D0'.$dossier->id.'';
            }else{
                $num_recu='D'.$dossier->id.'';
            }
            return view('/reservations/detail_dossier', compact('page','aquereurs', 'clients', 'dossier','nbre_aquereurs', 'projets', 'tranches', 'blocs', 'immeubles', 'biens', 'num_recu'));
        }

    }

    public function edit_dossier($dossier_id){

        $page='Modifier Dossier';
        $dossier=Dossier::find($dossier_id);
        $nbre_aquereurs=$dossier->nombre_aquereurs;
        $aquereurs=DB::table('aquereurs')->where('dossier_id', $dossier_id)->get();
        $clients=DB::table('client')->get();
        $projets=DB::table('projet')->get();
        $tranches=DB::table('tranche')->get();
        $blocs=DB::table('bloc')->get();
        $immeubles=DB::table('immeuble')->get();
        $biens=DB::table('bien')->get();
        $commercials=DB::table('users')->where('is_admin', '0')->get();
        return view('/reservations/modifier_dossier',  compact('page','aquereurs','clients','nbre_aquereurs', 'projets', 'tranches', 'blocs', 'immeubles', 'biens','dossier','commercials'));
    }



    public function destroy_dossier($dossier_id){
        $dossier=Dossier::find($dossier_id);
        if($dossier->delete()){
            return redirect('/reservations/dossiers');
        }
    }



    public function store_dossier(Request $request){
        $nbre_aquereurs=$request->get('nombre_aquereurs');

        $dossier=Dossier::create([
            'responsable_dossier'=>$request->get('responsable_dossier'),
            'nombre_aquereurs'=>$request->get('nombre_aquereurs'),
            'projet_id'=>$request->get('projet_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'bloc_id'=>$request->get('bloc_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'bien_id'=>$request->get('bien_id'),
            'prix'=>$request->get('prix'),
            'date_reservation'=>$request->get('date_reservation'),
            'date_limite_reservation'=>$request->get('date_limite_reservation'),
        ]);
        if ($dossier ) {
            if ($request->get('client_id')!=null) {
                $aquereur=Aquereur::create([
                        'client_id'=>$request->get('client_id'),
                        'dossier_id'=>$dossier->id,

                ]);
            }


            return redirect('/dossiers/'.$dossier->id.'/detail_dossier');


        }
    }

    public function update_dossier(Request $request, $id){
        $dossier=Dossier::find($id);
        $nbre_aquereurs=$request->get('nombre_aquereurs');

        $dossier->update([
            'responsable_dossier'=>$request->get('responsable_dossier'),
            'nombre_aquereurs'=>$request->get('nombre_aquereurs'),
            'projet_id'=>$request->get('projet_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'bloc_id'=>$request->get('bloc_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'bien_id'=>$request->get('bien_id'),
            'prix'=>$request->get('prix'),
            'date_reservation'=>$request->get('date_reservation'),
            'date_limite_reservation'=>$request->get('date_limite_reservation'),
        ]);
        if ($dossier ) {
/*
            if ($request->get('client_id')!=null) {
                $aquereur=Aquereurs::update([
                    'client_id'=>$request->get('client_id'),
                    'dossier_id'=>$dossier->id,

                ]);
            }*/


            return redirect('/reservations/dossiers');


        }
    }

     public function dossier_all(){
         $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        $dossiers=DB::table('dossier_reservation')->get();
        $projets=DB::table('projet')->get();
        $biens=DB::table('bien')->get();
        $users=DB::table('users')->get();
        $page='Liste des dossiers';

        return view('/reservations/dossiers', compact('dossiers', 'projets', 'biens', 'users', 'page','nbre_appel_recu'));
    }



    public function store_aquereur($dossier_id, Request $request){
        $clients=DB::table('client')->get();
        foreach ($clients as $client) {
            if($request->get('client_'.$client->id)){
                $aquereur=Aquereur::create([
                    'dossier_id'=>$dossier_id,
                    'client_id'=>$request->get('client_'.$client->id),
                ]);

            }
        }
        return redirect('/dossiers/'.$dossier_id.'/detail_dossier');

    }

    public function destroy_aquereur($dossier_id, $aq_id){
        $aquereur=Aquereur::find($aq_id);
        if($aquereur->delete()){
            return redirect('/dossiers/'.$dossier_id.'/detail_dossier');
        }
    }





    public function paiement($dossier_id){
        return view('/reservations/paiement');
    }

    public function storepaiment(Request $request,$dossier_id)
    {


        $paiment = Paiement::create([
            'dossier_id' => $request->get('dossier_id'),
            'num_recu' => $request->get('num_recu'),
            'montant' => $request->get('montant'),
            'sr' => $request->get('sr'),
            'montant_lettre' => $request->get('montant_lettre'),
            'date_reglement' => $request->get('date_reglement'),
            'modalite_paiement' => $request->get('modalite_paiement'),
            'echeance' => $request->get('echeance'),
            'banque' => $request->get('banque'),
            'num_paiement' => $request->get('num_paiement'),

        ]);
        if ($paiment) {

            return redirect('/dossiers/' . $dossier_id . '/detail_dossier');


        }


    }

    public function updatepaiment(Request $request, $dossier_id)
    {
        $paiement=DB::table('paiement')->where('dossier_id', $dossier_id);

        $paiement->update([
            'dossier_id' => $request->get('dossier_id'),
            'num_recu' => $request->get('num_recu'),
            'sr' => $request->get('sr'),
            'montant' => $request->get('montant'),
            'montant_lettre' => $request->get('montant_lettre'),
            'date_reglement' => $request->get('date_reglement'),
            'modalite_paiement' => $request->get('modalite_paiement'),
            'echeance' => $request->get('echeance'),
            'banque' => $request->get('banque'),
            'num_paiement' => $request->get('num_paiement'),

        ]);



        return redirect('/dossiers/' . $dossier_id . '/detail_dossier');
    }
}
