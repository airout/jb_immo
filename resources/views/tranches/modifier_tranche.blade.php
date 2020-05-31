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
            <a class="nav-link"> <b>Modifier Tranche</b> </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <!-- Notifications Dropdown Menu -->
            <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
            @isset($projet)
              <li class="breadcrumb-item "><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
            @endisset
            <li class="breadcrumb-item "><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
            
            <li class="breadcrumb-item active">Modifier</li>
        </ul>
        <!-- Right navbar links -->
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @extends('includes.nav2')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
         <!-- /.content-header -->
         <section class="content" style="padding: 6px;">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tranche</h3>

                        <div class="card-tools">
                           <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        @if(isset($projet))
                           <form enctype="multipart/form-data" method="post" action="{{'/projets/'.$projet->id.'/edit_tranche/'.$tranche->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}  
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description" value="{{$tranche->description}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                @if(isset($projet))
                                                  <input type="text" class="form-control col-md-8"  value="{{$projet->nom}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$projet->id}}" name="projet_id">
                                                @else
                                                  <input type="text" class="form-control col-md-8"  value="{{$nom_projet}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$id_projet}}" name="projet_id">
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau d'étages</label>
                                                <input type="number" class="form-control col-md-8" name="niveau_etages" value="{{$tranche->niveau_etages}}" required>
                                            </div>
                                             
                                            <div class="form-group row">
                                                <label class="col-md-4">Date de livraison</label>
                                                <input type="date" class="form-control col-md-8" name="date_livraison" value="{{$tranche->date_livraison}}">
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                          <a href="{{'/projets/'.$projet->id.'/tranches'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                          <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                            
                                        </div>
                                    </div>
                            </form>
                          @else
                            <form enctype="multipart/form-data" method="post" action="{{'/tranches/edit_tranche/'.$tranche->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}  
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description" value="{{$tranche->description}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                @if(isset($projet))
                                                  <input type="text" class="form-control col-md-8"  value="{{$projet->nom}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$projet->id}}" name="projet_id">
                                                @else
                                                  <input type="text" class="form-control col-md-8"  value="{{$nom_projet}}" readonly>
                                                  <input type="hidden" class="form-control col-md-8"  value="{{$id_projet}}" name="projet_id">
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau d'étages</label>
                                                <input type="number" class="form-control col-md-8" name="niveau_etages" value="{{$tranche->niveau_etages}}" required>
                                            </div>
                                             
                                            <div class="form-group row">
                                                <label class="col-md-4">Date de livraison</label>
                                                <input type="date" class="form-control col-md-8" name="date_livraison" value="{{$tranche->date_livraison}}">
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                          <a href="/tranches" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                          <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                            
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
