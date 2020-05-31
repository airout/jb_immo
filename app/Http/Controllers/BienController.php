<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use App\Tranche;
use App\Bloc;
use App\Immeuble;
use App\Bien;
use File;
use Image;
use DB;
class BienController extends Controller
{
    public function index()
    {
        $page='Biens';
        $biens=DB::table('Bien')->get();
        $immeubles=DB::table('Immeuble')->get();
        $blocs=DB::table('Bloc')->get();
        $tranches=DB::table('Tranche')->get();
        $projets=DB::table('Projet')->get();
        return view('/biens/biens', compact('biens', 'immeubles','blocs', 'projets', 'tranches', 'page'));
    }

    public function getBienByProjet($projet_id){
        $biens=DB::table('Bien')->where('projet_id', $projet_id)->get();
        $projet=Projet::find($projet_id);
        $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
        $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
        $immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();
        $page='Biens de '.$projet->nom;


        return view('/biens/biens', compact('page', 'projet', 'tranches', 'blocs','immeubles', 'biens' ));
    }


    public function getBienByTranche($tranche_id){
        $tranche=Tranche::find($tranche_id);
        $projet=Projet::find($tranche->projet_id);
        $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
        $immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();
        $biens=DB::table('Bien')->where('tranche_id', $tranche_id)->get();
        $page='Biens de '.$tranche->description;


        return view('/biens/biens', compact('page', 'projet', 'tranche', 'blocs', 'immeubles', 'biens'));
    }

	public function getBienByBloc($bloc_id){
	    $bloc=Bloc::find($bloc_id);
	    $tranche=Tranche::find($bloc->tranche_id);
        $projet=Projet::find($bloc->projet_id);
	    $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();
	    $biens=DB::table('Bien')->where('bloc_id', $bloc_id)->get();
        $page='Biens de '.$bloc->description;


	    return view('/biens/biens', compact('page', 'projet', 'tranche', 'bloc', 'immeubles', 'biens'));
	}

    public function getBienByImmeuble($immeuble_id){
        $immeuble=Immeuble::find($immeuble_id);
        $bloc=Bloc::find($immeuble->bloc_id);
        $tranche=Tranche::find($immeuble->tranche_id);
        $projet=Projet::find($immeuble->projet_id);
        $biens=DB::table('Bien')->where('immeuble_id', $immeuble_id)->get();
        $page='Biens de '.$immeuble->description;


        return view('/biens/biens', compact('page', 'projet', 'tranche', 'bloc', 'immeuble', 'biens'));
    }



    public function ajouterBienByProjet($projet_id)
    {
        $page='Nouveau Bien';
        $projet=Projet::find($projet_id);
		$tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();



        return view('/biens/ajouter_bien', compact('page','projet', 'tranches' ));
    }
    public function storeByProjet(Request $request, $projet_id){
        $validatedData = $request->validate([
            'propriete_dite_bien' => 'required|unique:bien,propriete_dite_bien',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            'immeuble_id'=>'required',
            'niveau'=>'required',
            'type'=>'required',
            'superficie'=>'required',
            'prix'=>'required',
            'orientation'=>'required',
            'avance_min'=>'required',


        ],
            [
                'propriete_dite_bien.required' => 'Veuillez saisir une propriété dite du bien',
                'propriete_dite_bien.unique' => 'La renseigner que vous avez saisi  existe dèjà',
                'projet_id.required'=>'Veuillez choisir un projet',
                'tranche_id.required'=>'Veuillez choisir une tranche',
                'bloc_id.required'=>'Veuillez choisir un bloc',
                'immeuble_id.required'=>'Veuillez choisir un immeuble',
                'niveau.required'=>'Veuillez choisir le niveau d\'etage',
                'type.required'=>'Veuillez choisir le type du bien',
                'superficie.required'=>'Veuillez renseigner la superficie',
                'prix.required'=>'Veuillez renseigner le prix',
                'orientation.required'=>'Veuillez choisir l\'orientation',
                'avance_min.required'=>'Veuillez renseigner une avance  minimale',

            ]

        );
        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien=Bien::create([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

        ]);
        if($bien){
            $biens=DB::table('Bien')->where('projet_id', $projet_id)->get();
            $projet=Projet::find($projet_id);
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
            $immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();
            $page='Biens de '.$projet->nom;


            return redirect('/projets/'.$projet_id.'/biens')->with('projet','tranches', 'blocs', 'immeubles', 'biens', 'page');
        }
    }


    public function ajouterBienByTranche($tranche_id)
    {
        $page='Nouveau Bien';
        $tranche=Tranche::find($tranche_id);
        $proj=Projet::find($tranche->projet_id);
		$blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();

        return view('/biens/ajouter_bien', compact('page','proj', 'tranche', 'blocs' ));
    }

    public function storeByTranche(Request $request, $tranche_id){
        $validatedData = $request->validate([
            'propriete_dite_bien' => 'required|unique:bien,propriete_dite_bien',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            'immeuble_id'=>'required',
            'niveau'=>'required',
            'type'=>'required',
            'superficie'=>'required',
            'prix'=>'required',
            'orientation'=>'required',
            'avance_min'=>'required',


        ],
            [
                'propriete_dite_bien.required' => 'Veuillez renseigner une propriété dite du bien',
                'propriete_dite_bien.unique' => 'La propriété que vous avez saisi  existe dèjà',
                'projet_id.required'=>'Veuillez choisir un projet',
                'tranche_id.required'=>'Veuillez choisir une tranche',
                'bloc_id.required'=>'Veuillez choisir un bloc',
                'immeuble_id.required'=>'Veuillez choisir un immeuble',
                'niveau.required'=>'Veuillez choisir le niveau d\'etage',
                'type.required'=>'Veuillez choisir le type du bien',
                'superficie.required'=>'Veuillez renseigner la superficie',
                'prix.required'=>'Veuillez renseigner le prix',
                'orientation.required'=>'Veuillez choisir l\'orientation',
                'avance_min.required'=>'Veuillez renseigner une avance  minimale',

            ]

        );
        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien=Bien::create([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

        ]);
        if($bien){
            $tranche=Tranche::find($tranche_id);
            $projet=Projet::find($tranche->projet_id);
            $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
            $immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();
            $biens=DB::table('Bien')->where('tranche_id', $tranche_id)->get();
            $page='Biens de '.$tranche->description;


            return redirect('/tranches/'.$tranche_id.'/biens')->with('projet','tranche', 'blocs', 'immeubles','biens', 'page');
        }
    }

    public function ajouterBienByBloc($bloc_id)
    {
        $page='Nouveau Bien';
        $bloc=Bloc::find($bloc_id);
        $tr=Tranche::find($bloc->tranche_id);
        $proj=Projet::find($bloc->projet_id);
        $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();

        return view('/biens/ajouter_bien', compact('page','proj', 'tr', 'bloc', 'immeubles' ));
    }
    public function storeByBloc(Request $request, $bloc_id){
        $validatedData = $request->validate([
            'propriete_dite_bien' => 'required|unique:bien,propriete_dite_bien',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            'immeuble_id'=>'required',
            'niveau'=>'required',
            'type'=>'required',
            'superficie'=>'required',
            'prix'=>'required',
            'orientation'=>'required',
            'avance_min'=>'required',


        ],
            [
                'propriete_dite_bien.required' => 'Veuillez renseigner une propriété dite du bien',
                'propriete_dite_bien.unique' => 'La propriété que vous avez saisi  existe dèjà',
                'projet_id.required'=>'Veuillez choisir un projet',
                'tranche_id.required'=>'Veuillez choisir une tranche',
                'bloc_id.required'=>'Veuillez choisir un bloc',
                'immeuble_id.required'=>'Veuillez choisir un immeuble',
                'niveau.required'=>'Veuillez choisir le niveau d\'etage',
                'type.required'=>'Veuillez choisir le type du bien',
                'superficie.required'=>'Veuillez renseigner la superficie',
                'prix.required'=>'Veuillez renseigner le prix',
                'orientation.required'=>'Veuillez choisir l\'orientation',
                'avance_min.required'=>'Veuillez renseigner une avance  minimale',

            ]

        );
        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien=Bien::create([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

        ]);
        if($bien){
            $bloc=Bloc::find($bloc_id);
            $tranche=Tranche::find($bloc->tranche_id);
            $projet=Projet::find($bloc->projet_id);
            $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();
            $biens=DB::table('Bien')->where('bloc_id', $bloc_id)->get();
            $page='Biens de '.$bloc->description;


            return redirect('/blocs/'.$bloc_id.'/biens')->with('page', 'projet', 'tranche', 'bloc', 'immeubles', 'biens');
        }
    }

    public function ajouterBienByImmeuble($immeuble_id)
    {
        $page='Nouveau Bien';
        $immeuble=Immeuble::find($immeuble_id);
        $blc=Bloc::find($immeuble->bloc_id);
        $tr=Tranche::find($immeuble->tranche_id);
        $proj=Projet::find($immeuble->projet_id);

        return view('/biens/ajouter_bien', compact('page','proj', 'tr', 'blc', 'immeuble' ));
    }

    public function storeByImmeuble(Request $request, $immeuble_id){
        $validatedData = $request->validate([
            'propriete_dite_bien' => 'required|unique:bien,propriete_dite_bien',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            'immeuble_id'=>'required',
            'niveau'=>'required',
            'type'=>'required',
            'superficie'=>'required',
            'prix'=>'required',
            'orientation'=>'required',
            'avance_min'=>'required',


        ],
            [
                'propriete_dite_bien.required' => 'Veuillez renseigner la propriété dite du bien',
                'propriete_dite_bien.unique' => 'La propriété que vous avez saisi  existe dèjà',
                'projet_id.required'=>'Veuillez choisir un projet',
                'tranche_id.required'=>'Veuillez choisir une tranche',
                'bloc_id.required'=>'Veuillez choisir un bloc',
                'immeuble_id.required'=>'Veuillez choisir un immeuble',
                'niveau.required'=>'Veuillez choisir le niveau d\'etage',
                'type.required'=>'Veuillez choisir le type du bien',
                'superficie.required'=>'Veuillez renseigner la superficie',
                'prix.required'=>'Veuillez renseigner le prix',
                'orientation.required'=>'Veuillez choisir l\'orientation',
                'avance_min.required'=>'Veuillez renseigner une avance  minimale',

            ]

        );

        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien=Bien::create([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

        ]);
        if($bien){
            $immeuble=Immeuble::find($immeuble_id);
            $bloc=Bloc::find($immeuble->bloc_id);
            $tranche=Tranche::find($immeuble->tranche_id);
            $projet=Projet::find($immeuble->projet_id);
            $biens=DB::table('Bien')->where('immeuble_id', $immeuble_id)->get();
            $page='Biens de '.$immeuble->description;


            return redirect('/immeubles/'.$immeuble_id.'/biens')->with('page', 'projet', 'tranche', 'bloc', 'immeuble', 'biens');
        }
    }

    public function ajouterBien()
    {
        $page='Nouveau Bien';
        $projets=DB::table('Projet')->get();

        return view('/biens/ajouter_bien', compact('page','projets' ));
    }
     public function store(Request $request){
        $validatedData = $request->validate([
            'propriete_dite_bien' => 'required|unique:bien,propriete_dite_bien',
            'projet_id'=>'required',
            'tranche_id'=>'required',
            'bloc_id'=>'required',
            'immeuble_id'=>'required',
            'niveau'=>'required',
            'type'=>'required',
            'superficie'=>'required',
            'prix'=>'required',
            'orientation'=>'required',
            'avance_min'=>'required',


        ],
            [
                'propriete_dite_bien.required' => 'Veuillez renseigner une propriété dite du bien',
                'propriete_dite_bien.unique' => 'La propriété que vous avez saisi  existe dèjà',
                'projet_id.required'=>'Veuillez choisir un projet',
                'tranche_id.required'=>'Veuillez choisir une tranche',
                'bloc_id.required'=>'Veuillez choisir un bloc',
                'immeuble_id.required'=>'Veuillez choisir un immeuble',
                'niveau.required'=>'Veuillez choisir le niveau d\'etage',
                'type.required'=>'Veuillez choisir le type du bien',
                'superficie.required'=>'Veuillez renseigner la superficie',
                'prix.required'=>'Veuillez renseigner le prix',
                'orientation.required'=>'Veuillez choisir l\'orientation',
                'avance_min.required'=>'Veuillez renseigner une avance  minimale',

            ]

        );

        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien=Bien::create([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

        ]);
        if($bien){
            $page='Biens';
            $biens=DB::table('Bien')->get();
            $immeubles=DB::table('Immeuble')->get();
            $blocs=DB::table('Bloc')->get();
            $tranches=DB::table('Tranche')->get();
            $projets=DB::table('Projet')->get();


            return redirect('/biens')->with('page', 'projets', 'tranches', 'blocs', 'immeubles', 'biens');
        }
    }

    public function detail_bien($id)
    {

        $bien=Bien::find($id);
        $page=$bien->propriete_dite_bien;
        $immeuble=Immeuble::find($bien->immeuble_id);
        $bloc=Bloc::find($bien->bloc_id);
        $tranche=Tranche::find($bien->tranche_id);
        $projet=Projet::find($bien->projet_id);


        return view('/biens/detail_bien', compact('tranche', 'projet', 'page', 'bloc', 'immeuble', 'bien'));
    }


    public function modifierBien($id)
    {
        $page='Modifier Bien';
        $bien=Bien::find($id);
        $immeuble=Immeuble::find($bien->immeuble_id);
        $bloc=Bloc::find($bien->bloc_id);
        $tranche=Tranche::find($bien->tranche_id);
        $projet=Projet::find($bien->projet_id);

        return view('/biens/modifier_bien', compact('immeuble', 'tranche', 'projet', 'bloc', 'bien', 'page'));
    }

    public function edit(Request $request, $id){

        $bien=Bien::find($id);
        if ($request->get('conventionne')!=null) {
           $conventionne=1;
        }
        else{
            $conventionne=0;
        }
        if ($request->get('commentaire')!=null) {
           $commentaire=$request->get('commentaire');
        }
        else{
            $commentaire='';
        }
        $bien->update([
            'propriete_dite_bien'=>$request->get('propriete_dite_bien'),
            'numero'=>$request->get('numero'),
            'niveau'=>$request->get('niveau'),
            'etat'=>'disponible',
            'type'=>$request->get('type'),
            'orientation'=>$request->get('orientation'),
            'conventionne'=>$conventionne,
            'prix'=>$request->get('prix'),
            'superficie'=>$request->get('superficie'),
            'bloc_id'=>$request->get('bloc_id'),
            'tranche_id'=>$request->get('tranche_id'),
            'projet_id'=>$request->get('projet_id'),
            'immeuble_id'=>$request->get('immeuble_id'),
            'titre_foncier'=>$request->get('titre_foncier'),
            'avance_min'=>$request->get('avance_min'),
            'commentaire'=>$commentaire,

       ]);
        $immeuble_id=$request->get('immeuble_id');
        $page='Biens';
        $biens=DB::table('Bien')->get();
        $immeuble=Immeuble::find($immeuble_id);
        $bloc=Bloc::find($immeuble->bloc_id);
        $tranche=Tranche::find($immeuble->tranche_id);
        $projet=Projet::find($immeuble->projet_id);
        return redirect('/immeubles/'.$immeuble_id.'/biens')->with('biens', 'immeuble','bloc','projet', 'tranche', 'page');


    }

    public function destroyByProjet($projet_id, $bien_id)
    {
        $bien=Bien::find($bien_id);
        $description=$bien->propriete_dite_bien;
        if($bien->delete()){
            $delete_msg="le bien ".$description." a été supprimé avec succès";
            $projet=Projet::find($projet_id);
            $page='biens de '.$projet->description;
            $tranches=DB::table('Tranche')->where('projet_id', $projet_id)->get();
            $blocs=DB::table('Bloc')->where('projet_id', $projet_id)->get();
            $immeubles=DB::table('Immeuble')->where('projet_id', $projet_id)->get();
            $biens=DB::table('Bien')->where('projet_id', $projet_id)->get();

            return redirect('/projets/'.$projet->id.'/biens')->with('page', 'blocs', 'tranches', 'projet',  'immeubles', 'biens', 'delete_msg');
        }

    }
    public function destroyByTranche($tranche_id, $bien_id)
    {
        $bien=Bien::find($bien_id);
        $description=$bien->propriete_dite_bien;
        if($bien->delete()){
            $delete_msg="le bien ".$description." a été supprimé avec succès";
            $tranche=Tranche::find($tranche_id);
            $projet=Projet::find($tranche->projet_id);
            $page='Biens de '.$tranche->description;
            $blocs=DB::table('Bloc')->where('tranche_id', $tranche_id)->get();
            $immeubles=DB::table('Immeuble')->where('tranche_id', $tranche_id)->get();
            $biens=DB::table('Bien')->where('tranche_id', $tranche_id)->get();

            return redirect('/tranches/'.$tranche_id.'/biens')->with('page', 'blocs', 'tranche', 'projet',  'immeubles', 'biens', 'delete_msg');
        }

    }


    public function destroyByBloc($bloc_id, $bien_id)
    {
       $bien=Bien::find($bien_id);
        $description=$bien->propriete_dite_bien;
        if($bien->delete()){
            $delete_msg="le bien ".$description." a été supprimé avec succès";
            $bloc=Bloc::find($bloc_id);
            $tranche=Tranche::find($bloc->tranche_id);
            $projet=Projet::find($bloc->projet_id);
            $page='biens de '.$bloc->description;
            $immeubles=DB::table('Immeuble')->where('bloc_id', $bloc_id)->get();
            $biens=DB::table('Bien')->where('bloc_id', $bloc_id)->get();

            return redirect('/blocs/'.$bloc_id.'/biens')->with('page', 'bloc', 'tranche', 'projet',  'immeubles', 'biens', 'delete_msg');
        }

    }
    public function destroyByImmeuble($immeuble_id, $bien_id)
    {
        $bien=Bien::find($bien_id);
        $description=$bien->propriete_dite_bien;
        if($bien->delete()){
            $delete_msg="le bien ".$description." a été supprimé avec succès";
            $immeuble=Immeuble::find($immeuble_id);
            $bloc=Bloc::find($immeuble->bloc_id);
            $tranche=Tranche::find($immeuble->tranche_id);
            $projet=Projet::find($immeuble->projet_id);
            $page='Biens de '.$tranche->description;
            $biens=DB::table('Bien')->where('immeuble_id', $immeuble_id)->get();

            return redirect('/immeubles/'.$immeuble_id.'/biens')->with('page', 'bloc', 'tranche', 'projet',  'immeuble', 'biens', 'delete_msg');
        }

    }
    public function destroy($id)
    {
        $bien=Bien::find($id);
        $description=$bien->propriete_dite_bien;
        if($bien->delete()){
            $delete_msg="le bien ".$description." a été supprimé avec succès";
            $page='Biens';
            $biens=DB::table('Bien')->get();

            return redirect('/biens')->with('page', 'immeubles', 'delete_msg');
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
    public function getImmeublesByBlocId(Request $request){
        $bloc_id=$request->bloc_id;
        $immeubles=DB::table('immeuble')
            ->where('bloc_id',$bloc_id)
            ->get();

            return response()->json($immeubles);
    }
    public function getNiveauByTrancheId(Request $request){
        $tranche_id=$request->tranche_id;
        $tranche=Tranche::find($tranche_id);

            return response()->json($tranche);
    }
    public function getBiensDispoByImmeubleId(Request $request){
        $immeuble_id=$request->immeuble_id;

        $biens=DB::table('bien')
            ->where('etat','disponible')
            ->where('immeuble_id',$immeuble_id)
            ->get();

            return response()->json($biens);
    }
    public function getBiensDispoByTrancheId(Request $request){
        $tranche_id=$request->tranche_id;
       $biens=DB::table('bien')
            ->where('etat','disponible')
            ->where('tranche_id',$tranche_id)
            ->get();

           return response()->json($biens);
    }

    public function getPrixByBienId(Request $request){
        $bien_id=$request->bien_id;
        $bien=Bien::find($bien_id);
        $prix=$bien->prix;
          return response()->json($prix);
    }

    public function searchBien(Request $request)
    {
        if($request->ajax()){
            $output="";
            $biens=DB::table('bien')
                ->where('propriete_dite_bien','LIKE','%'.$request->search."%")
                ->orWhere('niveau','LIKE','%'.$request->search."%")
                ->orWhere('prix','LIKE','%'.$request->search."%")
                ->orWhere('type','LIKE','%'.$request->search."%")
                ->orWhere('numero','LIKE','%'.$request->search."%")
                ->get();
            $projets=DB::table('projet')->get();
            $tranches=DB::table('tranche')->get();
            $blocs=DB::table('bloc')->get();
            $immeubles=DB::table('immeuble')->get();
            if($biens){
                foreach ($biens as $bien) {
                    $output.='<tr>';
                    if($bien->etat=='disponible'){
                        $output.='<td><i class="nav-icon fas fa-circle text-success"></i></td>';

                    }
                    elseif($bien->etat=='pre-reserve'){
                        $output.='<td><i class="nav-icon fas fa-circle text-orange"></i></td>';
                    }
                    elseif($bien->etat=='reserve'){
                        $output.='<td><i class="nav-icon fas fa-circle text-warning "></i></td>';
                    }
                    elseif($bien->etat=='bloque'){
                        $output.='<td><i class="nav-icon fas fa-circle text-danger"></i></td>';
                    }
                    elseif($bien->etat=='livre'){
                        $output.='<td><i class="nav-icon fas fa-circle text-default"></i></td>';
                    }

                    $output.='<td>'.$bien->propriete_dite_bien.'</td>'.
                        '<td>'.$bien->niveau.'</td>';
                    foreach ($projets as $projet) {
                        if ($projet->id==$bien->projet_id) {
                            $output.='<td>'.$projet->nom.'</td>';

                        }
                    }
                    foreach ($tranches as $tranche) {
                        if ($tranche->id==$bien->tranche_id) {
                            $output.='<td>'.$tranche->description.'</td>';

                        }
                    }
                    foreach ($blocs as $bloc) {
                        if ($bloc->id==$bien->bloc_id) {
                            $output.='<td>'.$bloc->description.'</td>';

                        }
                    }
                    foreach ($immeubles as $immeuble) {
                        if ($immeuble->id==$bien->immeuble_id) {
                            $output.='<td>'.$immeuble->description.'</td>';

                        }
                    }
                    $output.='<td>'.$bien->prix.'</td>'.
                        '<td></td>'.
                        '<td></td>'.
                        '<td>'.$bien->numero.'</td>'.
                        '<td>'.$bien->type.'</td>'.
                        '<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/biens/detail/'.$bien->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/biens/modifier_bien/'.$bien->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien'.$bien->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;
            }
        }
    }

}

