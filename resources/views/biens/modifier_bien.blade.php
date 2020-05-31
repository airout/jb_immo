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
                    <a class="nav-link"> <b>Modifier Bien</b> </a>
                  </li>
                </ul>
        
                <ul class="navbar-nav ml-auto">
                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    <li class="breadcrumb-item "><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    <li class="breadcrumb-item "><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    <li class="breadcrumb-item "><a href="/blocs/detail/{{$bloc->id}}">{{$bloc->description}}</a></li>
                    <li class="breadcrumb-item "><a href="/immeubles/detail/{{$immeuble->id}}">{{$immeuble->description}}</a></li>
                    <li class="breadcrumb-item "><a href="/biens/detail/{{$bien->id}}">{{$bien->propriete_dite_bien}}</a></li>
                    <li class="breadcrumb-item active">Modifier</li>
                </ul>
                
            </nav>
            

            @extends('includes.nav2')
            <div class="content-wrapper">
                <section class="content" style="padding: 6px;">
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
                                <form enctype="multipart/form-data" method="post" action="{{'/biens/edit_bien/'.$bien->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}  
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$projet->nom}}" readonly>
                                                <input type="hidden" name="projet_id" value="{{$projet->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$tranche->description}}" readonly>
                                                <input type="hidden" name="tranche_id" value="{{$tranche->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Bloc</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$bloc->description}}" readonly>
                                                <input type="hidden" name="bloc_id" value="{{$bloc->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble</label>
                                                <input type="text" class=" form-control col-md-8" value="{{$immeuble->description}}" readonly>
                                                <input type="hidden" name="immeuble_id" value="{{$immeuble->id}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{$immeuble->titre_foncier}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Commentaire</label>
                                                <textarea class="form-control col-md-8" name="commentaire"  rows="5">{{$immeuble->commentaire}}</textarea>
                                                
                                            </div>
                                             
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-4">Propriété dite du bien</label>
                                                <input type="text" class="form-control col-md-8" name="propriete_dite_bien" value="{{$bien->propriete_dite_bien}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Numéro</label>
                                                <input type="number" class="form-control col-md-8" name="numero" value="{{$bien->numero}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Niveau</label>
                                                <select class="form-control col-md-8" name="niveau" required>
                                                    <option></option>
                                                    @for($i=0; $i<=$tranche->niveau_etages; $i++)
                                                        <option value="{{$i}}" @if($bien->niveau==$i){{'selected'}}@endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Type</label>
                                                <select class="form-control col-md-8" name ="type" required>
                                                    <option value=""></option>
                                                    <option value="F1" @if($bien->type=='F1'){{'selected'}}@endif>F1</option>
                                                    <option value="F2" @if($bien->type=='F2'){{'selected'}}@endif>F2</option>
                                                    <option value="F3" @if($bien->type=='F3'){{'selected'}}@endif>F3</option>
                                                    <option value="F4" @if($bien->type=='F4'){{'selected'}}@endif>F4</option>
                                                    <option value="F5" @if($bien->type=='F5'){{'selected'}}@endif>F5</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>
                                                <input type="text" class="form-control col-md-8" name="superficie" value="{{$bien->superficie}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>
                                                <input type="text" class="form-control col-md-8" name="prix" value="{{$bien->prix}}" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select class="form-control col-md-8" name="orientation" required>
                                                    
                                                    <option value=""></option>
                                                    <option value="N" @if($bien->orientation=='E'){{'selected'}}@endif>N</option>
                                                    <option value="E" @if($bien->orientation=='E'){{'selected'}}@endif>E</option>
                                                    <option value="S" @if($bien->orientation=='S'){{'selected'}}@endif>S</option>
                                                    <option value="O" @if($bien->orientation=='O'){{'selected'}}@endif>O</option>
                                                    <option value="N/E" @if($bien->orientation=='N/E'){{'selected'}}@endif>N/E</option>
                                                    <option value="N/O" @if($bien->orientation=='N/O'){{'selected'}}@endif>N/O</option>
                                                    <option value="N/S" @if($bien->orientation=='N/S'){{'selected'}}@endif>N/S</option>
                                                    <option value="O/E" @if($bien->orientation=='O/E'){{'selected'}}@endif>O/E</option>
                                                    <option value="O/S" @if($bien->orientation=='O/S'){{'selected'}}@endif>O/S</option>
                                                    <option value="E/S" @if($bien->orientation=='E/S'){{'selected'}}@endif>E/S</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Avance Min</label>
                                                <input type="text" class="form-control col-md-8" name="avance_min" value="{{$bien->avance_min}}" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="conventionne" @if($bien->conventionne==1){{'checked'}}@endif>
                                                    <label for="customCheckbox1" >
                                                        Conventionné</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{'/immeubles/detail/'.$immeuble->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                                
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.row -->

                        </div>
                    </div>
                </section>

                @extends('includes.footer')
            </div>
            
    </body>

</html>
