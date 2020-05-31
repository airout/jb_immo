<!DOCTYPE html>
<html lang="en">

  <head>
    @extends('includes.head')
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link"> <b>Nouveau Projet</b> </a>
              </li>
            </ul>

            <ul class="navbar-nav ml-auto">
              <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
                <li class="breadcrumb-item active">Nouveau projet</li>
            </ul>
        </nav>
        @extends('includes.nav')
        <div class="content-wrapper">
            <section class="content" style="padding:9px">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                  class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div> @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li> {{$error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br />
                                @endif</div>
                          <form enctype="multipart/form-data" method="post" action="/projets/add_projet">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4">Nom *</label>
                                            <input class="col-md-8 form-control" type="text" name="nom"  value="{{old('nom')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Code *</label>
                                            <input type="text" class="form-control col-md-8" name="code"  value="{{old('code')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Type de Projet*</label>
                                            <select class="form-control col-md-8" style="width: 100%;" name="type">
                                              <option></option>
                                               <option value="social" {{ old('type') == 'social' ? 'selected' : '' }}>Social</option>
                                                <option value="economique" {{ old('type') == 'economique' ? 'selected' : '' }}>Economique</option>
                                                <option value="moyen_standing" {{ old('type') == 'moyen_standing' ? 'selected' : '' }}>Moyen standing</option>
                                                <option value="haut_standing" {{ old('type') == 'haut_standing' ? 'selected' : '' }}>Haut standing</option>
                                              <option value="lot" {{ old('type') == 'lot' ? 'selected' : '' }}>Lot de terrain</option>

                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4">Adresse</label>
                                            <input type="text" class="form-control col-md-8" name="adresse" value="{{old('adresse')}}" >
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Prolongation de réservation*</label>
                                            <input type="number" class="form-control col-md-8" name="prolongation_reservation"  value="{{old('prolongation_reservation')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Limite d'annulation de réservation*</label>
                                            <input type="number" class="form-control col-md-8" name="limite_annulation_reservation" value="{{old('limite_annulation_reservation')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Propriété dite projet</label>
                                            <input type="text" class="form-control col-md-8" name="propriete_dite_projet" value="{{old('propriete_dite_projet')}}">
                                        </div>

                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-4">Date autorisation construction</label>
                                            <input type="date" class="form-control col-md-8" name="date_autorisation_construction" value="{{old('date_autorisation_construction')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Date permis d'habiter</label>
                                            <input type="date" class="form-control col-md-8" name="date_permis_habiter"  value="{{old('date_permis_habiter')}}">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4">Titre foncier</label>
                                            <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}" >
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-4">Surface terrain</label>
                                            <input type="text" class="form-control col-md-8" name="surface_terrain" value="{{old('surface_terrain')}}" >
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Montant min</label>
                                            <input type="text" class="form-control col-md-8" name="montant_min" placeholder="0" value="{{old('montant_min')}}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Nombre de jours pour remboursement</label>
                                            <input type="number" class="form-control col-md-8" name="nbre_jour_remboursement" value="{{old('nbre_jour_remboursement')}}">
                                        </div>
                                    </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <a href="/home" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                  <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">
                                </div>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            </section>
          @extends('includes.footer')

        </div>
    </div>


  </body>

</html>
