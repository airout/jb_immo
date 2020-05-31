<!DOCTYPE html>
<html lang="en">

    <head>
        @extends('includes.head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"> <b>{{$immeuble->description}}</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                  <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    <li class="breadcrumb-item"><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    <li class="breadcrumb-item"><a href="/blocs/detail/{{$bloc->id}}">{{$bloc->description}}</a></li>
                    <li class="breadcrumb-item active">{{$immeuble->description}}</li>
                </ul>
                <!-- Right navbar links -->
              </nav>

            @extends('includes.nav2')

             <!-- Model suppression bloc -->
            <div class="modal fade" id="modalDeleteImmeuble{{$immeuble->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer cet immeuble ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                      <a href="{{'/blocs/'.$bloc->id.'/supprimer_immeuble/' . $immeuble->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            @foreach($biens as $bien)
              <div class="modal fade" id="modalDeleteBien{{$bien->id}}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer ce bien ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                      <a href="{{'/immeubles/'.$immeuble->id.'/supprimer_bien/'. $bien->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            @endforeach


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content" style="padding: 6px;">
                    <div class="container-fluid">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                       <!-- button Immeubles -->
                                        <a class="btn btn-app" title="Immeubles" style="padding: 5px 5px;!important;" href="/immeubles/{{$immeuble->id}}/biens">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-home"></i> Biens <br/>{{$nbre_biens}}
                                        </a>
                                    </div>
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <a href="{{'/immeubles/modifier_immeuble/'.$immeuble->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteImmeuble{{$immeuble->id }}">Supprimer</a>
                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Description</dt>
                                                    <dd class="col-sm-8">{{$immeuble->description}}</dd>
                                                    <dt class="col-sm-4">Projet</dt>
                                                    <dd class="col-sm-8">{{$projet->nom}}</dd>
                                                    <dt class="col-sm-4">Tranche</dt>
                                                    <dd class="col-sm-8">{{$tranche->description}}</dd>



                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-6">Bloc</dt>
                                                    <dd class="col-sm-6">{{$bloc->description}}</dd>
                                                    <dt class="col-sm-6">Titre foncier</dt>
                                                    <dd class="col-sm-6">{{$immeuble->titre_foncier}}</dd>
                                                    <dt class="col-sm-6">Titre foncier parent</dt>
                                                    <dd class="col-sm-6">{{$projet->titre_foncier}}</dd>

                                                </dl>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                        <div id="biens" class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Biens</h3>
                                    </div>
                                    <div class="card-body">
                                      	<div class="row">
	                                        <div class="col-2">
	                                          <a href="{{'/immeubles/'.$immeuble->id.'/nouveau_bien'}}"><button type="button"
	                                              class="btn btn-block btn-primary btn-flat">Ajouter Bien</button></a>

	                                        </div>
	                                        <div class="col-2">
	                                          <a href="#"> <button type="button"
	                                              class="btn btn-block btn-outline-secondary btn-flat">Importer</button></a>
	                                        </div>
	                                        <div class="col-4">

	                                        </div>
	                                        <div class="col-4">
	                                          <div class="card-tools">
	                                            <div class="input-group input-group-sm">
	                                              <input style="height: 40px;" type="text" name="table_search" class="form-control float-right"
	                                                placeholder="Search">

	                                              <div class="input-group-append">
	                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	                                              </div>
	                                            </div>
	                                          </div>
	                                        </div>
                                      	</div>
                                    </div>
                                    <div class="card-body table-responsive p-0" >
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Etat</th>
                                                    <th>Propriété dite bien</th>
                                                    <th>Niveau</th>
                                                    <th>Projet</th>
                                                    <th>Tranche</th>
                                                    <th>GH</th>
                                                    <th>Immeuble</th>
                                                    <th>Prix</th>
                                                    <th>Montant encaissé</th>
                                                    <th>Montant encaissé (%)</th>
                                                    <th>Numéro</th>
                                                    <th>Type</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($biens as $bien)
                                                <tr>
                                                    <td class="">
                                                        @if($bien->etat=='disponible')
                                                            <i class="nav-icon fas fa-circle text-success"></i>
                                                          @elseif($bien->etat=='pre-reserve')
                                                            <i class="nav-icon fas fa-circle text-orange"></i>
                                                          @elseif($bien->etat=='reserve')
                                                            <i class="nav-icon fas fa-circle text-warning "></i>
                                                          @elseif($bien->etat=='bloque')
                                                            <i class="nav-icon fas fa-circle text-danger"></i>
                                                          @elseif($bien->etat=='livre')
                                                            <i class="nav-icon fas fa-circle text-default"></i>
                                                          @endif
                                                    </td>
                                                    <td>{{$bien->propriete_dite_bien}}</td>
                                                    <td>{{$bien->niveau}}</td>
                                                    <td>{{$projet->description}}</td>
                                                    <td>{{$tranche->description}}</td>
                                                    <td>{{$bloc->description}}</td>
                                                    <td>{{$immeuble->description}}</td>
                                                    <td>{{$bien->prix}}</td>
                                                    <td>

                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        {{$bien->numero}}
                                                    </td>
                                                    <td>
                                                        {{$bien->type}}
                                                    </td>
                                                    <td class="project-actions text-right">
							                             <!-- VOIR DETAILS -->
							                            <a class="btn btn-primary btn-sm" title="Details" href="/biens/detail/{{$bien->id}}">
							                              <i class="fas fa-eye"></i>
							                              </i>
							                            </a>
							                            @if(Auth::user()->is_admin==1)
							                              <!-- MODIFIER -->
							                              <a class="btn btn-info btn-sm" title="Modifier" href="/biens/modifier_bien/{{$bien->id}}">
							                                <i class="fas fa-pencil-alt">
							                                </i>
							                              </a>
							                              <!-- SUPRIMMER -->
							                              <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBien{{$bien->id}}">
							                                <i class="fas fa-trash">
							                                </i>
							                              </a>
							                            @endif
						                          	</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </section>
            </div>
            @extends('includes.footer')
        </div>

    </body>

</html>
