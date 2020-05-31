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
                <a class="nav-link"> <b>Modifier Profil</b> </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item">Profil</li>
            <li class="breadcrumb-item active">Modifier</li>
        </ul>

        <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

@extends('includes.nav')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >

        <!-- /.content-header -->
        <section class="content" style="padding: 6px;">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-primary">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <form enctype="multipart/form-data" method="post" action="{{url('/profil/update_profil/'.$user->id)}}">
                            {{csrf_field()}}
                            {{ method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4">Nom *</label>
                                        <input class="col-md-8 form-control" type="text" name="name"  value="{{$user->name}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prénom *</label>
                                        <input type="text" class="form-control col-md-8" name="prenom" value="{{$user->prenom}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Email *</label>
                                        <input type="text" class="form-control col-md-8" name="email" value="{{$user->email}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Type Utlisateur *</label>
                                        <select class="form-control col-md-8" style="width: 100%;" name="is_admin" required disabled>
                                            <option></option>
                                            <option value="1" @if($user->is_admin== 1) {{'selected'}} @endif>Administrateur</option>
                                            <option value="0" @if($user->is_admin== 0) {{'selected'}} @endif>Commercial</option>
                                            <option value="2" @if($user->is_admin== 2) {{'selected'}} @endif>Assistante</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Password*</label>
                                        <input type="password" class="form-control col-md-8" name="password"  value="{{$user->password}}">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/home" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                    <input type="submit" value="Modifier" class="btn btn-primary float-right">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        @extends('includes.footer')
    </div>
</div>

</body>

</html>
