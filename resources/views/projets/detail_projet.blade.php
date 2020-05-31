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
                    <a class="nav-link"> <b>{{$projet->nom}}</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item active">{{$projet->nom}}</li>
                </ul>
                <!-- Right navbar links -->
            </nav>

            @extends('includes.nav2')

            <div class="content-wrapper">

                <section class="content" style="padding: 6px;">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- button Tranche -->
                                        <a class="btn btn-app" style="padding: 5px 5px;!important;"  title="Tranche" href="{{'/projets/'.$projet->id.'/tranches'}}">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fab fa-buffer"></i> Tranches <br/>{{$nbre_tranches}}
                                        </a>


                                        <!-- button Blocs -->
                                        <a class="btn btn-app"  style="padding: 5px 5px;!important;"title="Blocs" href="/projets/{{$projet->id}}/blocs">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-th"></i> Blocs<br/>{{$nbre_blocs}}
                                        </a>


                                        <!-- button Immeubles -->
                                        <a class="btn btn-app"  style="padding: 5px 5px;!important;" title="Immeubles" href="{{'/projets/'.$projet->id.'/immeubles'}}">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-building"></i> Immeubles <br/>{{$nbre_immeubles}}
                                        </a>
                                        <a class="btn btn-app"  style="padding: 5px 5px;!important;"title="Biens" href="{{'/projets/'.$projet->id.'/biens'}}">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-home"></i> Biens <br/>{{$nbre_biens}}
                                        </a>
                                    </div>

                                    <div class="col-md-2"></div>

                                    <div class="col-md-4">
                                        <a href="{{'/projets/modifier_projet/'.$projet->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-danger{{$projet->id }}">Supprimer</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                              <!-- Custom Tabs -->
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-4">Nom</dt>
                                                    <dd class="col-sm-8">{{$projet->nom}}</dd>
                                                    <dt class="col-sm-4">Code</dt>
                                                    <dd class="col-sm-8">{{$projet->code}}</dd>
                                                    <dt class="col-sm-4">Adresse</dt>
                                                    <dd class="col-sm-8">{{$projet->adresse}}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-6">Type de projet</dt>
                                                    <dd class="col-sm-6">{{$projet->type}}</dd>
                                                    <dt class="col-sm-6">Prolongation de réservation</dt>
                                                    <dd class="col-sm-6">{{$projet->prolongation_reservation}}</dd>
                                                    <dt class="col-sm-6">Limite d'annulation de réservation</dt>
                                                    <dd class="col-sm-6">{{$projet->limite_annulation_reservation}}</dd>

                                                </dl>
                                            </div>

                                        </div>

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
                                <div class="card-header d-flex p-0">

                                  <ul class="nav nav-pills  p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">CA</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Nombre d'appartements</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Nombre de commerce</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Notes
                                  </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <dl class="row">
                                            <dt class="col-sm-4">Propriété dite projet</dt>
                                            <dd class="col-sm-8">{{$projet->propriete_dite_projet}}</dd>
                                            <dt class="col-sm-4">Titre foncier</dt>
                                            <dd class="col-sm-8">{{$projet->titre_foncier}}</dd>
                                            <dt class="col-sm-4">Surface terrain</dt>
                                            <dd class="col-sm-8">{{$projet->surface_terrain}}</dd>
                                            <dt class="col-sm-4">Date autorisation de construction</dt>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($projet->date_autorisation_construction)->format('d/m/Y')}}</dd>
                                            <dt class="col-sm-4">Date permis d'habiter</dt>
                                            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($projet->date_permis_habiter)->format('d/m/Y')}}</dd>
                                            <dt class="col-md-4">Montant min</dt>
                                            <dd class="col-md-8">{{$projet->montant_min}}</dd>
                                            <dt class="col-md-4">Nombre de jours pour remboursement</dt>
                                            <dd class="com-md-8">{{$projet->nbre_jour_remboursement}}</dd>

                                          </dl>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">

                                    </div>
                                    <!-- /.tab-pane -->
                                  </div>
                                  <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                              </div>
                              <!-- ./card -->
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="modal fade" id="modal-danger{{$projet->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer ce projet ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <a href="{{'/projets/supprimer_projet/' . $projet->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
            </div>
            @extends('includes.footer')
        </div>

    </body>

</html>
