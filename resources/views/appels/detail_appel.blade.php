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
                <a class="nav-link"> <b>{{$appel->nom}}</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="/appels">Appels</a></li>
            <li class="breadcrumb-item active">{{$appel->nom}}</li>
        </ul>
        <!-- Right navbar links -->
    </nav>

    @extends('includes.nav')


    <div class="modal fade" id="modalDeleteAppel{{$appel->id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Attention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Etes-vous certain(e) de vouloir supprimer cette appel ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <a href="{{'/appels/supprimer_appel/' . $appel->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


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
                                <a href="{{'/appels/modifier_appel/' . $appel->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteAppel{{$appel->id }}">Supprimer</a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <dl class="row">
                                            @if(Auth::user()->is_admin==2)
                                            <dt class="col-sm-4">Nom</dt>
                                            <dd class="col-sm-8">{{$appel->nom}}</dd>
                                            <dt class="col-sm-4">Prénom</dt>
                                            <dd class="col-sm-8">{{$appel->prenom}}</dd>
                                            <dt class="col-sm-4">Telephone</dt>
                                            <dd class="col-sm-8">{{$appel->telephone}}</dd>
                                            <dt class="col-sm-4">Ville</dt>
                                            <dd class="col-sm-8">{{$appel->ville}}</dd>
                                            <dt class="col-sm-4">Source</dt>
                                            <dd class="col-sm-8">{{$appel->source}}</dd>
                                            <dt class="col-sm-4">Type du bien</dt>
                                            @if($appel->type_bien=='F1')
                                                <dd class="col-sm-8">F1<dd>
                                            @elseif($appel->type_bien=='F2')
                                                <dd class="col-sm-8">F2<dt>
                                            @elseif($appel->type_bien=='F3')
                                                <dd class="col-sm-8">F3<dt>
                                            @elseif($appel->type_bien=='F4')
                                                <dd class="col-sm-8">F4<dt>
                                            @elseif($appel->type_bien=='F5')
                                                <dd class="col-sm-8">F5<dt>
                                            @endif
                                            <dt class="col-sm-4">Commentaire</dt>
                                            <dd class="col-sm-8">{{$appel->commentaire_assistance}}</dd>
                                           @elseif(Auth::user()->is_admin==0)
                                                <dt class="col-sm-4">Intérêt</dt>
                                                @if($appel->interet=='perdu')
                                                    <dd class="col-sm-8">Perdu<dd>
                                                @elseif($appel->interet=='receptif')
                                                    <dd class="col-sm-8"> Resiptive<dt>
                                                @elseif($appel->interet=='injoignable')
                                                    <dd class="col-sm-8"> Injoignable<dt>
                                                @elseif($appel->interet=='interesse')
                                                    <dd class="col-sm-8"> Intéressé<dt>
                                               @endif
                                                <dt class="col-sm-4">Frein</dt>
                                                <dd class="col-sm-8">{{$appel->frein}}</dd>
                                                <dt class="col-sm-4">Prochaine Relance</dt>
                                                <dd class="col-sm-8">{{$appel->prochaine_relance}}</dd>
                                                <dt class="col-sm-4">Commentaire</dt>
                                                <dd class="col-sm-8">{{$appel->commentaire_cc}}</dd>
                                            @endif
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

</body>

</html>
