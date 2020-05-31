
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
                <a class="nav-link"> <b>Traiter Appel</b> </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
            <li class="breadcrumb-item active">Appels</li>
            <li class="breadcrumb-item active">Traiter</li>
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

                        <form enctype="multipart/form-data" method="post"  action="{{url('/appels/recu/update_appel/'.$appel->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row"  style="display: none">
                                        <label class="col-md-4">cc id </label>
                                        <input  type="text" class="form-control col-md-8" name="cc_id"  value="{{$appel->cc_id}}">

                                    </div>

                                    <div class="form-group row"  >
                                        <label class="col-md-4">Date  de Relance</label>
                                        <input id="date_relance" type="text" class="form-control col-md-8" name="date_relance">
                                        <input id="date_relance_hidden" type="hidden" name="date_relance" >
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Intérêt *</label>

                                        <select class="form-control col-md-8" style="width: 100%;" name="interet" onchange="showDiv(this)"  >
                                            <option></option>
                                            <option value="interesse">Intéressé</option>
                                            <option value="receptif">Réceptif</option>
                                            <option value="perdu">Perdu</option>
                                            <option value="injoignable">Injoignable</option>
                                        </select>
                                    </div>
                                     <div id="frien" style="display:none">
                                    <div class="form-group row" >
                                        <label class="col-md-4">Friens </label>
                                        <input class="col-md-8 form-control" type="text" name="frein"    >
                                    </div>
                                     </div>

                                    <div id="proch" style="display:none">
                                    <div class="form-group row">
                                        <label class="col-md-4">Prochaine Relance </label>
                                        <input class="col-md-8 form-control" type="date" name="prochaine_relance"    >
                                    </div>
                                    </div>

                                    <div class="form-group row" style="display: none" >
                                        <label class="col-md-4">injoignable </label>
                                        <textarea class="col-md-8 form-control" type="text" name="injoignable"  id="test" >0</textarea>
                                    </div>
                                    <div class="form-group row" >
                                        <label class="col-md-4">Commentaire CC </label>
                                        <textarea class="col-md-8 form-control" type="text" name="commentaire_cc"></textarea>
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
            console.log("fadwa");
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
