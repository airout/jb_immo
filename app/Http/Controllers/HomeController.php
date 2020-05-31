<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projet;
use File;
use Image;
use DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
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
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
     public function home()
    {

        $page='Projets';
        $nbre_appel_recu = DB::table('appel')->where('cc_id',Auth::user()->id)->where('traite', 0)->count();
        $projets=DB::table('Projet')->get();
        return view('/projets/projets', compact('projets', 'page','nbre_appel_recu'));
    }

}
