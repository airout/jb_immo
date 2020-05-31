<?php

namespace App\Http\Controllers;

use App\Employe;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{

    public function index(Request $request)
    {
        $page = 'RH';
        $employes = DB::table('employe')->get();
        return view('/rh/employes', compact('employes', 'page'));

    }



    public function ajouterEmp()
    {
        $page='Nouvel Employe';
        return view('/rh/ajouter_employe', compact('page'));
    }




    public function storeEmp(Request $request)
    {
        $validatedData = $request->validate([
            'cin' => 'required|unique:employe,cin',
            'cnss'=>'required|unique:employe,cnss' ,
            'prenom'=>'required',
            'nom'=>'required',
            'intitule_poste'=>'required',
            'date_recrutement'=>'required',
            'niveau_etude'=>'required',
            'mission'=>'required'
        ],
            [
                'nom.required' => 'Le nom est obligatoire',
                'cin.unique' => 'Le cin que vous avez saisi existe déja.',
                'cnss.unique' => 'Le cnss que vous avez saisi existe déja.',
                'prenom.required' => 'Le prenom est obligatoire',
                'intitule_poste.required' => 'L\'intitule de poste  est obligatoire',
                'date_recrutement.required' => 'La date de rectuterment  est obligatoire',
                'mission.required' => 'La mission est obligatoire',
                'niveau_etude.required' => 'Le niveau d\'étude est obligatoire'
            ]

        );

        $employe=Employe::create([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'intitule_poste'=>$request->get('intitule_poste'),
            'cin'=>$request->get('cin'),
            'cnss'=>$request->get('cnss'),
            'date_recrutement'=>$request->get('date_recrutement'),
            'niveau_etude'=>$request->get('niveau_etude'),
            'mission'=>$request->get('mission'),
            'nb_jour_recupere'=>$request->get('nb_jour_recupere'),


        ]);

        if($employe){
            $page='RH';
            $success="nouvel employe créé avec succès !!";
            $employes=DB::table('employe')->get();
            return redirect('/RH')->with('employes', 'page');

        }
    }

    public function show($id)
    {
        $employe=Employe::find($id);
        $page=$employe->nom;
        return view('/RH/detail_employe', compact('employe', 'page'));
    }

    public function destroy($id)
    {
        $employe=Employe::find($id);
        $nom=$employe->nom;
        if($employe->delete()){
            $delete_msg="l'employé ".$nom." a été supprimé avec succès";
            $employes=DB::table('Employe')->get();
            $page='RH';
            return redirect('/RH')->with('employes', 'delete_msg', 'page');
        }
    }

    public function searchEmp(Request $request)
    {
        if($request->ajax()){
            $output="";
            $employes=DB::table('employe')
                ->where('cin','LIKE','%'.$request->search."%")
                ->orWhere('nom','LIKE','%'.$request->search."%")
                ->orWhere('prenom','LIKE','%'.$request->search."%")
                ->get();
            if($employes){
                foreach ($employes as $emp) {
                    $output.='<tr>';
                    $output.='<td>'.$emp->cin.'</td>';
                    $output.='<td>'.$emp->cnss.'</td>';
                    $output.='<td>'.$emp->nom.'</td>';
                    $output.='<td>'.$emp->prenom.'</td>';
                    $output.='<td>'.$emp->intitule_poste.'</td>';
                    $output.='<td>'.$emp->date_recrutement.'</td>';
                    $output.='<td class="project-actions text-right">'.
                        '<a class="btn btn-primary btn-sm" title="Details" href="/RH/detail_employe/'.$emp->id.'"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->is_admin==1){
                        $output.='<a class="btn btn-info btn-sm" title="Modifier" href="/RH/modifier_employe/'.$emp->id.'"><i class="fas fa-pencil-alt"></i></a>'.
                            '<a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteEmp'.$emp->id.'"><i class="fas fa-trash"></i></a>';
                    }
                    $output.='</td>'.


                        '</tr>';
                }
                return $output;
            }

        }



    }
    public function edit($id)
    {
        $page='Modifier Employe';
        $employe=Employe::find($id);

        return view('/RH/modifier_employe', compact('employe', 'page'));
    }


    public function update(Request $request, $id)
    {
        $employe=Employe::find($id);
        $employe->update([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'intitule_poste'=>$request->get('intitule_poste'),
            'cin'=>$request->get('cin'),
            'cnss'=>$request->get('cnss'),
            'date_recrutement'=>$request->get('date_recrutement'),
            'niveau_etude'=>$request->get('niveau_etude'),
            'mission'=>$request->get('mission'),
            'nb_jour_recupere'=>$request->get('nb_jour_recupere'),
        ]);
        $page='RH';
        $employes=DB::table('employe')->get();
        return redirect('/RH')->with('employes', 'page');

    }

































}
