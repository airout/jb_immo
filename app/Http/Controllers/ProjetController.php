<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class ProjetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page='Projets';
        $projets=DB::table('Projet')->get();
        return view('/projets/projets', compact('projets', 'page'));
    }

    public function detail_projet($id)
    {

        $projet=Projet::find($id);
        $page=$projet->nom;
        $nbre_tranches = DB::table('tranche')->where('projet_id',$id)->count();
        $nbre_blocs = DB::table('bloc')->where('projet_id',$id)->count();
        $nbre_immeubles = DB::table('immeuble')->where('projet_id',$id)->count();
        $nbre_biens = DB::table('bien')->where('projet_id',$id)->count();
        return view('/projets/detail_projet', compact('projet','nbre_tranches','nbre_blocs','nbre_immeubles','nbre_biens', 'page'));
    }

    public function ajouterProjet()
    {
        $page='Nouveau Projet';
        return view('/projets/ajouter_projet', compact('page'));
    }
    public function modifierProjet($id)
    {
        $page='Modifier Projet';
        $projet=Projet::find($id);

        return view('/projets/modifier_projet', compact('projet', 'page'));
    }

    public function store(Request $request){
       
        $validatedData = $request->validate([
            'nom' => 'required|unique:projet,nom',
            'code'=>'required|unique:projet,code' ,
            'type'=>'required',
            'prolongation_reservation'=>'required',
            'limite_annulation_reservation'=>'required',
            'surface_terrain'=>'required',
            
        ],
            [
                'nom.required' => 'Veuillez renseigner le nom du projet',
                'nom.unique' => 'Le nom que vous avez saisi  existe déjà',
                'code.required' => 'Veuillez renseigner le code',
                'code.unique' => 'Le code que vous avez saisi  existe déjà',
                'type.required' => 'Veuillez choisir le type du projet',
                'prolongation_reservation.required' => 'Veuillez renseigner la prolongation de réservation',
                'limite_annulation_reservation.required' => 'Veuillez renseigner la limite d\'annulation de réservation',
                'surface_terrain.required' => 'Veuillez renseigner la surface du terrain',

            ]

        );
        $projet=Projet::create([
            'nom'=>$request->get('nom'),
            'code'=>$request->get('code'),
            'type'=>$request->get('type'),
            'date_autorisation_construction'=>$request->get('date_autorisation_construction'),
            'date_permis_habiter'=>$request->get('date_permis_habiter'),
            'prolongation_reservation'=>$request->get('prolongation_reservation'),
            'adresse'=>$request->get('adresse'),
            'limite_annulation_reservation'=>$request->get('limite_annulation_reservation'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'propriete_dite_projet'=>$request->get('propriete_dite_projet'),
            'surface_terrain'=>$request->get('surface_terrain'),
            'montant_min'=>$request->get('montant_min'),
            'nbre_jour_remboursement'=>$request->get('nbre_jour_remboursement'),


        ]);


        if($projet){
            $page='Projets';
            $projets=DB::table('Projet')->get();
            return redirect('/projets')->with('projets');

        }
    }

    public function edit(Request $request, $id){

        $projet=Projet::find($id);
        $projet->update([
            'nom'=>$request->get('nom'),
            'code'=>$request->get('code'),
            'type'=>$request->get('type'),
            'date_autorisation_construction'=>$request->get('date_autorisation_construction'),
            'date_permis_habiter'=>$request->get('date_permis_habiter'),
            'prolongation_reservation'=>$request->get('prolongation_reservation'),
            'limite_annulation_reservation'=>$request->get('limite_annulation_reservation'),
            'adresse'=>$request->get('adresse'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'propriete_dite_projet'=>$request->get('propriete_dite_projet'),
            'surface_terrain'=>$request->get('surface_terrain'),
            'montant_min'=>$request->get('montant_min'),
            'nbre_jour_remboursement'=>$request->get('nbre_jour_remboursement'),

       ]);

        $page='Projets';
        $projets=DB::table('Projet')->get();
        return redirect('/projets')->with('projets');


    }

    public function destroy($id)
    {
        $projet=Projet::find($id);
        $tranches=DB::table('tranche')->where('projet_id', $id)->delete();
        $blocs=DB::table('bloc')->where('projet_id', $id)->delete();
        $immeubles=DB::table('immeuble')->where('projet_id', $id)->delete();
        $biens=DB::table('bien')->where('projet_id', $id)->delete();
        $nom=$projet->nom;
            
            if($projet->delete()){
            
                $delete_msg='le projet '.$nom.' a été supprimé avec succès';
                $projets=DB::table('Projet')->get();
                return redirect('/projets')->with('projets', 'delete_msg');
            }

    }

    public function searchProjet(Request $request)
    {
        if($request->ajax()){
            $output="";
            $projets=DB::table('projet')
                ->where('nom','LIKE','%'.$request->search."%")
                ->orWhere('code','LIKE','%'.$request->search."%")
                ->orWhere('type','LIKE','%'.$request->search."%")
                ->orWhere('date_autorisation_construction','LIKE','%'.$request->search."%")
                ->orWhere('date_permis_habiter','LIKE','%'.$request->search."%")
                ->get();


            if($projets){
                foreach ($projets as $projet) {
                    $output.='<tr>';
                    $output.='<td>'.$projet->nom.'</td>'.
                        '<td>'.$projet->code.'</td>';
                    $output.='<td>'.$projet->type.'</td>'.
                        '<td>'.$projet->date_autorisation_construction.'</td>'.
                        '<td>'.$projet->date_permis_habiter.'</td>'.
                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/projets/detail/'.$projet->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/projets/modifier_projet/'.$projet->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$projet->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;

            }
        }
    }



















}
