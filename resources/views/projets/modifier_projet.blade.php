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
            <a class="nav-link"> <b>Modifier Projet</b> </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
          <li class="breadcrumb-item "><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
          <li class="breadcrumb-item active">Modifier</li>
        </ul>
        <!-- Right navbar links -->
      </nav>
      <!-- /.navbar -->

      @extends('includes.nav2')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        
        <!-- /.content-header -->
        <section class="content" style="padding: 6px;">
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
              <div class="card-body" style="display: block;">
                <form enctype="multipart/form-data" method="post" action="{{url('/projets/edit_projet/'.$projet->id)}}">
                  {{csrf_field()}}
                  {{ method_field('PUT')}} 
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4">Nom *</label>
                                            <input class="col-md-8 form-control" type="text" name="nom" value="{{$projet->nom}}" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Code *</label>
                                            <input type="text" class="form-control col-md-8" name="code" value="{{$projet->code}}" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Type de Projet*</label>
                                            <select class="form-control col-md-8" style="width: 100%;" name="type" required>
                                              <option></option>
                                              <option value="social" @if($projet->type=='social') {{'selected'}} @endif>Social</option>
                                              <option value="economique" @if($projet->type=='economique') {{'selected'}} @endif>Economique</option>
                                              <option value="moyen_standing" @if($projet->type=='moyen_standing') {{'selected'}} @endif>Moyen standing</option>
                                              <option value="haut_standing" @if($projet->type=='haut_standing') {{'selected'}} @endif>Haut standing</option>
                                              <option value="lot" @if($projet->type=='lot') {{'selected'}} @endif>Lot de terrain</option>
                                              
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Adresse*</label>
                                            <input type="text" class="form-control col-md-8" name="adresse" value="{{$projet->adresse}}">
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4">Prolongation de réservation*</label>
                                            <input type="number" class="form-control col-md-8" name="prolongation_reservation" value="{{$projet->prolongation_reservation}}" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Limite d'annulation de réservation*</label>
                                            <input type="number" class="form-control col-md-8" name="limite_annulation_reservation" value="{{$projet->limite_annulation_reservation}}" required>
                                        </div>
                                        
                                         <div class="form-group row">
                                            <label class="col-md-4">Propriété dite projet</label>
                                            <input type="text" class="form-control col-md-8" name="propriete_dite_projet" value="{{$projet->propriete_dite_projet}}">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-4">Date autorisation de construction</label>
                                            <input type="date" class="form-control col-md-8" name="date_autorisation_construction" value="{{$projet->date_autorisation_construction}}" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Date permis d'habiter</label>
                                            <input type="date" class="form-control col-md-8" name="date_permis_habiter" value="{{$projet->date_permis_habiter}}" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Titre foncier</label>
                                            <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{$projet->titre_foncier}}">
                                        </div>
                                        
                                        
                                       
                                        <div class="form-group row">
                                            <label class="col-md-4">Surface terrain</label>
                                            <input type="text" class="form-control col-md-8" name="surface_terrain" value="{{$projet->surface_terrain}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Montant min</label>
                                            <input type="text" class="form-control col-md-8" name="montant_min" value="{{$projet->montant_min}}" placeholder="0">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Nombre de jours pour remboursement</label>
                                            <input type="number" class="form-control col-md-8" name="nbre_jour_remboursement" value="{{$projet->nbre_jour_remboursement}}">
                                        </div>
                                    </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <a href="/projets" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                  <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                </div>
                              </div>
                </form>

            </div>
          </div>
        </section>

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        @extends('includes.footer')
      </div>
    </div>
      
  </body>

</html>
