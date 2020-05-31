<!DOCTYPE html>
<html lang="en">

    <head>
        @extends('includes.head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
               <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"> <b></b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                   <li class="breadcrumb-item"><a href="/projets/{{$projet->id}}/visites">Visites</a></li>
                   <li class="breadcrumb-item active">Détail</li>
                </ul>

            </nav>

            @extends('includes.nav2')
            <div class="content-wrapper">

                <section class="content" style="padding: 6px;">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-8"></div>

                                    <div class="col-md-4">
                                        <a href="{{'/visites/deuxieme_visite/'.$visite->id}}" class="btn btn-primary float-right" style="margin-left: 2%">2ème visite</a>
                                        <a href="{{'/visites/'.$projet->id.'/modifier_visite/'.$visite->id}}" class="btn btn-primary float-right" style="margin-left: 2%">Modifier</a>

                                        <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalDelete{{$visite->id }}">Supprimer</a>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                              <!-- Custom Tabs -->
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <dl class="row">
                                                        <dt class="col-sm-6">CC</dt>
                                                        <dd class="col-sm-6">{{$user->name}} {{$user->prenom}}</dd>
                                                        <dt class="col-sm-6">Date</dt>
                                                        <dd class="col-sm-6">{{ \Carbon\Carbon::parse($visite->date)->format('d/m/Y')}}</dd>
                                                        <dt class="col-sm-6">Nom</dt>
                                                        <dd class="col-sm-6">{{$visite->nom}}</dd>
                                                        <dt class="col-sm-6">Prénom</dt>
                                                        <dd class="col-sm-6">{{$visite->prenom}}</dd>
                                                        <dt class="col-sm-6">Téléphone</dt>
                                                        <dd class="col-sm-6">{{$visite->telephone}}</dd>
                                                        <dt class="col-sm-6">CIN</dt>
                                                        <dd class="col-sm-6">{{$visite->cin}}</dd>
                                                        <dt class="col-sm-6">Source</dt>
                                                        <dd class="col-sm-6">{{$visite->source}}</dd>
                                                        @if($visite->source=='Partenaire' && $visite->partenaire_id !=Null)
                                                            <dt class="col-sm-6">Partenaire</dt>
                                                            @foreach($partenaires as $partenaire)
                                                            @if($partenaire->id==$visite->partenaire_id)
                                                                <dd class="col-sm-6">{{$partenaire->nom}}</dd>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                        <dt class="col-sm-6">Intérêt</dt>
                                                        <dd class="col-sm-6">{{$visite->interet}}</dd>
                                                        @if($visite->interet=='perdu' && $visite->frein !=Null)
                                                            <dt class="col-sm-6">Frein</dt>
                                                            <dd class="col-sm-6">{{$visite->frein}}</dd>

                                                        @endif

                                                </dl>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <dl class="row">
                                                    @if($visite->interet=='intéressé')
                                                        <dt class="col-sm-6">Bien</dt>
                                                        <dd class="col-sm-6">{{$bien->propriete_dite_bien}}</dd>
                                                        <dt class="col-sm-6">Statut</dt>
                                                        <dd class="col-sm-6">{{$visite->statut}}</dd>

                                                    @endif
                                                    @if($visite->interet=='intéressé' || $visite->interet=='réceptif')
                                                        <dt class="col-sm-6">Mode de relance</dt>
                                                        <dd class="col-sm-6">{{$visite->mode_relance}}</dd>
                                                        <dt class="col-sm-6">Date de relance</dt>
                                                        <dd class="col-sm-6">{{ \Carbon\Carbon::parse($visite->prochaine_relance)->format('d/m/Y')}}</dd>

                                                    @endif
                                                    @if($visite->interet=='perdu' && isset($frein))
                                                        @foreach($frein as $fr)
                                                            @if($fr->tranche_id !=Null)
                                                                <dt class="col-sm-6">Tranche</dt>
                                                                <dd class="col-sm-6">{{$tranche->description}}</dd>
                                                            @endif
                                                            @if($fr->etage !=Null)
                                                                <dt class="col-sm-6">Etage</dt>
                                                                <dd class="col-sm-6">{{$fr->etage}}</dd>
                                                            @endif
                                                            @if($fr->orientation !=Null)
                                                                <dt class="col-sm-6">Orientation</dt>
                                                                <dd class="col-sm-6">{{$fr->orientation}}</dd>
                                                            @endif
                                                            @if($fr->avance !=Null)
                                                                <dt class="col-sm-6">Avance</dt>
                                                                <dd class="col-sm-6">{{$fr->avance}}</dd>
                                                            @endif
                                                            @if($fr->prix_min !=Null)
                                                                <dt class="col-sm-6">Prix min</dt>
                                                                <dd class="col-sm-6">{{$fr->prix_min}}</dd>
                                                            @endif
                                                            @if($fr->prix_max !=Null)
                                                                <dt class="col-sm-6">Prix max</dt>
                                                                <dd class="col-sm-6">{{$fr->prix_max}}</dd>
                                                             @endif
                                                             @if($fr->superficie_min !=Null)
                                                                <dt class="col-sm-6">Superficie min</dt>
                                                                <dd class="col-sm-6">{{$fr->superficie_min}}</dd>
                                                            @endif
                                                            @if($fr->superficie_max !=Null)
                                                                <dt class="col-sm-6">Superficie max</dt>
                                                                <dd class="col-sm-6">{{$fr->superficie_max}}</dd>
                                                             @endif

                                                        @endforeach
                                                    @endif
                                                    @if($visite->commentaire!=Null)
                                                        <dt class="col-sm-6">Commentaire</dt>
                                                        <dd class="col-sm-6">{{$visite->commentaire}}</dd>
                                                    @endif

                                                </dl>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                              <!-- ./card -->
                            </div>
                            <!-- /.col -->
                        </div>


                       <!--  <div class="row">
                            <div class="col-12">
                             
                              <div class="card">
                                <div class="card-header d-flex p-0">

                                  <ul class="nav nav-pills  p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">CA</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Nombre d'appartements</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Nombre de commerce</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Notes
                                  </ul>
                                </div>
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                                    <dl class="row">
                                                        <dt class="col-sm-6">Nom</dt>
                                                        <dd class="col-sm-6">{{$visite->nom}}</dd>
                                                        <dt class="col-sm-6">Prénom</dt>
                                                        <dd class="col-sm-6">{{$visite->prenom}}</dd>
                                                        <dt class="col-sm-6">Téléphone</dt>
                                                        <dd class="col-sm-6">{{$visite->telephone}}</dd>
                                                        <dt class="col-sm-6">CIN</dt>
                                                        <dd class="col-sm-6">{{$visite->cin}}</dd>
                                                        <dt class="col-sm-6">Source</dt>
                                                        <dd class="col-sm-6">{{$visite->source}}</dd>
                                                        @if($visite->source=='partenaire' && $visite->partenaire_id !=Null)
                                                            <dt class="col-sm-6">Partenaire</dt>
                                                            @foreach($partenaires as $partenaire)
                                                            @if($partenaire->id==$visite->partenaire_id)
                                                                <dd class="col-sm-6">{{$partenaire->nom}}</dd>
                                                            @endif
                                                            @endforeach
                                                        @endif



                                                    </dl>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_2">

                                    </div>
                                    
                                    <div class="tab-pane" id="tab_3">

                                    </div>
                                    
                                    <div class="tab-pane" id="tab_4">

                                    </div>
                                    
                                  </div>
                                 
                                </div>
                              </div>
                             
                            </div>

                        </div> -->
                    </div>
                </section>
            </div>
            <div class="modal fade" id="modalDelete{{$visite->id }}">
                <div class="modal-dialog">
                  <div class="modal-content bg-danger">
                    <div class="modal-header">
                      <h4 class="modal-title">Attention</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous certain(e) de vouloir supprimer cette visite ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <a href="{{'/visites/supprimer_visite/' . $visite->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>

                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
            </div>
            @extends('includes.footer')
        </div>


    <script src="/plugins/jquery/jquery.min.js"></script>


    </body>

</html>
