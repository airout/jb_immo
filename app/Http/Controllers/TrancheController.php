<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use App\Tranche;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class TrancheController extends Controller
{
    public function index()
    {
        $page='Tranches';
        $tranches=DB::table('Tranche')->get();
        $projets=DB::table('Projet')->get();
        return view('/tranches/tranches', compact('tranches', 'projets', 'page'));
    }

    public function getTrancheByProjet($projet_id){
    	$projet=Projet::find($projet_id);
    	$page='Tranches de '.$projet->nom;
		$tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();

		return view('/tranches/tranches', compact('page', 'tranches', 'projet'));
    }
    public function ajouterTranche()
    {
        $page='Nouvelle Tranche';
        $projets=DB::table('Projet')->get();

        return view('/tranches/ajouter_tranche', compact('page', 'projets'));
    }
    public function ajouterTrancheByProjet($projet_id)
    {
        $page='Nouvelle Tranche';
        $projet=Projet::find($projet_id);
        return view('/tranches/ajouter_tranche', compact('page','projet' ));
    }

    public function storeByProjet(Request $request, $projet_id){
        $validatedData = $request->validate([
            'description' => 'required|unique:tranche,description',
            'projet_id'=>'required',
            'niveau_etages'=>'required',
            'date_livraison'=>'required',

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez saisi  existe déjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'niveau_etages.required' => 'Veuillez renseigner le niveau d\'étages',
                'date_livraison.required' => 'Veuillez renseigner une date de livraison'

            ]

        );

        $tranche=Tranche::create([
        	'projet_id'=>$projet_id,
            'description'=>$request->get('description'),
            'date_livraison'=>$request->get('date_livraison'),
            'niveau_etages'=>$request->get('niveau_etages'),

        ]);
        if($tranche){
            $projet=Projet::find($projet_id);
	    	$page='Tranches de '.$projet->nom;
			$tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();

			return redirect('/projets/'.$projet_id.'/tranches')->with('page', 'tranches', 'projet');
		}
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'description' => 'required|unique:tranche,description',
            'projet_id'=>'required',
            'niveau_etages'=>'required',
            'date_livraison'=>'required',

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez saisi  existe déjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'niveau_etages.required' => 'Veuillez renseigner le niveau d\'étages',
                'date_livraison.required' => 'Veuillez renseigner une date de livraison'

            ]

        );
        $tranche=Tranche::create([
            'projet_id'=>$request->get('projet_id') ,
            'description'=>$request->get('description'),
            'date_livraison'=>$request->get('date_livraison'),
            'niveau_etages'=>$request->get('niveau_etages'),

        ]);
        if($tranche){
            $page='Tranches';
            $tranches=DB::table('Tranche')->get();

            return redirect('/tranches')->with('page', 'tranches');
        }
    }

     public function detail_tranche($id)
    {

        $tranche=Tranche::find($id);
        $page=$tranche->description;
        $projet=Projet::find($tranche->projet_id);
        $blocs=DB::table('Bloc')->where('tranche_id', $id)->get();
        $nbre_blocs = DB::table('bloc')->where('tranche_id',$id)->count();
        $nbre_immeubles = DB::table('immeuble')->where('tranche_id',$id)->count();
        $nbre_biens = DB::table('bien')->where('tranche_id',$id)->count();
        
        return view('/tranches/detail_tranche', compact('projet','tranche', 'blocs', 'nbre_blocs','nbre_immeubles', 'nbre_biens', 'page'));
    }


    public function modifierTrancheByProjet($projet_id, $tranche_id)
    {
        $page='Modifier Tranche';
        $projet=Projet::find($projet_id);
        $tranche=Tranche::find($tranche_id);
        return view('/tranches/modifier_tranche', compact('projet', 'tranche', 'page'));
    }
    public function modifierTranche($id)
    {
        $page='Modifier Tranche';
        $tranche=Tranche::find($id);
        $projet=Projet::find($tranche->projet_id);
        $nom_projet=$projet->nom;
        $id_projet=$projet->id;
        return view('/tranches/modifier_tranche', compact('tranche', 'nom_projet', 'id_projet', 'page'));
    }



     public function editByProjet(Request $request, $projet_id, $tranche_id){

        $tranche=Tranche::find($tranche_id);
        $tranche->update([
            'description'=>$request->get('description'),
            'projet_id'=>$request->get('projet_id'),
            'niveau_etages'=>$request->get('niveau_etages'),
            'date_livraison'=>$request->get('date_livraison'),
       ]);

        $projet=Projet::find($projet_id);
        $page='Tranches de '.$projet->nom;
        $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();


        return redirect('/projets/'.$projet_id.'/tranches')->with('page', 'tranches', 'projet');


    }

    public function edit(Request $request, $id){

        $tranche=Tranche::find($id);
        $tranche->update([
            'description'=>$request->get('description'),
            'projet_id'=>$request->get('projet_id'),
            'niveau_etages'=>$request->get('niveau_etages'),
            'date_livraison'=>$request->get('date_livraison'),

       ]);

        $page='Tranches';
        $tranches=DB::table('Tranche')->get();
        return redirect('/tranches')->with('tranches', 'page');


    }


    public function destroyByProjet($projet_id, $tranche_id)
    {
        $tranche=Tranche::find($tranche_id);
        $description=$tranche->description;
        $blocs=DB::table('bloc')->where('tranche_id', $tranche_id)->delete();
        $immeubles=DB::table('immeuble')->where('tranche_id', $tranche_id)->delete();
        $biens=DB::table('bien')->where('tranche_id', $tranche_id)->delete();
        
        if($tranche->delete()){
            $delete_msg='la tranche '.$description.' a été supprimée avec succès';
            $projet=Projet::find($projet_id);
            $page='Tranches de '.$projet->nom;
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            return redirect('/projets/'.$projet_id.'/tranches')->with('page', 'tranches', 'projet', 'delete_msg');
        }

    }
    public function destroy($id)
    {
        $tranche=Tranche::find($id);
        $description=$tranche->description;
        $blocs=DB::table('bloc')->where('projet_id', $id)->delete();
        $immeubles=DB::table('immeuble')->where('projet_id', $id)->delete();
        $biens=DB::table('bien')->where('projet_id', $id)->delete();
        
        if($tranche->delete()){
            $delete_msg='la tranche '.$description.' a été supprimée avec succès';
            $page='Tranches';
            $tranches=DB::table('Tranche')->get();
            return redirect('/tranches')->with('page', 'tranches', 'delete_msg');
        }

    }


    public function searchTranche (Request $request)
    {
        if($request->ajax()){
            $output="";
            $tranches=DB::table('tranche')
                ->where('description','LIKE','%'.$request->search."%")
                ->orWhere('niveau_etages','LIKE','%'.$request->search."%")
                ->orWhere('date_livraison','LIKE','%'.$request->search."%")
                ->get();
            $projets=DB::table('projet')->get();
            if($tranches){
                foreach ($tranches as $tranche) {
                    $output.='<tr>';
                    $output.='<td>'.$tranche->description.'</td>';
                       foreach ($projets as $projet) {
                           if ($projet->id==$tranche->projet_id) {
                               $output.='<td>'.$projet->nom.'</td>';

                           }
                       }
                    $output.='<td>'.$tranche->niveau_etages.'</td>'.
                        '<td>'.$tranche->date_livraison.'</td>'.
                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/tranches/detail/'.$tranche->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/tranches/modifier_tranche/'.$tranche->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$tranche->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;

            }
        }
    }










}
