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
                    <a class="nav-link"> <b>{{$bien->propriete_dite_bien}}</b> </a>
                  </li>
                </ul>
        
                <ul class="navbar-nav ml-auto">
                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    <li class="breadcrumb-item"><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    <li class="breadcrumb-item"><a href="/blocs/detail/{{$bloc->id}}">{{$bloc->description}}</a></li>
                    <li class="breadcrumb-item"><a href="/immeubles/detail/{{$immeuble->id}}">{{$immeuble->description}}</a></li>
                    <li class="breadcrumb-item active">{{$bien->propriete_dite_bien}}</li>
                </ul>
                <!-- Right navbar links -->
            </nav>
            
              @extends('includes.nav2')

            <div class="modal fade" id="modalDeleteBien{{$bien->id}}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer ce bien ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                      
                        <a href="{{'/biens/supprimer_bien/'. $bien->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
                      
                    </div>
                  </div>
                </div>
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
                                        <a href="{{'/biens/modifier_bien/'.$bien->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>
                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDeleteBien{{$bien->id }}">Supprimer</a>
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
                                                    <dt class="col-sm-6">Proptieté dite du bien</dt>
                                                    <dd class="col-sm-6">{{$bien->propriete_dite_bien}}</dd>
                                                    <dt class="col-sm-6">Numéro</dt>
                                                    <dd class="col-sm-6">{{$bien->numero}}</dd>
                                                    <dt class="col-sm-6">Avance Min</dt>
                                                    <dd class="col-sm-6">{{$bien->avance_min}}</dd>
                                                    <dt class="col-sm-6">Montant encaissé (%)</dt>
                                                    <dd class="col-sm-6"></dd>
                                                    
                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    <dt class="col-sm-6">Projet</dt>
                                                    <dd class="col-sm-6">{{$projet->nom}}</dd>
                                                    <dt class="col-sm-6">Tranche</dt>
                                                    <dd class="col-sm-6">{{$tranche->description}}</dd>
                                                    <dt class="col-sm-6">Bloc</dt>
                                                    <dd class="col-sm-6">{{$bloc->description}}</dd>
                                                    <dt class="col-sm-6">Immeuble</dt>
                                                    <dd class="col-sm-6">{{$immeuble->description}}</dd>
                                                    
                                                </dl> 
                                            </div>

                                        </div>
                                    
                                    </div>

                                </div>
                              <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <!-- Custom Tabs -->
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                      
                                      <ul class="nav nav-pills  p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Information</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Surfaces</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">CA</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Dossiers</a></li>
                                        
                                      </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    <dl class="col-md-6 row">
                                                        <dt class="col-sm-6">Réservé</dt>
                                                        <dd class="col-sm-6"><input type="checkbox" name="reserve" @if($bien->etat=='reserve'){{'checked'}}@endif></dd>
                                                        <dt class="col-sm-6">Conventionné</dt>
                                                        <dd class="col-sm-6"><input type="checkbox" name="conventionne" @if($bien->conventionne==1){{'checked'}}@endif></dd>
                                                        <dt class="col-sm-6">Type</dt>
                                                        <dd class="col-sm-6">{{$bien->type}}</dd>
                                                        <dt class="col-sm-6">Orientation</dt>
                                                        <dd class="col-sm-6">{{$bien->orientation}}</dd>
                                                        <dt class="col-sm-6">Superficie</dt>
                                                        <dd class="col-sm-6">{{$bien->superficie}}</dd>
                                                        <dt class="col-sm-6">Prix</dt>
                                                        <dd class="col-sm-6">{{$bien->prix}}</dd>
                                                        
                                                        
                                                    </dl>
                                                    <dl class="col-md-6 row">
                                                        <dt class="col-sm-6">Titre foncier</dt>
                                                        <dd class="col-sm-6">{{$bien->titre_foncier}}</dd>
                                                        <dt class="col-sm-6">Titre foncier parent</dt>
                                                        <dd class="col-sm-6">{{$projet->titre_foncier}}</dd>
                                                        
                                                    </dl>

                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">
                                       
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_3">
                                           
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_4">
                                           
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>

                    </div><!-- /.container-fluid -->
                </section>
            </div>
            @extends('includes.footer')
        </div>
        
    </body>

</html>
