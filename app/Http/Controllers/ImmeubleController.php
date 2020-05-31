<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use App\Tranche;
use App\Bloc;
use App\Immeuble;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class ImmeubleController extends Controller
{
   public function index()
    {
        $page='Immeubles';
        $immeubles=DB::table('Immeuble')->get();
        $blocs=DB::table('Bloc')->get();
        $tranches=DB::table('Tranche')->get();
        $projets=DB::table('Projet')->get();
        return view('/immeubles/immeubles', compact('immeubles','blocs', 'projets', 'tranches', 'page'));
    }

    public function getImmeubleByProjet($projet_id){
        $immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();
        $projet=Projet::find($projet_id);
        $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
        $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
        $page='Immeubles de '.$projet->nom;


        return view('/immeubles/immeubles', compact('page', 'immeubles', 'projet', 'tranches', 'blocs'));
    }


    public function getImmeubleByTranche($tranche_id){
        $tranche=Tranche::find($tranche_id);
        $projet=Projet::find($tranche->projet_id);
        $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
        $immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();
        $page='Immeubles de '.$tranche->description;


        return view('/immeubles/immeubles', compact('page', 'projet', 'tranche', 'blocs', 'immeubles'));
    }

	public function getImmeubleByBloc($bloc_id){
	    $bloc=Bloc::find($bloc_id);
	    $tranche=Tranche::find($bloc->tranche_id);
        $projet=Projet::find($bloc->projet_id);
	    $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();
	    $page='Immeubles de '.$bloc->description;


	    return view('/immeubles/immeubles', compact('page', 'projet', 'tranche', 'bloc', 'immeubles'));
	}



    public function ajouterImmeubleByProjet($projet_id)
    {
        $page='Nouvel Immeuble';
        $projet=Projet::find($projet_id);
		$tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();



        return view('/immeubles/ajouter_immeuble', compact('page','projet', 'tranches' ));
    }
    public function storeByProjet(Request $request, $projet_id){
        $validatedData = $request->validate([
            'description' => 'required|unique:immeuble,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez renseigné  existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                'bloc_id.required' => 'Veuillez choisir un bloc',
                

            ]

        );
        $immeuble=Immeuble::create([
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($immeuble){
            $projet=Projet::find($projet_id);
            $page='Immeubles de '.$projet->nom;
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
        	$immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();

            return redirect('/projets/'.$projet_id.'/immeubles')->with('projet','tranches', 'blocs', 'immeubles', 'page');
        }
    }


    public function ajouterImmeubleByTranche($tranche_id)
    {
        $page='Nouvel Immeuble';
        $tranche=Tranche::find($tranche_id);
        $proj=Projet::find($tranche->projet_id);
		$blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();

        return view('/immeubles/ajouter_immeuble', compact('page','proj', 'tranche', 'blocs' ));
    }
    public function storeByTranche(Request $request, $tranche_id){
        $validatedData = $request->validate([
            'description' => 'required|unique:immeuble,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez renseigné  existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                'bloc_id.required' => 'Veuillez choisir un bloc',
                

            ]

        );
        $immeuble=Immeuble::create([
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($immeuble){
            $tranche=Tranche::find($tranche_id);
            $page='Immeubles de '.$tranche->description;
            $proj=Projet::find($tranche->projet_id);
            $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
        	$immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();

            return redirect('/tranches/'.$tranche_id.'/immeubles')->with('proj','tranche', 'blocs', 'immeubles', 'page');
        }
    }

    public function ajouterImmeubleByBloc($bloc_id)
    {
        $page='Nouvel Immeuble';
        $bloc=Bloc::find($bloc_id);
        $tr=Tranche::find($bloc->tranche_id);
        $proj=Projet::find($bloc->projet_id);

        return view('/immeubles/ajouter_immeuble', compact('page','proj', 'tr', 'bloc' ));
    }
    public function storeByBloc(Request $request, $bloc_id){
        $validatedData = $request->validate([
            'description' => 'required|unique:immeuble,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez renseigné  existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                'bloc_id.required' => 'Veuillez choisir un bloc',
                

            ]

        );
        $immeuble=Immeuble::create([
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($immeuble){
            $bloc=Bloc::find($bloc_id);
            $tranche=Tranche::find($bloc->tranche_id);
            $projet=Projet::find($bloc->projet_id);
            $page='Immeubles de '.$bloc->description;
            $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();

            return redirect('/blocs/detail/'.$bloc_id)->with('projet','tranche', 'bloc', 'immeubles', 'page');
        }
    }

    public function ajouterImmeuble()
    {
        $page='Nouvel Immeuble';
        $projets=DB::table('Projet')->get();

        return view('/immeubles/ajouter_immeuble', compact('page','projets' ));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'description' => 'required|unique:immeuble,description',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            

        ],
            [
                'description.required' => 'Veuillez renseigner une description',
                'description.unique' => 'La description  que vous avez renseigné  existe dèjà',
                'projet_id.required' => 'Veuillez choisir un projet',
                'tranche_id.required' => 'Veuillez choisir une tranche',
                'bloc_id.required' => 'Veuillez choisir un bloc',
                

            ]

        );
        $immeuble=Immeuble::create([
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'description'=>$request->get('description'),
            'titre_foncier'=>$request->get('titre_foncier'),

        ]);
        if($immeuble){
            $immeubles=DB::table('Immeuble')->get();
	        $blocs=DB::table('Bloc')->get();
	        $tranches=DB::table('Tranche')->get();
	        $projets=DB::table('Projet')->get();
        	$page='Immeubles';
            return redirect('/immeubles')->with('projets','tranches', 'blocs', 'immeubles', 'page');
        }
    }

    public function detail_immeuble($id)
    {

        $immeuble=Immeuble::find($id);
        $page=$immeuble->description;
        $bloc=Bloc::find($immeuble->bloc_id);
        $tranche=Tranche::find($immeuble->tranche_id);
        $projet=Projet::find($immeuble->projet_id);
        $biens=DB::table('Bien')->where('immeuble_id', $id)->get();
        $nbre_biens = DB::table('bien')->where('immeuble_id',$id)->count();


        return view('/immeubles/detail_immeuble', compact('tranche', 'projet', 'page', 'bloc', 'immeuble', 'biens','nbre_biens'));
    }


    public function modifierImmeuble($id)
    {
        $page='Modifier Immeuble';
        $immeuble=Immeuble::find($id);
        $bloc=Bloc::find($immeuble->bloc_id);
        $tranche=Tranche::find($immeuble->tranche_id);
        $projet=Projet::find($immeuble->projet_id);

        return view('/immeubles/modifier_immeuble', compact('immeuble', 'tranche', 'projet', 'bloc', 'page'));
    }

    public function edit(Request $request, $id){

        $immeuble=Immeuble::find($id);
        $immeuble->update([
            'description'=>$request->get('description'),
            'projet_id'=>$request->get('projet_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'bloc_id'=>$request->get('bloc_id'),
            'titre_foncier'=>$request->get('titre_foncier'),

       ]);
        $bloc_id=$request->get('bloc_id');
        $page='Immeubles';
        $immeubles=DB::table('Immeuble')->get();
        $bloc=Bloc::find($bloc_id);
        $tranche=Tranche::find($bloc->tranche_id);
        $projet=Projet::find($bloc->projet_id);
        return redirect('/blocs/'.$bloc_id.'/immeubles')->with('immeubles','bloc','projet', 'tranche', 'page');


    }


    public function destroyByProjet($projet_id, $immeuble_id)
    {
        $immeuble=Immeuble::find($immeuble_id);
        $description=$immeuble->description;
        $biens=DB::table('bien')->where('immeuble_id', $immeuble_id)->delete();
        
        if($immeuble->delete()){
            $delete_msg="l'immeuble ".$description." a été supprimé avec succès";
            $projet=Projet::find($projet_id);
            $page='Immeubles de '.$projet->description;
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
            $immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();

            return redirect('/projets/'.$projet_id.'/immeubles')->with('page', 'blocs', 'tranches', 'projet',  'immeubles', 'delete_msg');
        }

    }
    public function destroyByTranche($tranche_id, $immeuble_id)
    {
        $immeuble=Immeuble::find($immeuble_id);
        $description=$immeuble->description;
        $biens=DB::table('bien')->where('immeuble_id', $immeuble_id)->delete();
        
        if($immeuble->delete()){
            $delete_msg="l'immeuble ".$description." a été supprimé avec succès";
            $tranche=Tranche::find($tranche_id);
            $projet=Projet::find($tranche->projet_id);
            $page='Immeubles de '.$tranche->description;
           	$blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
            $immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();

            return redirect('/tranches/'.$tranche_id.'/immeubles')->with('page', 'blocs', 'tranche', 'projet',  'immeubles', 'delete_msg');
        }

    }

    public function destroyByBloc($bloc_id, $immeuble_id)
    {
        $immeuble=Immeuble::find($immeuble_id);
        $description=$immeuble->description;
         $biens=DB::table('bien')->where('immeuble_id', $immeuble_id)->delete();
        
        if($immeuble->delete()){
            $delete_msg="l'immeuble ".$description." a été supprimé avec succès";
            $bloc=Bloc::find($bloc_id);
            $tranche=Tranche::find($bloc->tranche_id);
            $projet=Projet::find($bloc->projet_id);
            $page='Immeubles de '.$bloc->description;
            $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();
            return redirect('/blocs/detail/'.$bloc_id)->with('page', 'bloc', 'tranche', 'projet',  'immeubles', 'delete_msg');
        }

    }
    public function destroy($id)
    {
        $immeuble=Immeuble::find($id);
        $description=$immeuble->description;
        $biens=DB::table('bien')->where('immeuble_id', $immeuble_id)->delete();
        
        if($immeuble->delete()){
            $delete_msg="l'immeuble ".$description." a été supprimé avec succès";
            $page='Immeubles';
            $immeubles=DB::table('Immeuble')->get();

            return redirect('/immeubles')->with('page', 'immeubles', 'delete_msg');
        }

    }

    public function getTranchesByProjetId(Request $request){
        $projet_id=$request->projet_id;
        $tranches=DB::table('tranche')
            ->where('projet_id',$projet_id)
            ->get();

            return response()->json($tranches);
    }
    public function getBlocsByTrancheId(Request $request){
        $tranche_id=$request->tranche_id;
        $blocs=DB::table('bloc')
            ->where('tranche_id',$tranche_id)
            ->get();

            return response()->json($blocs);
    }
    public function searchImmeuble (Request $request)
    {
        if($request->ajax()){
            $output="";
            $immeubles=DB::table('immeuble')
                ->where('description','LIKE','%'.$request->search."%")
                ->orWhere('titre_foncier','LIKE','%'.$request->search."%")
                ->get();
            $projets=DB::table('projet')->get();
            $tranches=DB::table('tranche')->get();
            $blocs=DB::table('bloc')->get();
            if($immeubles){
                foreach ($immeubles as $immeuble) {
                    $output.='<tr>';
                    $output.='<td>'.$immeuble->description.'</td>';
                    foreach ($projets as $projet) {
                        if ($projet->id==$immeuble->projet_id) {
                            $output.='<td>'.$projet->nom.'</td>';

                        }
                    }
                    foreach ($tranches as $tranche) {
                        if ($tranche->id==$immeuble->tranche_id) {
                            $output.='<td>'.$tranche->description.'</td>';

                        }
                    }
                    foreach ($blocs as $bloc) {
                        if ($bloc->id==$immeuble->bloc_id) {
                            $output.='<td>'.$bloc->description.'</td>';

                        }
                    }
                    $output.='<td>'.$immeuble->titre_foncier.'</td>'.
                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/immeubles/detail/'.$immeuble->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/immeubles/modifier_immeuble/'.$immeuble->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$immeuble->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;

            }
        }
    }

    











}
