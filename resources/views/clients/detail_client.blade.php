<!DOCTYPE html>
<html lang="en">

<head>
    @extends('includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"> <b>{{$client->nom}}</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/clients">Clients</a></li>
                    <li class="breadcrumb-item active">{{$client->nom}}</li>
                </ul>
                <!-- Right navbar links -->
            </nav>

        @extends('includes.nav')

            <div class="modal fade" id="modalDeleteClient{{$client->id}}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer ce client ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>

                        <a href="{{'/clients/supprimer_client/'. $client->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                </div>
            </div>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content" style="padding: 6px;">
                 <div class="container-fluid">
                        <div class="card card-primary">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-md-2"></div>

                                    <div class="col-md-4">
                                        <a href="{{'/clients/modifier_client/'.$client->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteClient{{$client->id }}">Supprimer</a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>


                         <div class="row">
                            <div class="col-12">
                              <!-- Custom Tabs -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Informations Générales</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    data-toggle="tooltip" title="Collapse">
                                                <i class="fas fa-minus"></i></button>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>{{$client->nom}} {{$client->prenom}}</h3>
                                            </div>
                                            <div class="col-md-4">
                                                 <a class="btn btn-app" style="padding: 5px 5px;!important;" title="Dossier" href="@if($nombre_dossiers==0){{'/clients/'.$client->id.'/ajouter_dossier'}}@else{{'/clients/'.$client->id.'/dossiers'}}@endif">
                                                    <!-- <span class="badge bg-danger">531</span> -->
                                                    <i class="fas fa-folder"></i> Dossiers
                                                    <br/><span>{{$nombre_dossiers}}</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-5">

                                                <dl class="row">
                                                    <dt class="col-sm-6">Civilité</dt>
                                                    <dd class="col-sm-6">{{$client->civilite}}</dd>
                                                    <dt class="col-sm-6">Profession</dt>
                                                    <dd class="col-sm-6">{{$client->profession}}</dd>
                                                    <dt class="col-sm-6">Adresse</dt>
                                                    <dd class="col-sm-6">{{$client->adresse}} {{$client->ville}} {{$client->pays}}</dd>
                                                    <dt class="col-sm-6">Téléphone</dt>
                                                    <dd class="col-sm-6">{{$client->telephone1}}@if($client->telephone2 !=''){{' / '.$client->telephone2}}@endif</dd>


                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">


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
                                    <div class="card-header">
                                        <h3 class="card-title">Informations Personnelles</h3>
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
                                                    <dt class="col-sm-6">Date de naissance</dt>
                                                    <dd class="col-sm-6">{{ \Carbon\Carbon::parse($client->date_naissance)->format('d/m/Y')}}</dd>
                                                    <dt class="col-sm-6">Lieu de naissance</dt>
                                                    <dd class="col-sm-6">{{$client->lieu_naissance}}</dd>
                                                    <dt class="col-sm-6">Age</dt>
                                                    <dd class="col-sm-6">{{$client->age}}</dd>
                                                    <dt class="col-sm-6">Nom du responsable</dt>
                                                    <dd class="col-sm-6">{{$client->nom_responsable}}</dd>
                                                    <dt class="col-sm-6">Relation familiale</dt>
                                                    <dd class="col-sm-6">{{$client->relation_familiale}}</dd>
                                                    <dt class="col-sm-6">Nationalité</dt>
                                                    <dd class="col-sm-6">{{$client->nationalite}}</dd>


                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">

                                                <dl class="row">


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
                                    <div class="card-header">
                                        <h3 class="card-title">Situation Familiale</h3>
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
                                                    <dt class="col-sm-6">Situation familiale</dt>
                                                    <dd class="col-sm-6">{{$client->situation_familiale}}</dd>
                                                    @if($client->situation_familiale=='marié')
                                                    <dt class="col-sm-6">Marié(e) à: </dt>
                                                    <dd class="col-sm-6">{{$client->nom_mari}}</dd>
                                                    <dt class="col-sm-6">Date de mariage </dt>
                                                    <dd class="col-sm-6">{{$client->date_mariage}}</dd>
                                                    <dt class="col-sm-6">Lieu de mariage</dt>
                                                    <dd class="col-sm-6">{{$client->lieu_mariage}}</dd>
                                                    @endif
                                                    <dt class="col-sm-6">Nom père</dt>
                                                    <dd class="col-sm-6">{{$client->nom_pere}}</dd>
                                                    <dt class="col-sm-6">Nom mère</dt>
                                                    <dd class="col-sm-6">{{$client->nom_mere}}</dd>
                                                    <dt class="col-sm-6">Mode financement</dt>
                                                    <dd class="col-sm-6">{{$client->mode_financement}}</dd>
                                                    @if($client->mode_financement=='crédit')
                                                    <dt class="col-sm-6">Banque</dt>
                                                    <dd class="col-sm-6">{{$client->banque}}</dd>
                                                    @endif


                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">

                                                <dl class="row">


                                                </dl>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                              <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>
                </div>

             </section>
        </div>

        @extends('includes.footer')

    </div>
<!-- ./wrapper -->

</body>

</html>
