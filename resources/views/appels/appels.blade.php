<!DOCTYPE html>
<html lang="en">
<head>
    @extends('includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link"> <b>Liste des Appels</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Appels</li>

        </ul>
        <!-- Right navbar links -->
    </nav>
    @foreach($appels as $app)
        <div class="modal fade" id="modalDeleteAppel{{$app->id }}">
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
                        <a href="{{'/appels/supprimer_appel/' . $app->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach



    @extends('includes.nav')

    <div class="content-wrapper">
        <div class="content-header" style="padding: 10px 10px 0 10px;" >
            <div class="container-fluid">
                @if(isset($success))
                    <div class="row mb-12">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-check"></i> Success alert preview. This alert is dismissable.</h6>
                            </div>
                        </div>
                    </div>
                @endif
                @if(isset($error))
                    <div class="row mb-12">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h6><i class="icon fas fa-ban"></i> {{$error}}</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">


                    <div class="card-body" >
                        <div class="row">
                            <div class="col-2">
                                <!-- button de creer_programme -->
                                <a href="/appels/nouveau_appel"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter Appel</button></a>
                            </div>
                            <div class="col-2">
                                <a href="#"> <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Importer</button></a>
                            </div>
                            <div class="col-4">

                            </div>
                            <div class="col-4">



                                    <div class="input-group input-group-sm" >
                                        <input id="search"  style="height: 40px;" type="search" name="table_search" class="form-control float-right"
                                               placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit"   class="btn btn-default"><i class="fas fa-search"></i></button>

                                        </div>

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

                            <div class="card-body table-responsive p-0" >
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

                                    @foreach($appels as $app)
                                        <tr>
                                            <td>{{$app->nom}}</td>
                                            <td>{{$app->prenom}}</td>
                                            <td>{{$app->telephone}}</td>
                                            <td>{{$app->ville}}</td>
                                            <td>{{$app->source}}</td>

                                            <td class="project-actions text-right">
                                                <!-- VOIR DETAILS -->
                                                <a class="btn btn-primary btn-sm" title="Details"href="{{ '/appels/detail/' . $app->id }}">
                                                    <i class="fas fa-eye"></i>
                                                    </i>
                                                </a>
                                                <!-- MODIFIER -->
                                                <a class="btn btn-info btn-sm" title="Modifier"  href="{{ '/appels/modifier_appel/' . $app->id }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <!-- SUPRIMMER -->

                                                <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteAppel{{$app->id }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>

                            </div>


                        </div>

                    <!-- /.card-->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    @extends('includes.footer')
</div>
<script src="/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">

    $('#search').on('keyup',function(){
        var value=$(this).val();
        $.ajax({
            type : 'get',
            url: '/searchAppel',
            data: {search:value},
            success:function(data){
                $('#tbody').html(data);
                console.log('result: '+data);
            }
        });
    })
</script>
</body>

</html>
