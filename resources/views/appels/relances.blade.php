
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
                <a class="nav-link"> <b>Liste des Relances</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
            <li class="breadcrumb-item active">Relances</li>
        </ul>
        <!-- Right navbar links -->
    </nav>

    @foreach($appels as $appel)
        <div class="modal fade" id="modalDeleteAppel{{$appel->id }} }}">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Attention</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                        <a href="{{'/appels/supprimer_appel/' . $appel->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
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
                                <a href="/appels/nouveau_appel"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter
                                        Appel</button></a>
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
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Téléphone</th>
                                        <th>Ville</th>
                                        <th>Source</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    @foreach($appels as $appel)
                                        <tr>
                                            <td>{{$appel->nom}}</td>
                                            <td>{{$appel->prenom}}</td>
                                            <td>{{$appel->telephone}}</td>
                                            <td>{{$appel->ville}}</td>
                                            <td>{{$appel->source}}</td>

                                            <td class="project-actions text-right">
                                                <!-- VOIR DETAILS -->
                                                <a class="btn btn-primary btn-sm" title="Details"href="{{ '/appels/detail/' . $appel->id }}">
                                                    <i class="fas fa-eye"></i>
                                                    </i>
                                                </a>
                                                <!-- MODIFIER -->
                                                <a class="btn btn-info btn-sm" title="Modifier"  href="{{ '/appels/modifier_appel/' . $appel->id }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <!-- SUPRIMMER -->

                                                <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteAppel{{$appel->id }}">
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
<script src="/plugins/jquery/jquery.min.js"></script>
</body>

</html>
