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
                    <a class="nav-link"> <b>Nouveau Bloc</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                  <!-- Messages Dropdown Menu -->
                  <!-- Notifications Dropdown Menu -->
                    <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>

                    @if(isset($projet))
                        <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
                    @elseif(isset($proj))
                        <li class="breadcrumb-item"><a href="/projets/detail/{{$proj->id}}">{{$proj->nom}}</a></li>
                    @endif
                    @isset($tranche)
                        <li class="breadcrumb-item"><a href="/tranches/detail/{{$tranche->id}}">{{$tranche->description}}</a></li>
                    @endisset
                    <li class="breadcrumb-item active">Nouveau bloc</li>



                </ul>
                <!-- Right navbar links -->
              </nav>

            @extends('includes.nav2')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

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
                                <form enctype="multipart/form-data" method="post" action="{{'/blocs/addBlocByProjet/'.$projet->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description" value="{{old('description')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$projet->nom}}" readonly>
                                                <input type="hidden" class="form-control col-md-8"  value="{{$projet->id}}" name="projet_id" value="{{old('projet_id')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <select  name="tranche_id" class="form-control col-md-8" style="width: 100%;" >
                                                    <option></option>
                                                    @foreach($tranches as $tr)

                                                        <option value="{{$tr->id}}" {{ old('tranche_id') == $tr->id ? "selected" : "" }}>{{$tr->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}">
                                            </div>



                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <a href="{{'/projets/'.$projet->id.'/blocs'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @elseif(isset($tranche))
                                <form enctype="multipart/form-data" method="post" action="{{'/blocs/addBlocByTranche/'.$tranche->id}}">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description"  value="{{old('description')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$proj->nom}}" readonly>
                                                <input type="hidden" class="form-control col-md-8"  value="{{$proj->id}}" name="projet_id"  value="{{old('projet_id')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <input type="text" class="form-control col-md-8"  value="{{$tranche->description}}" readonly>
                                                <input type="hidden" class="form-control col-md-8"  value="{{$tranche->id}}" name="tranche_id"  value="{{old('tranche_id')}}">
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}">
                                            </div>



                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <a href="{{'/tranches/detail/'.$tranche->id}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @else
                                <form enctype="multipart/form-data" method="post" action="/blocs/add_bloc">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}
                                    <div class="row">
                                        <div class="col-md-2"></div>

                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="col-md-4">Description</label>
                                                <input type="text" class="form-control col-md-8" name="description" value="{{old('description')}}">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Projet</label>
                                                <select id="projet" name="projet_id" class="form-control col-md-8" style="width: 100%;"  value="{{old('projet_id')}}">
                                                    <option></option>
                                                    @foreach($projets as $pr)
                                                    <option value="{{$pr->id}}" {{ old('projet_id') == $pr->id ? "selected" : "" }}>{{$pr->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <select id="tranche" name="tranche_id" class="form-control col-md-8" style="width: 100%;"  value="{{old('tranche_id')}}">
                                                    <option></option>
                                                    @foreach($tranches as $tr)
                                                    @if($tr->projet_id=='<script>projet_id</script>')
                                                    <option value="{{$tr->id}}" {{ old('tranche_id') == $tr->id ? "selected" : "" }}>{{$tr->description}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Titre foncier</label>
                                                <input type="text" class="form-control col-md-8" name="titre_foncier" value="{{old('titre_foncier')}}" >
                                            </div>



                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                           <a href="/blocs" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                                        </div>
                                    </div>
                                </form>
                                @endif


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
                    url: '/blocs/getTranchesByProjetId',
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
        </script>
    </body>



</html>
