
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
                <a class="nav-link"> <b>Modifier Appel</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Appels</li>
            <li class="breadcrumb-item active">Modifier</li>
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

                        @if(Auth::user()->is_admin==2)
                        <form enctype="multipart/form-data" method="post"  action="{{url('/appels/update_appel_assistante/'.$ap->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row" style="display: none">
                                        <label class="col-md-4">Date </label>
                                        <input id="date" type="text" class="form-control col-md-8" name="date" value="{{$ap->date}}">

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nom </label>
                                        <input class="col-md-8 form-control" type="text" name="nom"  value="{{$ap->nom}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prénom </label>
                                        <input type="text" class="form-control col-md-8" name="prenom"  value="{{$ap->prenom}}"  >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Telephone *</label>
                                        <input type="text" class="form-control col-md-8" name="telephone" value="{{$ap->telephone}}" >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Ville </label>
                                        <input class="col-md-8 form-control" type="text" name="ville"  value="{{$ap->ville}}" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Source *</label>
                                        <input type="text" class="form-control col-md-8" name="source" value="{{$ap->source}}" >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Type  de Produit *</label>

                                        <select class="form-control col-md-8" style="width: 100%;" name="type_bien"  >
                                            <option></option>
                                            <option value="F1" @if($ap->type_bien== 'F1') {{'selected'}} @endif>F1</option>
                                            <option value="F2" @if($ap->type_bien== 'F2') {{'selected'}} @endif>F2</option>
                                            <option value="F3" @if($ap->type_bien== 'F3') {{'selected'}} @endif>F3</option>
                                            <option value="F4" @if($ap->type_bien== 'F4') {{'selected'}} @endif>F4</option>
                                            <option value="F5" @if($ap->type_bien== 'F5') {{'selected'}} @endif>f5</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Commentaire Assistance *</label>
                                        <textarea type="text" class="form-control col-md-8" name="commentaire_assistance"  >{{$ap->commentaire_assistance}}</textarea>
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
                        @elseif(Auth::user()->is_admin==0)
                            <form enctype="multipart/form-data" method="post"  action="{{url('/appels/update_appel_commercial/'.$ap->id)}}">
                                {{csrf_field()}}
                                {{method_field('PUT') }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row"  style="display: none">
                                            <label class="col-md-4">cc id </label>
                                            <input  type="text" class="form-control col-md-8" name="cc_id"  value="{{$ap->cc_id}}">

                                        </div>

                                        <div class="form-group row"  >
                                            <label class="col-md-4">Date  de Relance</label>
                                            <input id="date_relance" type="text" class="form-control col-md-8" name="date_relance"  value="{{$ap->date_relance}}">
                                            <input id="date_relance_hidden" type="hidden" name="date_relance" >
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4">Intérêt *</label>

                                            <select class="form-control col-md-8" style="width: 100%;" name="interet" onchange="showDiv(this)"  >
                                                <option></option>

                                                <option value="interesse" @if($ap->interet== 'interesse') {{'selected'}} @endif>Intéressé</option>
                                                <option value="receptif" @if($ap->interet== 'receptif') {{'selected'}} @endif>Réceptif</option>
                                                <option value="perdu" @if($ap->interet== 'perdu') {{'selected'}} @endif>Perdu</option>
                                                <option value="injoignable" @if($ap->interet== 'injoignable') {{'selected'}} @endif>Injoignable</option>

                                            </select>
                                        </div>

                                        @if($ap->interet== 'receptif')
                                            <div id="frien" style="display:none">
                                                <div class="form-group row" >
                                                    <label class="col-md-4">Friens </label>
                                                    <input class="col-md-8 form-control" type="text" name="frein"  value="{{$ap->frein}}"   >
                                                </div>
                                            </div>

                                            <div id="proch" style="display:block">
                                                <div class="form-group row">
                                                    <label class="col-md-4">Prochaine Relance </label>
                                                    <input class="col-md-8 form-control" type="date" name="prochaine_relance"    value="{{$ap->prochaine_relance}}" >
                                                </div>
                                            </div>
                                            @elseif($ap->interet== 'perdu')
                                            <div id="frien" style="display:block">
                                                <div class="form-group row" >
                                                    <label class="col-md-4">Friens </label>
                                                    <input class="col-md-8 form-control" type="text" name="frein"  value="{{$ap->frein}}"   >
                                                </div>
                                            </div>

                                            <div id="proch" style="display:none">
                                                <div class="form-group row">
                                                    <label class="col-md-4">Prochaine Relance </label>
                                                    <input class="col-md-8 form-control" type="date" name="prochaine_relance" value="{{$ap->prochaine_relance}}" >
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row" style="display: none" >
                                            <label class="col-md-4">injoignable </label>
                                            <textarea class="col-md-8 form-control" type="text" name="injoignable"  id="test" >0</textarea>
                                        </div>
                                        <div class="form-group row" >
                                            <label class="col-md-4">Commentaire CC </label>
                                            <textarea class="col-md-8 form-control" type="text" name="commentaire_cc"> {{$ap->commentaire_cc}}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                        <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">
                                    </div>
                                </div>
                            </form>
                    </div>
                        @endif

                </div>
            </div>
        </section>
        @extends('includes.footer')

    </div>
</div>
<script src="/plugins/jquery/jquery.min.js"></script>
<script>

    function showDiv(select){
        switch (select.value) {
            case 'perdu':
                document.getElementById("test").value = 0;
                document.getElementById("frien").style.display = "block";
                document.getElementById("proch").style.display = "none";
                break;
            case 'receptif':
                document.getElementById("test").value = 0;
                document.getElementById("proch").style.display = "block";
                document.getElementById("frien").style.display = "none";
                break;

            case 'injoignable':

                document.getElementById("test").value = 1;
                document.getElementById("frien").style.display = "none";
                document.getElementById("proch").style.display = "none";
                break;
            case 'interesse':
                document.getElementById("test").value = 0;
                document.getElementById("proch").style.display = "none";
                document.getElementById("frien").style.display = "none";
                break;
            default:
                document.getElementById("frien").style.display = "none";
                document.getElementById("proch").style.display = "none";
                break;
        }
    }


    $( document ).ready(function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        console.log('today:' + dd + '/' + mm + '/' + yyyy);

        $('#date_relance').val(dd + '/' + mm + '/' + yyyy);
        $('#date_relance_hidden').val(today);


    });



</script>

</body>

</html>
