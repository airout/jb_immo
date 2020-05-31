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
                <a class="nav-link"> <b>{{$employe->nom}}</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="/RH">RH</a></li>
            <li class="breadcrumb-item active">{{$employe->nom}}</li>
        </ul>
        <!-- Right navbar links -->
    </nav>

    @extends('includes.nav')


    <div class="modal fade" id="modalDeleteEmp{{$employe->id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Attention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Etes-vous certain(e) de vouloir supprimer cet utilisateur ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <a href="{{'/RH/supprimer_employe/' . $employe->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

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
                                <a href="{{'/RH/modifier_employe/' . $employe->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteEmp{{$employe->id }}">Supprimer</a>
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
                                            <dt class="col-sm-4">CIN</dt>
                                            <dd class="col-sm-8">{{$employe->cin}}</dd>
                                            <dt class="col-sm-4">CNSS</dt>
                                            <dd class="col-sm-8">{{$employe->cnss}}</dd>
                                            <dt class="col-sm-4">Nom</dt>
                                            <dd class="col-sm-8">{{$employe->nom}}</dd>
                                            <dt class="col-sm-4">Prénom</dt>
                                            <dd class="col-sm-8">{{$employe->prenom}}</dd>
                                            <dt class="col-sm-4">Intitulé du poste</dt>
                                            <dd class="col-sm-8">{{$employe->intitule_poste}}</dd>
                                            <dt class="col-sm-4">Niveau d'étude</dt>
                                            @if($employe->niveau_etude==0)
                                                <dd class="col-sm-8">Niveau bac<dd>
                                            @elseif($employe->niveau_etude==1)
                                                <dd class="col-sm-8">Bac<dt>
                                            @elseif($employe->niveau_etude==2)
                                                <dd class="col-sm-8">Bac+2<dt>
                                            @elseif($employe->niveau_etude==3)
                                                <dd class="col-sm-8">Bac+3<dt>
                                            @elseif($employe->niveau_etude==5)
                                                <dd class="col-sm-8">Bac+5<dt>
                                                    @endif
                                                </dt>
                                                <dt class="col-sm-4">Date de recrutement</dt>
                                                <dd class="col-sm-8">{{$employe->date_recrutement}}</dd>
                                                <dt class="col-sm-4">Mission</dt>
                                                <dd class="col-sm-8">{{$employe->mission}}</dd>
                                                <dt class="col-sm-4">Nombre de jours récupérés</dt>
                                                <dd class="col-sm-8">{{$employe->nb_jour_recupere}}</dd>
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
