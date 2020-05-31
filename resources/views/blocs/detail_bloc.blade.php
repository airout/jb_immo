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
                    <a class="nav-link"> <b>{{$bloc->description}}</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                  <!-- Messages Dropdown Menu -->
                  <!-- Notifications Dropdown Menu -->
                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    <li class="breadcrumb-item"><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    <li class="breadcrumb-item active">{{$bloc->description}}</li>
                </ul>
                <!-- Right navbar links -->
            </nav>

            <!-- Model suppression bloc -->
            <div class="modal fade" id="modalDeleteBloc{{$bloc->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer ce bloc ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                      <a href="{{'/tranches/'.$tranche->id.'/supprimer_bloc/' . $bloc->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            @foreach($immeubles as $immeuble)
              <div class="modal fade" id="modalDeleteImmeuble{{$immeuble->id}}">
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
                      <a href="{{'/blocs/'.$bloc->id.'/supprimer_immeuble/'. $immeuble->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            @endforeach



            @extends('includes.nav2')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">


                <section class="content" style="padding: 6px;">
                    <div class="container-fluid">
                        <div class="card card-primary">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">


                                        <!-- button Immeubles -->
                                        <a class="btn btn-app" style="padding: 5px 5px;!important;" title="Immeubles" href="/blocs/{{$bloc->id}}/immeubles">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-building"></i> Immeubles <br/>{{$nbre_immeubles}}
                                        </a>
                                        <!-- button Biens -->
                                        <a class="btn btn-app" style="padding: 5px 5px;!important;" title="Biens" href="/blocs/{{$bloc->id}}/biens">
                                            <!-- <span class="badge bg-danger">531</span> -->
                                            <i class="fas fa-home"></i> Biens <br/>{{$nbre_biens}}
                                        </a>
                                    </div>
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <a href="{{'/blocs/modifier_bloc/'.$bloc->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteBloc{{$bloc->id }}">Supprimer</a>
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
                                                    <dd class="col-sm-8">{{$bloc->description}}</dd>
                                                    <dt class="col-sm-4">Tranche</dt>
                                                    <dd class="col-sm-8">{{$tranche->description}}</dd>
                                                    <dt class="col-sm-4">Projet</dt>
                                                    <dd class="col-sm-8">{{$projet->nom}}</dd>

                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-6">Titre foncier</dt>
                                                    <dd class="col-sm-6">{{$bloc->titre_foncier}}</dd>
                                                    <dt class="col-sm-6">Titre foncier parent</dt>
                                                    <dd class="col-sm-6">{{$projet->titre_foncier}}</dd>

                                                </dl>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="immeubles" class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Immeubles</h3>
                                    </div>
                                     <div class="card-body">
                                      <div class="row">
                                        <div class="col-2">
                                          <a href="{{'/blocs/'.$bloc->id.'/nouvel_immeuble'}}"><button type="button"
                                              class="btn btn-block btn-primary btn-flat">Ajouter Immeuble</button></a>

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
                                                  <th>Description</th>
                                                  <th>Bloc</th>
                                                  <th>Tranche</th>
                                                  <th>Projet</th>
                                                  <th>Titre foncier</th>
                                                  <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($immeubles as $immeuble)
                                                <tr>
                                                  <td>{{$immeuble->description}}</td>
                                                  <td>{{$bloc->description}}</td>
                                                  <td>{{$tranche->description}}</td>
                                                  <td>{{$projet->nom}}</td>
                                                  <td>{{$immeuble->titre_foncier}}</td>
                                                  <td class="project-actions text-right">
                                                       <a class="btn btn-primary btn-sm" title="Details" href="{{ '/immeubles/detail/' . $immeuble->id }}">
                                                        <i class="fas fa-eye"></i>
                                                        </i>
                                                      </a>
                                                      @if(Auth::user()->is_admin==1)
                                                        <a class="btn btn-info btn-sm" title="Modifier" href="{{'/immeubles/modifier_immeuble/'.$immeuble->id}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>

                                                        <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteImmeuble{{$immeuble->id }}">
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
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                            <!-- /.col -->
                          </div>
                    </div><!-- /.container-fluid -->
                </section>
            </div>
            @extends('includes.footer')
        </div>

    </body>

</html>
