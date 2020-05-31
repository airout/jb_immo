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
            <a class="nav-link"> <b>Liste des tranches</b> </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <!-- Notifications Dropdown Menu -->
            <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
            @isset($projet)
            <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
            @endisset

            <li class="breadcrumb-item active">Tranches</li>
            
        </ul>
        <!-- Right navbar links -->
      </nav>
      <!-- /.navbar -->
      @foreach($tranches as $tranche)
      <div class="modal fade" id="modal-danger{{$tranche->id }}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Attention</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Etes-vous certain(e) de vouloir supprimer cette tranche ? <br> <small><cite title="Source Title">La suppression est définitive.</cite> </small> </p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fermer</button>
              @if(isset($projet))
                <a href="{{'/projets/'.$projet->id.'/supprimer_tranche/' . $tranche->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
              @else
                <a href="{{'/tranches/supprimer_tranche/' . $tranche->id}}" type="submit" class="btn btn-outline-light">Supprimer</a>
              @endif
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
        <div class="content-header">
          
        </div>
        <!-- /.content-header -->

        <section class="content">
          <div class="container-fluid">
            <div class="card card-primary">
              <div class="card-body">
                <div class="row">
                  <div class="col-2">
                    @if(isset($projet))
                    <a href="{{'/projets/'.$projet->id.'/nouvelle_tranche'}}"><button type="button"
                        class="btn btn-block btn-primary btn-flat">Ajouter Tranche</button></a>
                    @else
                    <a href="/tranches/nouvelle_tranche"><button type="button"
                        class="btn btn-block btn-primary btn-flat">Ajouter Tranche</button></a>
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

                          <th>Tranche</th>
                          <th>Projet</th>
                          <th>Niveau d'étages</th>
                          <th>Date livraison</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        @foreach($tranches as $tranche)
                          
                        <tr>
                          <td>{{$tranche->description}}</td>
                          @if(isset($projet))
                            <td>{{$projet->nom}}</td>
                          @else
                            @foreach($projets as $proj)
                              @if($tranche->projet_id==$proj->id)
                                <td>{{$proj->nom}}</td>
                              @endif
                            @endforeach 
                          @endif
                          <td>{{$tranche->niveau_etages}}</td>
                           <td>{{ \Carbon\Carbon::parse($tranche->date_livraison)->format('d/m/Y')}}</td>
                          <td class="project-actions text-right">
                             <a class="btn btn-primary btn-sm" title="Details" href="{{ '/tranches/detail/' . $tranche->id }}">
                              <i class="fas fa-eye"></i>
                              </i>
                            </a>
                            @if(Auth::user()->is_admin==1)
                              @if(isset($projet))
                                <a class="btn btn-info btn-sm" title="Modifier" href="{{'/projets/'.$projet->id.'/modifier_tranche/'.$tranche->id}}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                </a>
                              @else
                                <a class="btn btn-info btn-sm" title="Modifier" href="{{ '/tranches/modifier_tranche/' . $tranche->id }}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                </a>
                              @endif
                              <a class="btn btn-danger btn-sm" href="" title="Supprimer" data-toggle="modal" data-target="#modal-danger{{$tranche->id }}">
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
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      @extends('includes.footer')
    </div>
    <script src="/plugins/jquery/jquery.min.js"></script>

    <script type="text/javascript">

        $('#search').on('keyup',function(){
            var value=$(this).val();
            $.ajax({
                type : 'get',
                url: '/searchTranche',
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
