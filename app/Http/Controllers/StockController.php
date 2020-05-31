<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use File;
use Image;
use DB;


class StockController extends Controller
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
        $projets=DB::table('Projet')->get();
        return view('/stock/projets', compact('projets'));
    }

    public function detail_projet($id)
    {
        $projet=Projet::find($id);

        return view('/stock/detail_projet', compact('projet'));
    }

    public function addProjet()
    { 
        return view('stock/add_projet');
    }
    public function editProjet($id)
    {
        $projet=Projet::find($id);

        return view('stock/edit_projet', compact('projet'));
    }

    public function deleteProjet($id)
    {
        $projet=Projet::find($id);
        $nom=$projet->nom;
        if($projet->delete()){
            $delete_msg='le projet '.$nom.' a été supprimé avec succès';
            return view('/stock/projets', compact('projets', 'delete_msg'));
        }
        
    }
    
}
