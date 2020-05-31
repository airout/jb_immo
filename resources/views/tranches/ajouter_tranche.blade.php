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
                    <a class="nav-link"> <b>Nouvelle Tranche</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                  <!-- Messages Dropdown Menu -->
                  <!-- Notifications Dropdown Menu -->
                    <li class="breadcrumb-item"><a href="index2.html">Accueil</a></li>
                    @isset($projet)
                        <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    @endisset
                    <li class="breadcrumb-item active">Nouvelle Tranche</li>

                </ul>
                <!-- Right navbar links -->
              </nav>
            <!-- /.navbar -->

            @extends('includes.nav2')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <!-- /.content-header -->
                <section class="content" style="padding: 5%;">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-primary">
                            <div class="card-header">

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                            class="fas fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li> {{$error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <div class="card-body" style="display: block;">
                                @if(isset($projet))
                                <form enctype="multipart/form-data" method="post" action="{{'/tranches/addTrancheByProjet/'.$projet->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description"  value="{{old('description')}}" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$projet->nom}}" readonly>
                                                <input type="hidden" class="form-control col-md-8"  value="{{$projet->id}}" name="projet_id" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau d'étages</label>
                                                <input type="number" class="form-control col-md-8" name="niveau_etages" value="{{old('niveau_etages')}}">
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Date de livraison</label>
                                                <input type="date" class="form-control col-md-8" name="date_livraison" value="{{old('date_livraison')}}">
                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <a href="{{'projets/'.$projet->id.'/tranches'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @else
                                <form enctype="multipart/form-data" method="post" action="/tranches/add_tranche">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description"  value="{{old('description')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <select name="projet_id" class="form-control col-md-8" style="width: 100%;"  >
                                                    <option></option>
                                                    @foreach($projets as $projet)
                                                    <option value="{{$projet->id}}" {{ old('projet_id') == $projet->id ? "selected" : "" }}>{{$projet->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau d'étages</label>
                                                <input type="number" class="form-control col-md-8" name="niveau_etages" value="{{old('niveau_etages')}}">
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Date de livraison</label>
                                                <input type="date" class="form-control col-md-8" name="date_livraison"  value="{{old('date_livraison')}}">
                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <a href="/tranches" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                </section>

               @extends('includes.footer')


            </div>

    </body>

</html>
