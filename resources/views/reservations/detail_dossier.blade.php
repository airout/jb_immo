<!DOCTYPE html>
<html lang="en">

    <head>
        @extends('includes.head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
               <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"> <b></b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/reservations">Reservations</a></li>
                   <li class="breadcrumb-item"><a href="/reservations/dossiers">Dossiers</a></li>
                   <li class="breadcrumb-item active">Détail</li>
                </ul>

            </nav>

            @extends('includes.nav')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">


                <section class="content" style="padding: 6px;">
                    <div class="container-fluid">



                             <div class="row">
                                <div class="col-12">
                                  <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Dossier</h3>
                                            <div class="card-tools">
                                               <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                        data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>

                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-5">

                                                    <dl class="row">
                                                        <dt class="col-sm-6">Nombre d'aquéreurs</dt>
                                                        <dd class="col-sm-6">{{$dossier->nombre_aquereurs}}</dd>
                                                        <dt class="col-sm-6">Responsable dossier</dt>
                                                        <dd class="col-sm-6">{{$dossier->responsable_dossier}}</dd>
                                                        <dt class="col-sm-6">Projet</dt>
                                                        <dd class="col-sm-6">
                                                            @foreach($projets as $projet)
                                                                @if($projet->id==$dossier->projet_id)
                                                                    {{$projet->nom}}
                                                                @endif
                                                            @endforeach
                                                        </dd>
                                                        <dt class="col-sm-6">Tranche</dt>
                                                        <dd class="col-sm-6">
                                                            @foreach($tranches as $tranche)
                                                                @if($tranche->id==$dossier->tranche_id)
                                                                    {{$tranche->description}}
                                                                @endif
                                                            @endforeach
                                                        </dd>
                                                        <dt class="col-sm-6">Bloc</dt>
                                                        <dd class="col-sm-6">
                                                            @foreach($blocs as $bloc)
                                                                @if($bloc->id==$dossier->bloc_id)
                                                                    {{$bloc->description}}
                                                                @endif
                                                            @endforeach
                                                        </dd>
                                                        <dt class="col-sm-6">Immeuble</dt>
                                                        <dd class="col-sm-6">
                                                            @foreach($immeubles as $immeuble)
                                                                @if($immeuble->id==$dossier->immeuble_id)
                                                                    {{$immeuble->description}}
                                                                @endif
                                                            @endforeach
                                                        </dd>
                                                        <dt class="col-sm-6">Bien</dt>
                                                        <dd class="col-sm-6">
                                                            @foreach($biens as $bien)
                                                                @if($bien->id==$dossier->bien_id)
                                                                    {{$bien->propriete_dite_bien}}
                                                                @endif
                                                            @endforeach
                                                        </dd>


                                                    </dl>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-5">
                                                    <dl class="row">
                                                        <dt class="col-sm-6">Prix</dt>
                                                        <dd class="col-sm-6">{{$dossier->prix}}</dd>
                                                        <dt class="col-sm-6">Date réservation</dt>
                                                        <dd class="col-sm-6">{{ \Carbon\Carbon::parse($dossier->date_reservation)->format('d/m/Y')}}</dd>
                                                        <dt class="col-sm-6">Date limite de réservation</dt>
                                                        <dd class="col-sm-6">{{ \Carbon\Carbon::parse($dossier->date_limite_reservation)->format('d/m/Y')}}</dd>



                                                    </dl>


                                                </div>

                                            </div>
                                            <a href="/dossiers/modifier_dossier/{{$dossier->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        </div>

                                    </div>
                                  <!-- ./card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                  <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Aquéreurs</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                        data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-head-fixed text-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>Nom</th>
                                                            <th>Prénom</th>
                                                            <th>Téléphone</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($aquereurs as $aq)
                                                            @foreach($clients as $client)
                                                            @if($client->id==$aq->client_id)
                                                            <tr>
                                                                <td>{{$client->nom}}</td>
                                                                <td>{{$client->prenom}}</td>
                                                                <td>{{$client->telephone1}}</td>
                                                                <td>
                                                                    <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteAquereur{{$aq->id}}">

                                                                    </a>
                                                                </td>

                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        @endforeach

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <a href=""  data-toggle="modal" data-target="#modalAddAquereur" class="btn btn-primary float-right" style="margin-left: 2%">Ajouter Aquéreur</a>
                                        </div>

                                    </div>
                                  <!-- ./card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                  <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Paiement</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                        data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-minus"></i></button>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if(isset($paiement))
                                                @foreach($paiement as $paie)
                                                <dl class="row">

                                                    <dt class="col-sm-6">N° Reçu</dt>
                                                    <dd class="col-sm-6">{{$paie->num_recu}}</dd>
                                                    <dt class="col-sm-6">SR</dt>
                                                    @if($paie->sr==1)
                                                    <dd class="col-sm-6"><input type="checkbox" name="sr" value="1" checked></dd>
                                                    @else
                                                        <dd class="col-sm-6"><input type="checkbox" name="sr" value="1"></dd>
                                                    @endif
                                                    <dt class="col-sm-6">Montant</dt>
                                                    <dd class="col-sm-6">{{$paie->montant}}</dd>
                                                    <dt class="col-sm-6">Montant en lettre</dt>
                                                    <dd class="col-sm-6">{{$paie->montant_lettre}}</dd>
                                                    <dt class="col-sm-6">Date de réglement</dt>
                                                    <dd class="col-sm-6">{{ \Carbon\Carbon::parse($paie->date_reglement)->format('d/m/Y')}}</dd>

                                                    <dt class="col-sm-6">Modalité de paiement</dt>
                                                    <dd class="col-sm-6">{{$paie->modalite_paiement}}</dd>
                                                    @if($paie->echeance!=NULL)
                                                        <dt class="col-sm-6">Echéance</dt>
                                                        <dd class="col-sm-6">{{ \Carbon\Carbon::parse($paie->echeance)->format('d/m/Y')}}</dd>
                                                    @endif
                                                     @if($paie->banque!=NULL)
                                                        <dt class="col-sm-6">Banque</dt>
                                                        <dd class="col-sm-6">{{$paie->banque}}</dd>
                                                    @endif
                                                    @if($paie->num_paiement!=NULL)
                                                        <dt class="col-sm-6">N° de paiement</dt>
                                                        <dd class="col-sm-6">{{$paie->num_paiement}}</dd>
                                                    @endif




                                                </dl>
                                                @endforeach
                                                <a href="" data-toggle="modal" data-target="#modalEditPaiement" class="btn btn-primary float-right" style="margin-left: 2%">Modifier Paiement</a>
                                            @else
                                                <a href="" data-toggle="modal" data-target="#modalAddPaiement" class="btn btn-primary float-right" style="margin-left: 2%">Ajouter Paiement</a>
                                            @endif
                                        </div>

                                    </div>
                                  <!-- ./card -->
                                </div>
                                <!-- /.col -->
                            </div>
                    </div>

                </section>
            </div>
            <div class="modal fade" id="modalAddPaiement">
                <div class="modal-dialog">
                  <div class="modal-content " style="width: 900px">
                    <div class="modal-header">
                      <h4 class="modal-title">Paiement</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="card card-primary">


                                <div class="card-body">
                                    <form enctype="multipart/form-data" method="post" id="myform" action="{{'/dossiers/'.$dossier->id.'/add_paiement'}}">
                                        {{csrf_field()}}
                                        {{ method_field('PUT') }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <textarea class="col-md-8 form-control" type="text" name="dossier_id" style="display: none" form="myform" >{{$dossier->id}}</textarea>
                                                    <label for="inputReçu" class="col-md-4">N°  Reçu</label>
                                                    <input type="text" id="" class="form-control col-md-6"  value="{{ $num_recu ?? '' }}" disabled>
                                                    <input type="hidden" id="" class="form-control col-md-6" name="num_recu" value="{{ $num_recu ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">

                                                   <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="sr" value="1" >
                                                        <label for="customCheckbox1" >SR</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="inputMontant" class="col-md-2">Montant</label>
                                                    <input type="number" id="montant"  onKeyUp=" keyUpHandler(this)" class="form-control col-md-6" name="montant" placeholder="0.00">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="inputMlettre" class="col-md-2">Montant en lettre</label>
                                                    <textarea id="conversion" class="form-control col-md-6" style="height: 38px;"  name="montant_lettre" placeholder="Zero Dirhams">&nbsp;</textarea>


                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="inputReglement" class="col-md-2">Date de Réglement</label>
                                                    <input type="date" id="" class="form-control col-md-6" name="date_reglement">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="inputEchéance" class="col-md-2">Modalité de paiement</label>
                                                    <select class="form-control col-md-6" name="modalite_paiement" onchange="resultModalite(this)">
                                                        <option selected="" disabled="">Modalité de paiement</option>
                                                        <option value="espèce">Espèce</option>
                                                        <option value="chèque" >Chèque</option>
                                                        <option value="virement">Virement</option>
                                                        <option  value="versement">Versement</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-12"id="echeance" style="display: none">
                                                <div class="form-group row">
                                                    <label for="inputEchéance" class="col-md-2">Echéance</label>
                                                    <input type="date" class="form-control col-md-6" name="echeance">
                                                </div>
                                            </div>

                                            <div class="col-md-12 test1" id="banque" style="display: none">
                                                <div class="form-group row">
                                                    <label for="inputEchéance" class="col-md-2">Banque</label>
                                                    <input type="text" class="form-control col-md-6" name="banque">
                                                </div>
                                            </div>
                                            <div class="col-md-12 test2" id="num_paiement" style="display: none">
                                                <div class="form-group row">
                                                    <label for="inputEchéance" class="col-md-2">N° de paiement</label>
                                                    <input type="text" class="form-control col-md-6" name="num_paiement">
                                                </div>
                                            </div>

                                            </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="" class="btn btn-secondary float-right"  data-dismiss="modal" style="margin-left: 2%">Annuler</a>
                                                <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                          </div>

                    </div>

                  </div>
                </div>
            </div>
             <div class="modal fade" id="modalEditPaiement">
                <div class="modal-dialog">
                    <div class="modal-content " style="width: 900px">
                        <div class="modal-header">
                            <h4 class="modal-title">Paiement</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">


                                        <div class="card-body">
                                            <form enctype="multipart/form-data" method="post" action="{{url('/dossiers/'.$dossier->id.'/update_paiement/')}}">
                                                {{csrf_field()}}
                                                {{ method_field('PUT')}}
                                                <div class="row">
                                                    @if(isset($paiement))
                                                    @foreach($paiement as $paie)
                                                        <div class="col-md-6">
                                                            <div class="form-group row">

                                                                <input class="col-md-8 form-control" type="text" name="dossier_id" style="display: none"  value="{{$dossier->id}}" >
                                                                <label for="inputReçu" class="col-md-4">N°  Reçu</label>
                                                                <input type="text" id="" class="form-control col-md-6"  value="{{$paie->num_recu}}" disabled>
                                                                <input type="hidden" id="" class="form-control col-md-6" name="num_recu"  value="{{$paie->num_recu}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <div class="custom-control custom-checkbox">

                                                                    <input type="checkbox" name="sr" value="1" @if($paie->sr== 1 ){{'checked'}}@endif   >

                                                                    <label for="customCheckbox1" >SR</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="inputMontant" class="col-md-2">Montant</label>
                                                                <input type="number" id="montant2"  onKeyUp=" keyUpHandler2(this)"  class="form-control col-md-6" name="montant" value="{{$paie->montant}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="inputMlettre" class="col-md-2">Montant en lettre</label>
                                                                <textarea id="conversion2" class="form-control col-md-6" style="height: 38px;"  name="montant_lettre"placeholder="Zero Dirhams"> {{$paie->montant_lettre}} </textarea>
                                                               <!-- <input type="text" id="" class="form-control col-md-6" name="montant_lettre" placeholder="Zero Dirhams">-->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="inputReglement" class="col-md-2">Date de Réglement</label>
                                                                <input type="date" id="" class="form-control col-md-6" name="date_reglement" value="{{$paie->date_reglement}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="inputEchéance" class="col-md-2">Modalité de paiement</label>
                                                                <select class="form-control col-md-6" name="modalite_paiement" onchange="showDiv2(this)" >
                                                                    <option selected="" disabled="">Modalité de paiement</option>

                                                                    <option value="espèce" @if($paie->modalite_paiement== 'espèce') {{'selected'}} @endif>Espèce</option>
                                                                    <option value="chèque" @if($paie->modalite_paiement== 'chèque') {{'selected'}} @endif>Chèque</option>
                                                                    <option value="virement" @if($paie->modalite_paiement== 'virement') {{'selected'}} @endif>Virement</option>
                                                                    <option value="versement" @if($paie->modalite_paiement== 'versement') {{'selected'}} @endif>Versement</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        @if($paie->modalite_paiement== 'espèce')
                                                            <div class="col-md-12"  id="div33" style="display: none">
                                                                <div class="form-group row">
                                                                    <label for="inputEchéance" class="col-md-2">Echéance </label>
                                                                    <input type="date" class="form-control col-md-6" name="echeance" value="{{$paie->echeance}}" >
                                                                </div>
                                                            </div>




                                                            <div class="col-md-12" id="div11" style="display: none">
                                                                <div class="form-group row">
                                                                    <label for="inputEchéance" class="col-md-2">Banque </label>
                                                                    <input type="text" class="form-control col-md-6" name="banque" value="{{$paie->banque}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="div22"  style="display: none">
                                                                <div class="form-group row">
                                                                    <label for="inputEchéance" class="col-md-2">N° de paiement </label>
                                                                    <input type="text" class="form-control col-md-6" name="num_paiement" value="{{$paie->num_paiement}}">
                                                                </div>
                                                            </div>


                                                        @elseif($paie->modalite_paiement== 'chèque')
                                                            <div class="col-md-12"  id="div33" style="display: block">
                                                                <div class="form-group row">
                                                                    <label for="inputEchéance" class="col-md-2">Echéance </label>
                                                                    <input type="date" class="form-control col-md-6" name="echeance" value="{{$paie->echeance}}" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12" id="div11" style="display: block">
                                                                <div class="form-group row">
                                                                    <label for="inputEchéance" class="col-md-2">Banque </label>
                                                                    <input type="text" class="form-control col-md-6" name="banque" value="{{$paie->banque}}">
                                                                </div>
                                                            </div>
                                                                <div class="col-md-12" id="div22"  style="display: block">
                                                                    <div class="form-group row">
                                                                        <label for="inputEchéance" class="col-md-2">N° de paiement </label>
                                                                        <input type="text" class="form-control col-md-6" name="num_paiement" value="{{$paie->num_paiement}}">
                                                                    </div>
                                                            </div>

                                                        @elseif($paie->modalite_paiement== 'virement' || $paie->modalite_paiement== 'versement')
                                                                    <div class="col-md-12"  id="div33" style="display: none">
                                                                        <div class="form-group row">
                                                                            <label for="inputEchéance" class="col-md-2">Echéance </label>
                                                                            <input type="date" class="form-control col-md-6" name="echeance" value="{{$paie->echeance}}" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12" id="div11" style="display: block">
                                                                        <div class="form-group row">
                                                                            <label for="inputEchéance" class="col-md-2">Banque </label>
                                                                            <input type="text" class="form-control col-md-6" name="banque" value="{{$paie->banque}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12" id="div22"  style="display: block">
                                                                            <div class="form-group row">
                                                                                <label for="inputEchéance" class="col-md-2">N° de paiement </label>
                                                                                <input type="text" class="form-control col-md-6" name="num_paiement" value="{{$paie->num_paiement}}">
                                                                            </div>
                                                                    </div>
                                                        @endif

                                                    @endforeach
                                                   @endif

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="" class="btn btn-secondary float-right"  data-dismiss="modal" style="margin-left: 2%">Annuler</a>
                                                        <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalAddAquereur">
                <div class="modal-dialog">
                    <div class="modal-content " style="width: 900px">
                        <div class="modal-header">
                            <a href="{{'/dossiers/'. $dossier->id.'/nouvel_aquereur'}}"><button type="button"
                                                        class="btn btn-block btn-primary btn-flat">Ajouter Aquéreur</button></a>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">

                                            <form enctype="multipart/form-data" method="post" action="{{'/dossiers/'.$dossier->id.'/add_aquereur'}}">
                                                {{csrf_field()}}
                                                {{ method_field('PUT') }}
                                                <div class="card-body table-responsive p-0">



                                                    <table class="table table-head-fixed text-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nom</th>
                                                            <th>Prénom</th>
                                                            <th>Téléphone</th>


                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody">


                                                            @foreach($clients as $client)

                                                                <tr>

                                                                    <td><input type="checkbox"  name="client_{{$client->id}}"  value="{{$client->id}}"></td>

                                                                    <td>{{$client->nom}}</td>
                                                                    <td>{{$client->prenom}}</td>
                                                                    <td>{{$client->telephone1}}</td>



                                                                </tr>

                                                            @endforeach

                                                        </tbody>

                                                    </table>
                                                </div>


                                            <!-- /.card-body -->
                                        </div>
                                        <div class="row float-right">
                                                    <a href="" class="btn btn-secondary "  data-dismiss="modal" >Annuler</a>
                                                    <input  type="submit" value="Sauvegarder"  class="btn btn-primary ">
                                                </div>
                                            </form>
                                        <!-- /.card -->
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>

            @foreach($aquereurs as $aq)
              <div class="modal fade" id="modalDeleteAquereur{{$aq->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer cet aquéreur ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <a href="{{'/dossiers/'.$dossier->id.'/supprimer_aquereur/'. $aq->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endforeach


            @extends('includes.footer')
        </div>

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script>
        /**** show /hide div addpaimennt***/
        function resultModalite(select){
            switch (select.value) {
                case 'chèque':
                    document.getElementById("banque").style.display = "block";
                    document.getElementById("num_paiement").style.display = "block";
                    document.getElementById("echeance").style.display = "block";
                    break;
                case 'virement':
                    document.getElementById("echeance").style.display = "none";
                    document.getElementById("banque").style.display = "block";
                    document.getElementById("num_paiement").style.display = "block";

                    break;
                case 'versement':
                    document.getElementById("echeance").style.display = "none";
                    document.getElementById("banque").style.display = "block";
                    document.getElementById("num_paiement").style.display = "block";

                    break;
                default:
                    document.getElementById("banque").style.display = "none";
                    document.getElementById("num_paiement").style.display = "none";
                    document.getElementById("echeance").style.display = "none";
                    break;
            }


        }
    /*** show/hide div modifypaiment****/
function showDiv2(select){
     switch (select.value) {
        case 'chèque':
            document.getElementById("div11").style.display = "block";
            document.getElementById("div22").style.display = "block";
            document.getElementById("div33").style.display = "block";
            break;
        case 'virement':
            document.getElementById("div11").style.display = "block";
            document.getElementById("div22").style.display = "block";
            document.getElementById("div33").style.display = "none";
            break;
        case 'versement':
            document.getElementById("div11").style.display = "block";
            document.getElementById("div22").style.display = "block";
            document.getElementById("div33").style.display = "none";

            break;
        default:
            document.getElementById("div11").style.display = "none";
            document.getElementById("div22").style.display = "none";
            document.getElementById("div33").style.display = "none";
            break;
    }



}
/**  conversion nombre to lettre      ***/
    function keyUpHandler(obj){
        document.getElementById("conversion").firstChild.nodeValue  =   NumberToLetter(obj.value)+' Dirhams'
    }//fin de keypressHandler
    function keyUpHandler2(obj){
        document.getElementById("conversion2").firstChild.nodeValue =   NumberToLetter(obj.value)
    }//fin de keypressHandler

    function Unite( nombre ){
        var unite;
        switch( nombre ){
            case 0: unite = "zéro";     break;
            case 1: unite = "un";       break;
            case 2: unite = "deux";     break;
            case 3: unite = "trois";    break;
            case 4: unite = "quatre";   break;
            case 5: unite = "cinq";     break;
            case 6: unite = "six";      break;
            case 7: unite = "sept";     break;
            case 8: unite = "huit";     break;
            case 9: unite = "neuf";     break;
        }//fin switch
        return unite;
    }
    function Dizaine( nombre ){
        switch( nombre ){
            case 10: dizaine = "dix"; break;
            case 11: dizaine = "onze"; break;
            case 12: dizaine = "douze"; break;
            case 13: dizaine = "treize"; break;
            case 14: dizaine = "quatorze"; break;
            case 15: dizaine = "quinze"; break;
            case 16: dizaine = "seize"; break;
            case 17: dizaine = "dix-sept"; break;
            case 18: dizaine = "dix-huit"; break;
            case 19: dizaine = "dix-neuf"; break;
            case 20: dizaine = "vingt"; break;
            case 30: dizaine = "trente"; break;
            case 40: dizaine = "quarante"; break;
            case 50: dizaine = "cinquante"; break;
            case 60: dizaine = "soixante"; break;
            case 70: dizaine = "soixante-dix"; break;
            case 80: dizaine = "quatre-vingt"; break;
            case 90: dizaine = "quatre-vingt-dix"; break;
        }//fin switch
        return dizaine;
    }

    function NumberToLetter( nombre ){
        var i, j, n, quotient, reste, nb ;
        var ch
        var numberToLetter='';
        //__________________________________

        if(  nombre.toString().replace( / /gi, "" ).length > 15  )  return "dépassement de capacité";
        if(  isNaN(nombre.toString().replace( / /gi, "" ))  )       return "Nombre non valide";

        nb = parseFloat(nombre.toString().replace( / /gi, "" ));
        if(  Math.ceil(nb) != nb  ) return  "Nombre avec virgule non géré.";

        n = nb.toString().length;
        switch( n ){
            case 1: numberToLetter = Unite(nb); break;
            case 2: if(  nb > 19  ){
                quotient = Math.floor(nb / 10);
                reste = nb % 10;
                if(  nb < 71 || (nb > 79 && nb < 91)  ){
                    if(  reste == 0  ) numberToLetter = Dizaine(quotient * 10);
                    if(  reste == 1  ) numberToLetter = Dizaine(quotient * 10) + "-et-" + Unite(reste);
                    if(  reste > 1   ) numberToLetter = Dizaine(quotient * 10) + "-" + Unite(reste);
                }else numberToLetter = Dizaine((quotient - 1) * 10) + "-" + Dizaine(10 + reste);
            }else numberToLetter = Dizaine(nb);
                break;
            case 3: quotient = Math.floor(nb / 100);
                reste = nb % 100;
                if(  quotient == 1 && reste == 0   ) numberToLetter = "cent";
                if(  quotient == 1 && reste != 0   ) numberToLetter = "cent" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0    ) numberToLetter = Unite(quotient) + " cents";
                if(  quotient > 1 && reste != 0    ) numberToLetter = Unite(quotient) + " cent " + NumberToLetter(reste);
                break;
            case 4 :  quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
                if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
                if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 5 :  quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
                if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
                if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 6 :  quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
                if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
                if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 7: quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 8: quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 9: quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 10: quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 11: quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 12: quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 13: quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
            case 14: quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
            case 15: quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
                if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
                if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
        }//fin switch
        /*respect de l'accord de quatre-vingt*/
        if(  numberToLetter.substr(numberToLetter.length-"quatre-vingt".length,"quatre-vingt".length) == "quatre-vingt"  ) numberToLetter = numberToLetter + "s";

        return numberToLetter;
    }

/*** fin conversion nombre to lettre***/

</script>

    </body>

</html>
