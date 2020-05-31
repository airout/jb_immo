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
            <a class="nav-link"> <b>Ajouter Bien</b> </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">

                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    @if(isset($proj))
                        <li class="breadcrumb-item"><a href="/projets/detail/{{$proj->id}}">{{$proj->nom}}</a></li>
                    @elseif(isset($projet))
                        <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    @endif
                    @if(isset($tr))
                        <li class="breadcrumb-item"><a href="/tranches/detail/{{$tr->id}}">{{$tr->description}}</a></li>
                    @elseif(isset($tranche))
                        <li class="breadcrumb-item"><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    @endif
                    @if(isset($blc))
                        <li class="breadcrumb-item"><a href="/blocs/detail/{{$blc->id}}">{{$blc->description}}</a></li>
                    @elseif(isset($bloc))
                        <li class="breadcrumb-item"><a href="/blocs/detail/{{$bloc->id}}">{{$bloc->description}}</a></li>
                    @endif
                    @if(isset($immeuble))
                        <li class="breadcrumb-item"><a href="/immeubles/detail/{{$immeuble->id}}">{{$immeuble->description}}</a></li>
                    @endif
                    <li class="breadcrumb-item active">Nouveau Bien</li>

        </ul>
        <!-- Right navbar links -->
      </nav>

        @extends('includes.nav2')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- /.content-header -->
                <section class="content" style="padding: 9px;">
                    <div class="container-fluid">
                        <!-- SELECT2 EXAMPLE -->
                        <div class="card card-primary">
                            <div class="card-header">

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
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
                                @if(isset($projet))
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/addBienByProjet/'.$projet->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="hidden" name="projet_id" value="{{$projet->id}}">
                                                <input type="text" class="form-control col-md-8" value="{{$projet->nom}}" readonly>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <select id="tranche" class="form-control col-md-8" name="tranche_id">
                                                    <option></option>
                                                    @foreach($tranches as $tranche)
                                                    <option value="{{$tranche->id}}"  {{ old('tranche_id') == $tranche->id ? "selected" : "" }}>{{$tranche->description}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <select id="bloc" class="form-control col-md-8" name="bloc_id" value="{{old('bloc_id')}}" >
                                                    <option value=""  ></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <select id="immeuble" class="form-control col-md-8" name="immeuble_id" value="{{old('immeuble_id')}}">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire" rows="5"  >{{old('commentaire')}}</textarea>

                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien" value="{{old('propriete_dite_bien')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero" value="{{old('numero')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select id="niveau" class="form-control col-md-8" name="niveau" value="{{old('niveau')}}">

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type" value="{{old('type')}}">
                                                    <option value=""></option>
                                                    <option value="F1" {{ old('type') == 'F1' ? 'selected' : '' }}>F1</option>
                                                    <option value="F2" {{ old('type') == 'F2' ? 'selected' : '' }}>F2</option>
                                                    <option value="F3" {{ old('type') == 'F3' ? 'selected' : '' }}>F3</option>
                                                    <option value="F4" {{ old('type') == 'F4' ? 'selected' : '' }}>F4</option>
                                                    <option value="F5" {{ old('type') == 'F5' ? 'selected' : '' }}>F5</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie" value="{{old('superficie')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix"  value="{{old('prix')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation" value="{{old('orientation')}}">
                                                    <option value=""></option>
                                                    <option value="N" {{ old('orientation') == 'N' ? 'selected' : '' }}>N</option>
                                                    <option value="E" {{ old('orientation') == 'E' ? 'selected' : '' }}>E</option>
                                                    <option value="S" {{ old('orientation') == 'S' ? 'selected' : '' }}>S</option>
                                                    <option value="O" {{ old('orientation') == 'O' ? 'selected' : '' }}>O</option>
                                                    <option value="N/E" {{ old('orientation') == 'N/E' ? 'selected' : '' }}>N/E</option>
                                                    <option value="N/O" {{ old('orientation') == 'N/O' ? 'selected' : '' }}>N/O</option>
                                                    <option value="N/S" {{ old('orientation') == 'N/S' ? 'selected' : '' }}>N/S</option>
                                                    <option value="O/E" {{ old('orientation') == 'O/E' ? 'selected' : '' }}>O/E</option>
                                                    <option value="O/S" {{ old('orientation') == 'O/S' ? 'selected' : '' }}>O/S</option>
                                                    <option value="E/S" {{ old('orientation') == 'E/S' ? 'selected' : '' }}>E/S</option>
                                                </select>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min" value="{{old('avance_min')}}">
                                            </div>
                                             <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne" value="1" {{ old('conventionne') == '1' ? 'checked' : '' }}>
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/projets/detail/'.$projet->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @elseif(isset($tranche))
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/addBienByTranche/'.$tranche->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$proj->nom}}" readonly>
                                                <input type="hidden" name="projet_id" value="{{$proj->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$tranche->description}}" readonly>
                                                <input type="hidden" name="tranche_id" value="{{$tranche->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <select id="bloc" class="form-control col-md-8" name="bloc_id" value="{{old('bloc_id')}}">
                                                    <option value=""></option>
                                                    @foreach($blocs as $bloc)
                                                        <option value="{{$bloc->id}}"  {{ old('bloc_id') == $bloc->id ? "selected" : "" }}>{{$bloc->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <select id="immeuble" class="form-control col-md-8" name="immeuble_id" value="{{old('immeuble_id')}}">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire" rows="5" >{{old('commentaire')}}</textarea>

                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>

                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien" value="{{old('propriete_dite_bien')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero"  value="{{old('numero')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select class="form-control col-md-8" name="niveau"  value="{{old('niveau')}}">
                                                    <option></option>
                                                    @for($i=0; $i<=$tranche->niveau_etages; $i++)
                                                        <option value="{{$i}}"  {{ old('niveau') == $i ? "selected" : "" }}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type"  value="{{old('type')}}">
                                                    <option value=""></option>
                                                    <option value="F1" {{ old('type') == 'F1' ? 'selected' : '' }}>F1</option>
                                                    <option value="F2" {{ old('type') == 'F2' ? 'selected' : '' }}>F2</option>
                                                    <option value="F3" {{ old('type') == 'F3' ? 'selected' : '' }}>F3</option>
                                                    <option value="F4" {{ old('type') == 'F4' ? 'selected' : '' }}>F4</option>
                                                    <option value="F5" {{ old('type') == 'F5' ? 'selected' : '' }}>F5</option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie"  value="{{old('superficie')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix"  value="{{old('prix')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation"  value="{{old('orientation')}}">

                                                    <option value=""></option>
                                                    <option value="N" {{ old('orientation') == 'N' ? 'selected' : '' }}>N</option>
                                                    <option value="E" {{ old('orientation') == 'E' ? 'selected' : '' }}>E</option>
                                                    <option value="S" {{ old('orientation') == 'S' ? 'selected' : '' }}>S</option>
                                                    <option value="O" {{ old('orientation') == 'O' ? 'selected' : '' }}>O</option>
                                                    <option value="N/E" {{ old('orientation') == 'N/E' ? 'selected' : '' }}>N/E</option>
                                                    <option value="N/O" {{ old('orientation') == 'N/O' ? 'selected' : '' }}>N/O</option>
                                                    <option value="N/S" {{ old('orientation') == 'N/S' ? 'selected' : '' }}>N/S</option>
                                                    <option value="O/E" {{ old('orientation') == 'O/E' ? 'selected' : '' }}>O/E</option>
                                                    <option value="O/S" {{ old('orientation') == 'O/S' ? 'selected' : '' }}>O/S</option>
                                                    <option value="E/S" {{ old('orientation') == 'E/S' ? 'selected' : '' }}>E/S</option>
                                                </select>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min" value="{{old('avance_min')}}">
                                            </div>
                                             <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne" {{ old('conventionne') == '1' ? 'checked' : '' }} >
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/tranches/detail/'.$tranche->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @elseif(isset($bloc))
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/addBienByBloc/'.$bloc->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$proj->nom}}" readonly>
                                                <input type="hidden" name="projet_id" value="{{$proj->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$tr->description}}" readonly>
                                                <input type="hidden" name="tranche_id" value="{{$tr->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$bloc->description}}" readonly>
                                                <input type="hidden" name="bloc_id" value="{{$bloc->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <select class="form-control col-md-8" name="immeuble_id"  value="{{old('immeuble_id')}}">
                                                    <option value=""></option>
                                                    @foreach($immeubles as $immeuble)
                                                        <option value="{{$immeuble->id}}" {{ old('immeuble_id') == $immeuble->id ? "selected" : "" }} >{{$immeuble->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier"  value="{{old('titre_foncier')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire" rows="5"  >{{old('commentaire')}}</textarea>

                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien"  value="{{old('propriete_dite_bien')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero"  value="{{old('numero')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select class="form-control col-md-8" name="niveau"  >
                                                    @for($i=0; $i<=$tr->niveau_etages; $i++)
                                                        <option value="{{$i}}" {{ old('niveau') == $i ? "selected" : "" }}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type"  value="{{old('type')}}">
                                                    <option value=""></option>
                                                    <option value="F1" {{ old('type') == 'F1' ? 'selected' : '' }}>F1</option>
                                                    <option value="F2" {{ old('type') == 'F2' ? 'selected' : '' }}>F2</option>
                                                    <option value="F3" {{ old('type') == 'F3' ? 'selected' : '' }}>F3</option>
                                                    <option value="F4" {{ old('type') == 'F4' ? 'selected' : '' }}>F4</option>
                                                    <option value="F5" {{ old('type') == 'F5' ? 'selected' : '' }}>F5</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie"  value="{{old('superficie')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix"  value="{{old('prix')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation"  value="{{old('orientation')}}">

                                                     <option value=""></option>
                                                    <option value="N">N</option>
                                                    <option value="E">E</option>
                                                    <option value="S">S</option>
                                                    <option value="O">O</option>
                                                    <option value="N/E">N/E</option>
                                                    <option value="N/O">N/O</option>
                                                    <option value="N/S">N/S</option>
                                                    <option value="O/E">O/E</option>
                                                    <option value="O/S">O/S</option>
                                                    <option value="E/S">E/S</option>
                                                </select>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min"  value="{{old('avance_min')}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne" {{ old('conventionne') == '1' ? 'checked' : '' }}>
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/blocs/detail/'.$bloc->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @elseif(isset($immeuble))
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/addBienByImmeuble/'.$immeuble->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$proj->nom}}" readonly>
                                                <input type="hidden" name="projet_id" value="{{$proj->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$tr->description}}" readonly>
                                                <input type="hidden" name="tranche_id" value="{{$tr->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$blc->description}}" readonly>
                                                <input type="hidden" name="bloc_id" value="{{$blc->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$immeuble->description}}" readonly>
                                                <input type="hidden" name="immeuble_id" value="{{$immeuble->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier"  value="{{old('titre_foncier')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire" rows="5"  >{{old('commentaire')}}</textarea>

                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien"  value="{{old('propriete_dite_bien')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero"  value="{{old('numero')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select class="form-control col-md-8" name="niveau"  value="{{old('niveau')}}">
                                                    <option></option>
                                                    @for($i=0; $i<=$tr->niveau_etages; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type"  value="{{old('type')}}">
                                                    <option value=""></option>
                                                    <option value="F1" {{ old('type') == 'F1' ? 'selected' : '' }}>F1</option>
                                                    <option value="F2" {{ old('type') == 'F2' ? 'selected' : '' }}>F2</option>
                                                    <option value="F3" {{ old('type') == 'F3' ? 'selected' : '' }}>F3</option>
                                                    <option value="F4" {{ old('type') == 'F4' ? 'selected' : '' }}>F4</option>
                                                    <option value="F5" {{ old('type') == 'F5' ? 'selected' : '' }}>F5</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie"  value="{{old('superficie')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix"  value="{{old('prix')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation"  value="{{old('orientation')}}">

                                                    <option value=""></option>
                                                    <option value="N" {{ old('orientation') == 'N' ? 'selected' : '' }}>N</option>
                                                    <option value="E" {{ old('orientation') == 'E' ? 'selected' : '' }}>E</option>
                                                    <option value="S" {{ old('orientation') == 'S' ? 'selected' : '' }}>S</option>
                                                    <option value="O" {{ old('orientation') == 'O' ? 'selected' : '' }}>O</option>
                                                    <option value="N/E" {{ old('orientation') == 'N/E' ? 'selected' : '' }}>N/E</option>
                                                    <option value="N/O" {{ old('orientation') == 'N/O' ? 'selected' : '' }}>N/O</option>
                                                    <option value="N/S" {{ old('orientation') == 'N/S' ? 'selected' : '' }}>N/S</option>
                                                    <option value="O/E" {{ old('orientation') == 'O/E' ? 'selected' : '' }}>O/E</option>
                                                    <option value="O/S" {{ old('orientation') == 'O/S' ? 'selected' : '' }}>O/S</option>
                                                    <option value="E/S" {{ old('orientation') == 'E/S' ? 'selected' : '' }}>E/S</option>
                                                </select>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min" value="{{old('avance_min')}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne"  {{ old('conventionne') == '1' ? 'checked' : '' }} >
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/immeubles/detail/'.$immeuble->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @else
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/add_bien'}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <select id="projet" class="form-control col-md-8" name="projet_id"  value="{{old('projet_id')}}">
                                                    <option></option>
                                                    @foreach($projets as $projet)
                                                        <option value="{{$projet->id}}" {{ old('projet_id') == $projet->id ? "selected" : "" }}>{{$projet->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <select id="tranche" class="form-control col-md-8" name="tranche_id"  value="{{old('tranche_id')}}">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <select id="bloc" class="form-control col-md-8" name="bloc_id"  value="{{old('bloc_id')}}">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <select id="immeuble" class="form-control col-md-8" name="immeuble_id"  value="{{old('immeuble_id')}}">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier"  value="{{old('titre_foncier')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire" rows="5"  >{{old('commentaire')}}</textarea>

                                            </div>

                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien"  value="{{old('propriete_dite_bien')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero"  value="{{old('numero')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select id="niveau" class="form-control col-md-8" name="niveau"  value="{{old('niveau')}}">
                                                    <option></option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type"  value="{{old('type')}}">
                                                    <option value=""></option>
                                                    <option value="F1" {{ old('type') == 'F1' ? 'selected' : '' }}>F1</option>
                                                    <option value="F2" {{ old('type') == 'F2' ? 'selected' : '' }}>F2</option>
                                                    <option value="F3" {{ old('type') == 'F3' ? 'selected' : '' }}>F3</option>
                                                    <option value="F4" {{ old('type') == 'F4' ? 'selected' : '' }}>F4</option>
                                                    <option value="F5" {{ old('type') == 'F5' ? 'selected' : '' }}>F5</option>

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie"  value="{{old('superficie')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix"  value="{{old('prix')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation"  value="{{old('orientation')}}">

                                                    <option value=""></option>
                                                    <option value="N" {{ old('orientation') == 'N' ? 'selected' : '' }}>N</option>
                                                    <option value="E" {{ old('orientation') == 'E' ? 'selected' : '' }}>E</option>
                                                    <option value="S" {{ old('orientation') == 'S' ? 'selected' : '' }}>S</option>
                                                    <option value="O" {{ old('orientation') == 'O' ? 'selected' : '' }}>O</option>
                                                    <option value="N/E" {{ old('orientation') == 'N/E' ? 'selected' : '' }}>N/E</option>
                                                    <option value="N/O" {{ old('orientation') == 'N/O' ? 'selected' : '' }}>N/O</option>
                                                    <option value="N/S" {{ old('orientation') == 'N/S' ? 'selected' : '' }}>N/S</option>
                                                    <option value="O/E" {{ old('orientation') == 'O/E' ? 'selected' : '' }}>O/E</option>
                                                    <option value="O/S" {{ old('orientation') == 'O/S' ? 'selected' : '' }}>O/S</option>
                                                    <option value="E/S" {{ old('orientation') == 'E/S' ? 'selected' : '' }}>E/S</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min" value="{{old('avance_min')}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne"{{ old('conventionne') == '1' ? 'checked' : '' }}>
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/immeubles'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                            <!-- /.row -->

                        </div>
                    </div>
                </section>

              @extends('includes.footer')

            </div>

        <script src="/plugins/jquery/jquery.min.js"></script>

        <script type="text/javascript">
            var token="{{Session::token()}}";
            $('#projet').on('change', function () {
                var projet_id = this.selectedOptions[0].value;
                $.ajax({

                    type: 'POST',
                    url: '/biens/getTranchesByProjetId',
                    data: {projet_id:projet_id,_token:token},
                     dataType: 'JSON',
                    success: function(data){
                        $('#tranche').empty();
                        $('#tranche').append('<option></option>');
                        for (var i = 0; i< data.length; i++) {
                           $('#tranche').append('<option value='+data[i].id+'>'+data[i].description+'</option')
                        }

                    }

                });
            });
            $('#tranche').on('change', function () {
                var tranche_id = this.selectedOptions[0].value;
                $.ajax({

                    type: 'POST',
                    url: '/biens/getBlocsByTrancheId',
                    data: {tranche_id:tranche_id,_token:token},
                     dataType: 'JSON',
                    success: function(data){
                        $('#bloc').empty();
                        $('#bloc').append('<option></option>');
                        for (var i = 0; i< data.length; i++) {
                           $('#bloc').append('<option value='+data[i].id+'>'+data[i].description+'</option')
                        }

                    }

                });
                $.ajax({

                    type: 'POST',
                    url: '/biens/getNiveauByTrancheId',
                    data: {tranche_id:tranche_id,_token:token},
                     dataType: 'JSON',
                    success: function(data){
                        $('#niveau').empty();
                        $('#niveau').append('<option></option>');
                        for (var i = 0; i<= data.niveau_etages; i++) {
                           $('#niveau').append('<option value='+i+'>'+i+'</option')
                        }

                    }

                });
            });
            $('#bloc').on('change', function () {
                var bloc_id = this.selectedOptions[0].value;
                $.ajax({

                    type: 'POST',
                    url: '/biens/getImmeublesByBlocId',
                    data: {bloc_id:bloc_id,_token:token},
                     dataType: 'JSON',
                    success: function(data){
                        $('#immeuble').empty();
                        $('#immeuble').append('<option></option>');
                        for (var i = 0; i< data.length; i++) {
                           $('#immeuble').append('<option value='+data[i].id+'>'+data[i].description+'</option')
                        }

                    }

                });
            });
        </script>
    </body>

</html>
