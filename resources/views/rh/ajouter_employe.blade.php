
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
                <a class="nav-link"> <b>Nouvel Employe</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Employes</li>
            <li class="breadcrumb-item active">Nouveau</li>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form enctype="multipart/form-data" method="post" action="/RH/add_employe">
                            {{csrf_field()}}
                            {{method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4">CIN *</label>
                                        <input class="col-md-8 form-control" type="text" name="cin" value="{{old('cin')}}">
                                    </div> <div class="form-group row">
                                        <label class="col-md-4">CNSS *</label>
                                        <input class="col-md-8 form-control" type="text" name="cnss" value="{{old('cnss')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nom *</label>
                                        <input class="col-md-8 form-control" type="text" name="nom" value="{{old('nom')}}">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prénom *</label>
                                        <input type="text" class="form-control col-md-8" name="prenom"  value="{{old('prenom')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Date de recrutement *</label>
                                        <input type="date" class="form-control col-md-8" name="date_recrutement"  value="{{old('date_recrutement')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Niveau d'étude *</label>

                                        <select class="form-control col-md-8" style="width: 100%;" name="niveau_etude"  >
                                            <option></option>
                                            <option value="0" {{ old('niveau_etude') == 0 ? 'selected' : '' }}>Niveau bac</option>
                                            <option value="1" {{ old('niveau_etude') == 1 ? 'selected' : '' }}>Bac</option>
                                            <option value="2" {{ old('niveau_etude') == 2 ? 'selected' : '' }}>Bac+2</option>
                                            <option value="3" {{ old('niveau_etude') == 3 ? 'selected' : '' }}>Bac+3</option>
                                            <option value="5" {{ old('niveau_etude') == 5 ? 'selected' : '' }}>Bac+5</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Intitulé du poste *</label>
                                        <input type="text" class="form-control col-md-8" name="intitule_poste"  value="{{old('intitule_poste')}}">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Mission *</label>
                                        <textarea type="text" class="form-control col-md-8" name="mission" >{{old('mission')}}</textarea>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Nombre de jours récupérés *</label>
                                        <input type="number" class="form-control col-md-8" name="nb_jour_recupere"value="{{old('nb_jour_recupere')}}" >
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/RH" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
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
