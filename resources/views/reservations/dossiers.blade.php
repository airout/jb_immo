
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
                    <a class="nav-link"> <b>Liste des Clients</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item active">Clients</li>
                </ul>
                <!-- Right navbar links -->
            </nav>

            @foreach($dossiers as $dossier)
            <div class="modal fade" id="modalDeleteDossier{{$dossier->id }}">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                        <div class="modal-header">
                            <h4 class="modal-title">Attention</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Etes-vous certain(e) de vouloir supprimer ce dossier ? <br> <small><cite title="Source Title">La suppression
                                        est définitive.</cite> </small> </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                            <a href="{{'/dossiers/supprimer_dossier/' . $dossier->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            @endforeach


         @extends('includes.nav')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header" >
             <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <!-- button de creer_programme -->
                                    <a href="/reservations/nouveau_dossier"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter
                                            Dossier</button></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="#"> <button type="button"
                                                         class="btn btn-block btn-outline-secondary btn-flat">Importer</button></a>
                                </div>

                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="card-tools">
                                        <form  enctype="multipart/form-data" method="get" action="">

                                        <div class="input-group input-group-sm">
                                            <input id="search" style="height: 40px;" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>CC</th>
                                            <th>Projet</th>
                                            <th>Bien</th>
                                            <th>Prix</th>
                                            <th>Nombre aquéreurs</th>
                                            <th>Date réservation</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($dossiers as $dossier)
                                            <tr>
                                                <td>
                                                    @foreach($users as $user)
                                                    @if($user->id==$dossier->responsable_dossier)
                                                        {{$user->name}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($projets as $projet)
                                                    @if($projet->id==$dossier->projet_id)
                                                        {{$projet->nom}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($biens as $bien)
                                                    @if($bien->id==$dossier->bien_id)
                                                        {{$bien->propriete_dite_bien}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$dossier->prix}}</td>
                                                <td>{{$dossier->nombre_aquereurs}}</td>
                                                <td>{{ \Carbon\Carbon::parse($dossier->date_reservation)->format('d/m/Y')}}</td>

                                            <td class="project-actions text-right">
                                                <!-- VOIR DETAILS -->
                                                <a class="btn btn-primary btn-sm" title="Details"href="{{ '/dossiers/'.$dossier->id.'/detail_dossier' }}">
                                                    <i class="fas fa-eye"></i>
                                                    </i>
                                                </a>
                                                <!-- MODIFIER -->
                                                <a class="btn btn-info btn-sm" title="Modifier"  href="/dossiers/modifier_dossier/{{$dossier->id}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <!-- SUPRIMMER -->

                                                <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteDossier{{$dossier->id }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </a>
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
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
        </div>

        @extends('includes.footer')


    </div>

</body>

</html>
