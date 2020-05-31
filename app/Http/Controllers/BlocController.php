<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use App\Tranche;
use App\Bloc;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class BlocController extends Controller
{
    public function index()
    {
        $page='Blocs';
        $blocs=DB::table('Bloc')->get();
        $tranches=DB::table('Tranche')->get();
        $projets=DB::table('Projet')->get();
        return view('/blocs/blocs', compact('blocs', 'projets', 'tranches', 'page'));
    }

    public function getBlocByTranche($tranche_id){
    	$blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
		$tranche=Tranche::find($tranche_id);
        $projet=Projet::find($tranche->projet_id);
		$page='Blocs de '.$tranche->description;


        return view('/blocs/blocs', compact('page', 'blocs', 'projet', 'tranche'));
    }

    public function getBlocByProjet($projet_id){
        $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
        $projet=Projet::find($projet_id);
        $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
        $page='Blocs de '.$projet->nom;


        return view('/blocs/blocs', compact('page', 'blocs', 'projet', 'tranches'));
    }


    public function ajouterBloc()
    {
        $page='Nouveau Bloc';
        $tranches=DB::table('Tranche')->get();
        $projets=DB::table('Projet')->get();

        return view('/blocs/ajouter_bloc', compact('page', 'tranches', 'projets'));
    }
    public function ajouterBlocByTranche($tranche_id)
    {
        $page='Nouveau bloc';
        $tranche=Tranche::find($tranche_id);
        $proj=Projet::find($tranche->projet_id);

        return view('/blocs/ajouter_bloc', compact('page','proj', 'tranche' ));
    }

    public function ajouterBlocByProjet($projet_id)
    {
        $page='Nouveau bloc';
        $projet=Projet::find($projet_id);
        $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();

        return view('/blocs/ajouter_bloc', compact('page','projet', 'tranches' ));
    }

    public function storeByTranche(Request $request, $tranche_id){
       $validatedData = $request->validate([
            'description' => 'required|unique:bloc,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            
        ],
            [
                'description.required' => 'Veuillez saisir une description',
                'description.unique' => 'La description  que vous avez saisi existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                
            ]

        );
         $bloc=Bloc::create([
        	'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($bloc){
            $tranche=Tranche::find($tranche_id);
            $page=$tranche->description;
            $projet=Projet::find($tranche->projet_id);
            $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();

			return redirect('/tranches/detail/'.$tranche_id)->with('tranche', 'blocs', 'projet', 'page');
		}
    }
    public function storeByProjet(Request $request, $projet_id){
        $validatedData = $request->validate([
            'description' => 'required|unique:bloc,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            
        ],
            [
                'description.required' => 'Veuillez saisir une description',
                'description.unique' => 'La description  que vous avez saisi existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                
            ]

        );
        $bloc=Bloc::create([
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($bloc){
            $projet=Projet::find($projet_id);
            $page='Blocs de '.$projet->nom;
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();

            return redirect('/projets/'.$projet_id.'/blocs')->with('tranches', 'blocs', 'projet', 'page');
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'description' => 'required|unique:bloc,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            
        ],
            [
                'description.required' => 'Veuillez saisir une description',
                'description.unique' => 'La description  que vous avez saisi existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                
            ]

        );
        $bloc=Bloc::create([
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($bloc){
            $page='Blocs';
            $blocs=DB::table('Bloc')->get();
            $tranches=DB::table('Tranche')->get();
            $projets=DB::table('Projet')->get();

            return redirect('/blocs')->with('page', 'tranches', 'projet', 'blocs');
        }
    }

    public function detail_bloc($id)
    {

        $bloc=Bloc::find($id);
        $page=$bloc->description;
        $tranche=Tranche::find($bloc->tranche_id);
        $projet=Projet::find($bloc->projet_id);
        $immeubles=DB::table('Immeuble')->where('bloc_id', $id)->get();
        $nbre_immeubles = DB::table('immeuble')->where('bloc_id',$id)->count();
        $nbre_biens = DB::table('bien')->where('bloc_id',$id)->count();


        return view('/blocs/detail_bloc', compact('tranche', 'projet','nbre_immeubles','nbre_biens', 'page', 'bloc', 'immeubles'));
    }



    public function modifierBloc($id)
    {
        $page='Modifier Bloc';
        $bloc=Bloc::find($id);
        $tranche=Tranche::find($bloc->tranche_id);
        $projet=Projet::find($bloc->projet_id);

        return view('/blocs/modifier_bloc', compact('tranche', 'projet', 'bloc', 'page'));
    }





    public function edit(Request $request, $id){

        $bloc=Bloc::find($id);
        $bloc->update([
            'description'=>$request->get('description'),
            'projet_id'=>$request->get('projet_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'titre_foncier'=>$request->get('titre_foncier'),

       ]);
        $tranche_id=$request->get('tranche_id');
        $page='Blocs';
        $blocs=DB::table('Bloc')->get();
        $tranche=Tranche::find($tranche_id);
        $projet=Projet::find($tranche->projet_id);
        return redirect('/tranches/'.$tranche_id.'/blocs')->with('blocs','projet', 'tranche', 'page');


    }

    public function destroyByProjet($projet_id, $bloc_id)
    {
        $bloc=Bloc::find($bloc_id);
        $description=$bloc->description;
        $immeubles=DB::table('immeuble')->where('bloc_id', $bloc_id)->delete();
        $biens=DB::table('bien')->where('bloc_id', $bloc_id)->delete();
        
        if($bloc->delete()){
            $delete_msg='le bloc '.$description.' a été supprimé avec succès';
            $projet=Projet::find($projet_id);
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $page='Blocs de '.$projet->description;
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();

            return redirect('/projets/'.$projet_id.'/blocs')->with('page', 'blocs', 'tranches', 'projet', 'delete_msg');
        }

    }
    public function destroyByTranche($tranche_id, $bloc_id)
    {
        $bloc=Bloc::find($bloc_id);
        $description=$bloc->description;
        $immeubles=DB::table('immeuble')->where('bloc_id', $bloc_id)->delete();
        $biens=DB::table('bien')->where('bloc_id', $bloc_id)->delete();
        
        if($bloc->delete()){
            $delete_msg='le bloc '.$description.' a été supprimé avec succès';
            $tranche=Tranche::find($tranche_id);
            $projet=Projet::find($tranche->projet_id);
            $page='Blocs de '.$tranche->description;
            $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
            return redirect('/tranches/detail/'.$tranche_id)->with('page', 'blocs', 'tranche', 'projet', 'delete_msg');
        }

    }
    public function destroy($id)
    {
        $bloc=Bloc::find($id);
        $description=$bloc->description;
        $immeubles=DB::table('immeuble')->where('bloc_id', $bloc_id)->delete();
        $biens=DB::table('bien')->where('bloc_id', $bloc_id)->delete();
        
        if($bloc->delete()){
            $delete_msg='le bloc '.$description.' a été supprimé avec succès';
            $page='Tranches';
            $blocs=DB::table('Bloc')->get();

            return redirect('/blocs')->with('page', 'blocs', 'delete_msg');
        }

    }

    public function getTranchesByProjetId(Request $request){
        $projet_id=$request->projet_id;
        $tranches=DB::table('tranche')
            ->where('projet_id',$projet_id)
            ->get();

            return response()->json($tranches);
    }



    public function searchBloc (Request $request)
    {
        if($request->ajax()){
            $output="";
            $blocs=DB::table('bloc')
                ->where('description','LIKE','%'.$request->search."%")
                ->orWhere('titre_foncier','LIKE','%'.$request->search."%")
                ->get();
            $projets=DB::table('projet')->get();
            $tranches=DB::table('tranche')->get();
            if($blocs){
                foreach ($blocs as $bloc) {
                    $output.='<tr>';
                    $output.='<td>'.$bloc->description.'</td>';
                    foreach ($tranches as $tranche) {
                        if ($tranche->id==$bloc->tranche_id) {
                            $output.='<td>'.$tranche->description.'</td>';
                        }
                    }
                    foreach ($projets as $projet) {
                        if ($projet->id==$bloc->projet_id) {
                            $output.='<td>'.$projet->nom.'</td>';

                        }
                    }
                    $output.='<td>'.$bloc->titre_foncier.'</td>'.

                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/blocs/detail/'.$bloc->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/blocs/modifier_bloc/'.$bloc->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$bloc->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;

            }
        }
    }

    









}
