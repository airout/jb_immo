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
                <a class="nav-link"> <b>Liste des employes</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Employes</li>

        </ul>
        <!-- Right navbar links -->
    </nav>
    @foreach($employes as $emp)
        <div class="modal fade" id="modalDeleteEmp{{$emp->id }}">
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
                        <a href="{{'/RH/supprimer_employe/' . $emp->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

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
                                <a href="/RH/nouveau_employe"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter Employe</button></a>
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
                                            <!--<a  href="route('users.search',$user->name) }}">  action="url('/users/search/'.$user->name)}}"  action="route('admin.users.g"-->
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

                                        <th>CIN</th>
                                        <th>CNSS</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Intitulé du Poste</th>
                                        <th>Date du recrutement</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    @foreach($employes as $emp)
                                        <tr>
                                            <td>{{$emp->cin}}</td>
                                            <td>{{$emp->cnss}}</td>
                                            <td>{{$emp->nom}}</td>
                                            <td>{{$emp->prenom}}</td>
                                            <td>{{$emp->intitule_poste}}</td>
                                            <td>{{ \Carbon\Carbon::parse($emp->date_recrutement)->format('d/m/Y')}}</td>
                                            <td class="project-actions text-right">
                                            @if(Auth::user()->is_admin==1)
                                                <!-- VOIR DETAILS -->
                                                    <a class="btn btn-primary btn-sm" title="Details" href="{{ '/RH/detail_employe/' . $emp->id }}">
                                                        <i class="fas fa-eye"></i>
                                                        </i>
                                                    </a>

                                                    <!-- MODIFIER -->
                                                    <a class="btn btn-info btn-sm" title="Modifier" href="{{ '/RH/modifier_employe/' . $emp->id }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                    </a>
                                                    <!-- SUPRIMMER -->
                                                    <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteEmp{{$emp->id }}">
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
            url: '/searchEmp',
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
