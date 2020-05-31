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
                <a class="nav-link"> <b>Liste des blocs</b> </a>
              </li>
            </ul>

            <ul class="navbar-nav ml-auto">
              <!-- Messages Dropdown Menu -->
              <!-- Notifications Dropdown Menu -->
                <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                @isset($projet)
                    <li class="breadcrumb-item "><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                @endisset
                @isset($tranche)
                    <li class="breadcrumb-item "><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                @endisset
                <li class="breadcrumb-item active">Blocs</li>
                
            </ul>
            <!-- Right navbar links -->
        </nav>
        <!-- /.navbar -->

        @foreach($blocs as $bloc)
        <div class="modal fade" id="modalDeleteBloc{{$bloc->id}}">
            <div class="modal-dialog">
              <div class="modal-content bg-danger">
                <div class="modal-header">
                  <h4 class="modal-title">Attention</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Etes-vous certain(e) de vouloir supprimer ce Bloc ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
                  @if(isset($tranche))
                    <a href="{{'/tranches/'.$tranche->id.'/supprimer_bloc/'. $bloc->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
                @elseif(isset($projet))
                    <a href="{{'/projets/'.$projet->id.'/supprimer_bloc/'. $bloc->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
                @else
                    <a href="{{'/blocs/supprimer_bloc/'. $bloc->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
                @endif
                      
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @endforeach

        @extends('includes.nav2')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content" style="padding: 9px;">
          <div class="container-fluid">
            <div class="card card-primary">
              <div class="card-body">
                <div class="row">
                  <div class="col-2">
                    <!-- button de creer_programme -->
                    @if(isset($projet))
                        <a href="/projets/{{$projet->id}}/nouveau_bloc"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter Bloc</button></a>
                    @elseif(isset($tranche))
                        <a href="/tranches/{{$tranche->id}}/nouveau_bloc"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter Bloc</button></a>
                    @else
                        <a href="/blocs/nouveau_bloc"><button type="button" class="btn btn-block btn-primary btn-flat">Ajouter Bloc</button></a>
                    @endif
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

                  <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Tranche</th>
                                <th>Projet</th>
                                <th>Titre foncier</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($blocs as $bloc)
                            <tr>
                                <td>{{$bloc->description}}</td>
                                @if(isset($tranches))
                                    @foreach($tranches as $tr)
                                        @if($tr->id==$bloc->tranche_id)
                                            <td>{{$tr->description}}</td>
                                        @endif
                                    @endforeach
                                @elseif(isset($tranche))
                                    <td>{{$tranche->description}}</td>
                                @else
                                    <td></td>  
                                @endif
                                @if(isset($projets))
                                    @foreach($projets as $pr)
                                        @if($pr->id==$bloc->projet_id)
                                            <td>{{$pr->nom}}</td>
                                        @endif
                                    @endforeach
                                @elseif(isset($projet))
                                    <td>{{$projet->nom}}</td>
                                @else
                                    <td></td>  
                                @endif
                                <td>{{$bloc->titre_foncier}}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" title="Details" href="/blocs/detail/{{$bloc->id}}"> 
                                        <i class="fas fa-eye"></i> 
                                    </a>
                                    <!-- MODIFIER -->
                                    @if(Auth::user()->is_admin==1)
                                        <a class="btn btn-info btn-sm" title="Modifier" href="{{'/blocs/modifier_bloc/'.$bloc->id}}">
                                            <i class="fas fa-pencil-alt"> </i>
                                        </a>
                                        <!-- SUPRIMMER -->
                                        <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modalDeleteBloc{{$bloc->id}}">
                                          <i class="fas fa-trash"> </i>
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
                url: '/searchBloc',
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
