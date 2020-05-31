
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
                <a class="nav-link"> <b>Nouvel Appel</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Appels</li>
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
                        <form enctype="multipart/form-data" method="post" action="/appels/add_appel">
                            {{csrf_field()}}
                            {{method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row" style="display: none">
                                        <label class="col-md-4">Date </label>
                                        <input id="date" type="text" class="form-control col-md-8" name="date" value="{{old('date')}}">

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nom </label>
                                        <input class="col-md-8 form-control" type="text" name="nom"  value="{{old('nom')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prénom </label>
                                        <input type="text" class="form-control col-md-8" name="prenom"  value="{{old('prenom')}}"  >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Telephone *</label>
                                        <input type="text" class="form-control col-md-8" name="telephone"  value="{{old('telephone')}}" >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Ville </label>
                                        <input class="col-md-8 form-control" type="text" name="ville"  value="{{old('ville')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Source *</label>
                                        <input type="text" class="form-control col-md-8" name="source"  value="{{old('source')}}"  >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Type  de Produit *</label>

                                        <select class="form-control col-md-8" style="width: 100%;" name="type_bien"  >
                                            <option></option>
                                            <option value="F1">F1</option>
                                            <option value="F2">F2</option>
                                            <option value="F3">F3</option>
                                            <option value="F4">F4</option>
                                            <option value="F5">F5</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Commentaire Assistance </label>
                                        <textarea type="text" class="form-control col-md-8" name="commenatire_assistance"  >{{old('commenatire_assistance')}}</textarea>
                                    </div>
                                    <div style="display:none">
                                    @foreach($users as $st)
                                        <textarea type="text" class="form-control col-md-8" name="nb_appel_recu">{{$st->nb_appel_recu}}</textarea>
                                    @endforeach
                                    </div>
                                    <div class="form-group"  style="display:none">
                                        <label for="inputcivilite">cc_id</label>
                                        <select class="form-control custom-select" name="cc_id" >

                                            @foreach($users as $st)
                                                <option value="{{$st->id}}">{{$st->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/appels" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
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
