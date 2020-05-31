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
                    <a class="nav-link"> <b>Modifier Immeuble</b> </a>
                  </li>
                </ul>
        
                <ul class="navbar-nav ml-auto">
                  <!-- Messages Dropdown Menu -->
                  <!-- Notifications Dropdown Menu -->
                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    <li class="breadcrumb-item "><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    <li class="breadcrumb-item "><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    <li class="breadcrumb-item "><a href="/blocs/detail/{{$bloc->id}}">{{$bloc->description}}</a></li>
                    <li class="breadcrumb-item "><a href="/immeubles/detail/{{$immeuble->id}}">{{$immeuble->description}}</a></li>
                    <li class="breadcrumb-item active">Modifier</li>
                </ul>
                <!-- Right navbar links -->
              </nav>
            
            @extends('includes.nav2')
         
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- conetnt second header  -->
                

                <!-- <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-12">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h6><i class="icon fas fa-check"></i> Success alert preview. This alert is dismissable!</h6>
                                    
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-12">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h6><i class="icon fas fa-ban"></i>  Danger alert preview. This alert is dismissable.!</h6>
                                   
                                  </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                <!-- /.content-header -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Immeuble</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body" style="display: block;">
                                 <form enctype="multipart/form-data" method="post" action="{{'/immeubles/edit_immeuble/'.$immeuble->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}  
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description" value="{{$immeuble->description}}" required>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$projet->nom}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$projet->id}}" name="projet_id">
                                                
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$tranche->description}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$tranche->id}}" name="tranche_id">
                                                
                                                
                                            </div>
                                            
                                             <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$bloc->description}}" readonly>
                                                 <input type="hidden" class="form-control col-md-8"  value="{{$bloc->id}}" name="bloc_id">
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{$immeuble->titre_foncier}}">
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                          <a href="/immeubles/{{$immeuble->id}}/biens" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                          <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </section>

                @extends('includes.footer')
            </div>
            
    </body>

</html>
