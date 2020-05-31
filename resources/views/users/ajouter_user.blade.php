
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
                <a class="nav-link"> <b>Nouvel Utilisateur</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Utilisateurs</li>
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
                                        <li> {{$error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif
                        <form enctype="multipart/form-data" method="post" action="/users/add_user" id="contact_us">
                            {{csrf_field()}}
                            {{method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group row">
                                        <label class="col-md-4">Nom *</label>
                                        <input class="col-md-8 form-control" type="text" name="name"  value="{{old('name')}}">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prénom *</label>
                                        <input type="text" class="form-control col-md-8" name="prenom" value="{{old('prenom')}}"   >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Email *</label>
                                        <input type="text" class="form-control col-md-8" name="email" value="{{old('email')}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Type Utlisateur *</label>

                                      <select class="form-control col-md-8" style="width: 100%;" name="is_admin"  value="{{old('is_admin')}}" >
                                            <option></option>
                                            <option value="1">Administrateur</option>
                                            <option value="0">Commercial</option>
                                            <option value="2">Assistante</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Password*</label>
                                        <input type="password" class="form-control col-md-8" name="password" value="{{old('password')}}" >
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/users" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                    <input  type="submit" value="Sauvegarder" class="btn btn-primary float-right">
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
