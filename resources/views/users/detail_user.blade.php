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
                <a class="nav-link"> <b>{{$user->name}}</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
            <li class="breadcrumb-item"><a href="/users">Utilisateurs</a></li>
            <li class="breadcrumb-item active">{{$user->name}}</li>
        </ul>
        <!-- Right navbar links -->
    </nav>

    @extends('includes.nav')


    <div class="modal fade" id="modalDeleteUser{{$user->id }}">
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
                        <a href="{{'/users/supprimer_user/' . $user->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

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
                                        <a href="{{'/users/modifier_user/' . $user->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteUser{{$user->id }}">Supprimer</a>
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
                                            <dt class="col-sm-4">Nom</dt>
                                            <dd class="col-sm-8">{{$user->name}}</dd>
                                            <dt class="col-sm-4">Prénom</dt>
                                            <dd class="col-sm-8">{{$user->prenom}}</dd>
                                            <dt class="col-sm-4">Email</dt>
                                            <dd class="col-sm-8">{{$user->email}}</dd>
                                            <dt class="col-sm-4">Type</dt>
                                            @if($user->is_admin==1)
                                                <dd class="col-sm-8">Administrateur<dd>
                                            @elseif($user->is_admin==0)
                                                <dd class="col-sm-8">Commercial<dt>
                                            @elseif($user->is_admin==2)
                                                <dd class="col-sm-8">Assistante<dt>
                                            @endif
                                            </dt>
                                           
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
