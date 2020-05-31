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
            <a class="nav-link"> <b>Liste des visites</b> </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <!-- Notifications Dropdown Menu -->
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">visites</li>

        </ul>
        <!-- Right navbar links -->
      </nav>


      @foreach($visites as $visite)
      <div class="modal fade" id="modalDeleteVisite{{$visite->id }}">
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
        <!-- /.modal-dialog -->
      </div>
      @endforeach


       @extends('includes.nav2')

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header" >
         <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
          <div class="container-fluid">
            <div class="card card-primary">

              <div class="card-body" >
                <div class="row">
                  <div class="col-2">
                    <!-- button de creer_programme -->
                    <a href="/projets/{{$projet->id}}/nouvelle_visite"><button type="button"
                        class="btn btn-block btn-primary btn-flat">Ajouter Visite</button></a>
                  </div>
                  <div class="col-2">
                    <a href="#"> <button type="button"
                        class="btn btn-block btn-outline-secondary btn-flat">Importer</button></a>
                  </div>
                  <div class="col-4">

                  </div>
                  <div class="col-4">
                    <div class="card-tools">
                      <div class="input-group input-group-sm">
                        <input id="search" style="height: 40px;" type="text" name="table_search" class="form-control float-right"
                          placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
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

                          <th>cc</th>
                          <th>Date</th>
                          <th>Nom</th>
                          <th>Prénom</th>
                          <th>Téléphone</th>
                          <th>Source</th>
                          <th>Intérêt</th>
                          <th>Bien</th>
                          <th>Statut</th>
                          <th>Prochaine relance</th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody id="tbody">
                        @foreach($visites as $visite)
                          <tr>
                            <td>
                              @foreach($users as $user)
                              @if($user->id==$visite->cc_id)
                                {{$user->name}} {{$user->prenom}}
                              @endif
                              @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($visite->date)->format('d/m/Y')}}</td>
                            <td>{{$visite->nom}}</td>
                            <td>{{$visite->prenom}}</td>
                            <td>{{$visite->telephone}}</td>
                            <td>{{$visite->source}}</td>
                            <td>{{$visite->interet}}</td>
                            <td>
                              @foreach($biens as $bien)
                              @if($bien->id==$visite->bien_id)
                                {{$bien->propriete_dite_bien}}
                              @endif
                              @endforeach
                            </td>
                            <td>{{$visite->statut}}</td>
                            <td>{{$visite->prochaine_relance}}</td>
                            <td class="project-actions text-right">
                               <!-- VOIR DETAILS -->
                               <a class="btn btn-primary btn-sm" title="Details" href="{{ '/visites/detail/' . $visite->id }}">
                                <i class="fas fa-eye"></i>
                                </i>
                              </a>
                              @if(Auth::user()->is_admin==1)
                              <!-- MODIFIER -->
                              <a class="btn btn-info btn-sm" title="Modifier" href="{{ '/visites/'.$projet->id.'/modifier_visite/' . $visite->id }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                              </a>
                              <!-- SUPRIMMER -->
                              <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteVisite{{$visite->id }}">
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
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
                url: '/searchVisit',
                data: {search:value},
                success:function(data){
                    $('#tbody').html(data);
                    console.log('result: '+data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>


















  </body>

</html>
