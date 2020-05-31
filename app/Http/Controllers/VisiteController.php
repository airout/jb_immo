<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use App\Visite;
use App\User;
use App\Partenaire;
use App\Frein;
use App\Bien;
use App\Tranche;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class VisiteController extends Controller
{
    public function index()
    {
        $page='Visites';
        $visites=DB::table('visite')->get();
        return view('/visites/visites', compact( 'projets', 'users', 'page'));
    }
    public function getVisitesByProjet($projet_id){
        $projet=Projet::find($projet_id);
        $page='Visites de '.$projet->nom;
        $users=DB::table('users')->get();
        $biens=DB::table('bien')->get();
        $visites=DB::table('visite')->where('projet_id', $projet_id)->get();

        return view('/visites/visites', compact('page', 'visites', 'projet', 'users', 'biens'));
    }

    public function ajouter_visite($projet_id)
    {
        $page='Nouvelle visite';
        $projet=Projet::find($projet_id);
        $partenaires=DB::table('partenaire')->get();
        $tranches=DB::table('tranche')->where('projet_id', $projet_id)->get();
        return view('/visites/ajouter_visite', compact('page', 'projet', 'partenaires', 'tranches'));
    }
    public function deuxieme_visite($visite_id)
    {
        $page='Deuxieme visite';
        $visite=Visite::find($visite_id);
        $partenaires=DB::table('partenaire')->get();
        $projet=Projet::find($visite->projet_id);
        $tranches=DB::table('tranche')->where('projet_id', $projet->id)->get();
        $bien=Bien::find($visite->bien_id);
        $frein=DB::table('frein')->where('visite_id', $visite_id)->get();


        return view('/visites/deuxieme_visite', compact('page', 'visite', 'projet', 'partenaires', 'tranches', 'bien', 'frein'));
    }


    public function store(Request $request, $projet_id){
        $visite = Visite::create([
            'cc_id' => Auth::user()->id,
            'date' => date('Y-m-d'),
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'telephone' => $request->get('telephone'),
            'cin' => $request->get('cin'),
            'source' => $request->get('source'),
            'partenaire_id' => $request->get('partenaire_id'),
            'interet' => $request->get('interet'),
            'frein' => $request->get('frein'),
            'projet_id' => $projet_id,
            'bien_id' => $request->get('bien_id'),
            'statut' => $request->get('statut'),
            'mode_relance' => $request->get('mode_relance'),
            'prochaine_relance' => $request->get('prochaine_relance'),
            'rdv' => $request->get('rdv'),
            'commentaire' => $request->get('commentaire'),


        ]);
        if ($request->get('interet')=='perdu') {
            $frein=Frein::create([
                'visite_id'=>$visite->id,
                'type_frein' => $request->get('frein'),
                'projet_id' => $projet_id,
                'tranche_id' =>  $request->get('frein_tranche_id'),
                'etage' =>  $request->get('frein_niveau'),
                'orientation' =>  $request->get('frein_orientation'),
                'avance' =>  $request->get('frein_avance'),
                'prix_min' =>  $request->get('frein_prix_min'),
                'prix_max' =>  $request->get('frein_prix_max'),
                'superficie_min' =>  $request->get('frein_superficie_min'),
                'superficie_max' =>  $request->get('frein_superficie_max'),
            ]);
        }
        if ($request->get('interet')=='intéressé' && $request->get('statut')=='pré-réservé') {
            $bien=Bien::find($request->get('bien_id'));
            $bien->update([
                'etat'=>'pre-reserve'
            ]);
        }
        if ($request->get('interet')=='intéressé' && $request->get('statut')=='vendu') {
            $bien=Bien::find($request->get('bien_id'));
            $bien->update([
                'etat'=>'reserve'
            ]);
        }
        if ($visite) {

            return redirect('/projets/'.$projet_id.'/visites');


        }
    }

     public function detail_visite($id)
    {
        $page='Visite';
        $visite=Visite::find($id);
        $projet=Projet::find($visite->projet_id);
        $user=User::find($visite->cc_id);
        $partenaires=DB::table('partenaire')->get();
        $bien=Bien::find($visite->bien_id);
        if ($visite->interet=='perdu') {
            $frein=DB::table('frein')->where('visite_id', $id)->get();
            foreach ($frein as $fr) {
               $tranche=Tranche::find($fr->tranche_id);
            }
            return view('visites/detail_visite', compact('page', 'visite', 'projet', 'user', 'partenaires', 'bien', 'frein', 'tranche'));
        }
        else{
            return view('visites/detail_visite', compact('page', 'visite', 'projet', 'user', 'partenaires', 'bien'));
        }


    }


    public function modifier_visite($projet_id,$id)
    {

        $page='Modifier Visite';
        $partenaires=DB::table('partenaire')->get();
        $visite=Visite::find($id);
        $projet=Projet::find($projet_id);
        $tranches=DB::table('tranche')->where('projet_id', $projet_id)->get();
        $bien=Bien::find($visite->bien_id);
        $frein=DB::table('frein')->where('visite_id', $id)->get();

        return view('/visites/modifier_visite', compact('visite','partenaires','projet' ,'bien','tranches','frein','page'));

    }





    public function edit(Request $request,$projet_id, $id){

        $visite=Visite::find($id);
        if($visite->statut=='pré-réservé'|| $visite->statut=='vendu'){
            $oldBien=Bien::find($visite->bien_id);
            if($oldBien->etat=='pre-reserve' || $oldBien->etat=='reserve'){
                $bien=Bien::find($oldBien->id);
                $bien->update([
                    'etat'=>'disponible'
                ]);
            }
        }
            

        $visite->update([
            
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'telephone' => $request->get('telephone'),
            'cin' => $request->get('cin'),
            'source' => $request->get('source'),
            'partenaire_id' => $request->get('partenaire_id'),
            'interet' => $request->get('interet'),
            'frein' => $request->get('frein'),
            'projet_id' => $projet_id,
            'bien_id' => $request->get('bien_id'),
            'statut' => $request->get('statut'),
            'mode_relance' => $request->get('mode_relance'),
            'prochaine_relance' => $request->get('prochaine_relance'),
            'rdv' => $request->get('rdv'),
            'commentaire' => $request->get('commentaire'),


        ]);

        $countFrein=DB::table('frein')->where('visite_id', $id)->count();
        print_r($countFrein);
        if($countFrein!=0){
            $frein=DB::table('frein')->where('visite_id', $id)->get();
            $fr_id='';
            foreach ($frein as $fre) {
                $fr_id=$fre->id;
            }
            $fr=Frein::find($fr_id);
            print_r('frein not null');
            if($request->get('interet')=='perdu'){
                
                    
                    $fr-> update([
                        'type_frein' => $request->get('frein'),
                        'projet_id' => $projet_id,
                        'tranche_id' =>  $request->get('frein_tranche_id'),
                        'etage' =>  $request->get('frein_niveau'),
                        'orientation' =>  $request->get('frein_orientation'),
                        'avance' =>  $request->get('frein_avance'),
                        'prix_min' =>  $request->get('frein_prix_min'),
                        'prix_max' =>  $request->get('frein_prix_max'),
                        'superficie_min' =>  $request->get('frein_superficie_min'),
                        'superficie_max' =>  $request->get('frein_superficie_max'),
                    ]);
                

            }else{
                $fr->delete();
                
                
            }
        }elseif($countFrein==0){

            print_r('frein null');
           if($request->get('interet')=='perdu'){
                $frein2=Frein::create([
                    'visite_id'=>$id,
                    'type_frein' => $request->get('frein'),
                    'projet_id' => $projet_id,
                    'tranche_id' =>  $request->get('frein_tranche_id'),
                    'etage' =>  $request->get('frein_niveau'),
                    'orientation' =>  $request->get('frein_orientation'),
                    'avance' =>  $request->get('frein_avance'),
                    'prix_min' =>  $request->get('frein_prix_min'),
                    'prix_max' =>  $request->get('frein_prix_max'),
                    'superficie_min' =>  $request->get('frein_superficie_min'),
                    'superficie_max' =>  $request->get('frein_superficie_max'),
                ]);
            } 
        }
        


        if ($request->get('interet')=='intéressé' && $request->get('statut')=='pré-réservé') {
            $bien=Bien::find($request->get('bien_id'));
            $bien->update([
                'etat'=>'pre-reserve'
            ]);
        }
        if ($request->get('interet')=='intéressé' && $request->get('statut')=='vendu') {
            $bien=Bien::find($request->get('bien_id'));
            $bien->update([
                'etat'=>'reserve'
            ]);
        }
        if ($visite) {

            /*return redirect('/projets/'.$projet_id.'/visites');*/


        }

    }


    public function destroy($id)
    {
        $visite=Visite::find($id);
        $projet=Projet::find($visite->projet_id);
        $frein=DB::table('frein')->where('visite_id', $id)->get();
        $fr_id='';
        foreach ($frein as $fr) {
            $fr_id=$fr->id;
        }
        $fr=Frein::find($fr_id);
        
        
        if($fr->delete() && $visite->delete()){
            $visites=DB::table('visite')->get();
            $page='visites';
            return redirect('/projets/'.$projet->id.'/visites')->with('visites', 'page');
        }
    }

    public function searchVisite (Request $request)
    {

        if($request->ajax()){
            $output="";
            $users=DB::table('users')->get();
            $biens=DB::table('bien')->get();
            $visites=DB::table('visite')
                ->where('nom','LIKE','%'.$request->search."%")
                ->orWhere('prenom','LIKE','%'.$request->search."%")
                ->get();
            if($visites){
                foreach ($visites as $visit) {
                    $output.='<tr>';
                    foreach($users as $user){
                        if($user->id==$visit->cc_id)
                            $output.='<td>'.$user->name.$user->prenom. '</td>';
                                                            }
                    $output.='<td>'.$visit->date.'</td>';
                    $output.='<td>'.$visit->nom.'</td>';
                    $output.='<td>'.$visit->prenom.'</td>';
                    $output.='<td>'.$visit->telephone.'</td>';
                    $output.='<td>'.$visit->source.'</td>';
                    $output.='<td>'.$visit->interet.'</td>';
                    foreach($biens as $bien){
                        if($bien->id==$visit->bien_id)
                            $output.='<td>'.$bien->propriete_dite_bien. '</td>';
                    }
                    $output.='<td>'.$visit->statut.'</td>';
                    $output.='<td>'.$visit->prochaine_relance.'</td>';
                    $output.='<td>'.$visit->interet.'</td>';


                    $output.='<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/visites/detail/'.$visit->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/visites/modifier_visite/'.$visit->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteVisite'.$visit->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.

                        '</tr>';
                }
                return $output;
            }

        }


    }










}
