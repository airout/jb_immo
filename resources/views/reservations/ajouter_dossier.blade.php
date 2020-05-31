<!DOCTYPE html>
<html lang="en">

    <head>
        @extends('includes.head')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
               <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"> <b>Nouveau Dossier</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/reservations">Reservations</a></li>
                   <li class="breadcrumb-item"><a href="/reservations/dossiers">Dossiers</a></li>
                   <li class="breadcrumb-item active">Nouveau</li>
                </ul>
               
            </nav>

            @extends('includes.nav')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                <section class="content" style="padding: 6px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                           
                                    </div>
                                </div>
                                <form enctype="multipart/form-data" method="post" action="@if($client){{'/clients/'.$client->id.'/add_dossier/'}}@else{{'/dossiers/add_dossier'}}@endif">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}  
                                    <div class="card-body">
                                    
                                    
                                        <div class=" row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-2">Nombre d'aquéreurs</label>
                                                    <input type="number" class="form-control col-md-8" name="nombre_aquereurs" value="1">
                                                    <input type="hidden" class="form-control col-md-8" name="client_id" value="@if($client){{$client->id}}@else{{null}}@endif">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2">Responsable Dossier</label>
                                                    <select class="form-control col-md-8" name="responsable_dossier">
                                                        <option selected="" disabled=""> </option>
                                                        @foreach($commercials as $cc)
                                                            <option value="{{$cc->id}}">{{$cc->name}} {{$cc->prenom}} </option>
                                                        @endforeach
                                                                           
                                                     </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Projet</label>
                                                            <select id="projet" class="form-control  col-md-8" name="projet_id" onchange="getdatelimitereservation()" >
                                                                <option selected="" disabled=""> </option>
                                                                @foreach($projets as $projet)
                                                                    <option value="{{$projet->id}}">{{$projet->nom}} </option>
                                                                @endforeach
                                                                                   
                                                             </select>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Tranche</label>
                                                            <select id="tranche" class="form-control col-md-8" name="tranche_id" required>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Bloc</label>
                                                            <select id="bloc" class="form-control col-md-8" name="bloc_id" required>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Immeuble</label>
                                                            <select id="immeuble" class="form-control col-md-8" name="immeuble_id" required>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Bien</label>
                                                            <select id="bien" class="form-control col-md-8" name="bien_id" required>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Prix</label>
                                                           <input id="prix" type="text" class="form-control col-md-8"  disabled>
                                                           <input id="prix2" type="hidden" class="form-control col-md-8" name="prix" >
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Date réservation</label>
                                                           <input id="date_reservation" type="text" class="form-control col-md-8" >
                                                           <input id="date_reservation_hidden" type="hidden" name="date_reservation" >
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4">Date limite de réservation</label>
                                                           <input id="date_limite_reservation" type="text" class="form-control col-md-8"  disabled>
                                                           <input id="date_limite_reservation2" type="hidden"  name="date_limite_reservation" class="form-control col-md-8">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                              
                                    </div>
                                </div>
                                <div class="row">
                                            <div class="col-12">
                                                <a href="{{'/reservations/dossiers'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                                                <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">
                                            </div>
                                </div>
                            </form>
                                    
                                    
                           
                        </div>


                    </div>

                    

                </section>
            </div>
            @extends('includes.footer')
        </div>
        
        <script src="/plugins/jquery/jquery.min.js"></script>
    
        <script type="text/javascript">
            $( document ).ready(function() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; 
                var yyyy = today.getFullYear();
                if(dd<10){
                    dd='0'+dd
                }
                if(mm<10){
                    mm='0'+mm
                }

                today = yyyy+'-'+mm+'-'+dd;
                console.log('today:'+dd+'/'+mm+'/'+yyyy);
                $('#date_reservation').val(dd+'/'+mm+'/'+yyyy);
                $('#date_reservation_hidden').val(today);  
           

                var token="{{Session::token()}}";
                $('#projet').on('change', function () {
                    var projet_id = this.selectedOptions[0].value;
                    var limite_annulation=0;
                    <?php foreach ($projets as $projet): ?>
                        if ({{$projet->id}}==projet_id) {
                            limite_annulation={{$projet->limite_annulation_reservation}};
                            console.log(limite_annulation);
                           
                        }
                    <?php endforeach ?>
                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getTranchesByProjetId',
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
                $('#tranche').on('change', function () {
                    var tranche_id = this.selectedOptions[0].value;
                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getBlocsByTrancheId',
                        data: {tranche_id:tranche_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            $('#bloc').empty();
                            $('#bloc').append('<option></option>');
                            for (var i = 0; i< data.length; i++) {
                               $('#bloc').append('<option value='+data[i].id+'>'+data[i].description+'</option')
                            }
                             
                        }
                              
                    });
                    
                });
                $('#bloc').on('change', function () {
                    var bloc_id = this.selectedOptions[0].value;
                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getImmeublesByBlocId',
                        data: {bloc_id:bloc_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            $('#immeuble').empty();
                            $('#immeuble').append('<option></option>');
                            for (var i = 0; i< data.length; i++) {
                               $('#immeuble').append('<option value='+data[i].id+'>'+data[i].description+'</option')
                            }
                             
                        }
                              
                    });
                });
                $('#immeuble').on('change', function () {
                    var immeuble_id = this.selectedOptions[0].value;
                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getBiensDispoByImmeubleId',
                        data: {immeuble_id:immeuble_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            $('#bien').empty();
                            $('#bien').append('<option></option>');
                            for (var i = 0; i< data.length; i++) {
                               $('#bien').append('<option value='+data[i].id+'>'+data[i].propriete_dite_bien+'</option')
                            }
                             
                        }
                              
                    });
                });

                $('#bien').on('change', function () {
                    var bien_id = this.selectedOptions[0].value;
                    $.ajax({
          
                        type: 'GET',
                        url: '/biens/getPrixByBienId',
                        data: {bien_id:bien_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            console.log(data);
                    
                            $('#prix').empty();
                            $('#prix').val(data);
                            $('#prix2').empty();
                            $('#prix2').val(data);
                            
                             
                        }
                              
                    });
                });
             });
    

            function getdatelimitereservation() {

                var tt = document.getElementById('date_reservation_hidden').value;

                $('#projet').on('change', function () {
                    var projet_id = this.selectedOptions[0].value;
                    var limite_annulation=0;
                    <?php foreach ($projets as $projet): ?>
                    if ({{$projet->id}}==projet_id) {
                        limite_annulation={{$projet->limite_annulation_reservation}};
                        console.log(limite_annulation);

                        var date = new Date(tt);
                        var newdate = new Date(date);

                        newdate.setDate(newdate.getDate() + limite_annulation );

                        var dd1 = newdate.getDate();
                        var mm1 = newdate.getMonth()+ 1 ;
                        var y1 = newdate.getFullYear();
                        if(mm1<10){
                            mm1='0'+mm1;
                        }
                        var someFormattedDate = dd1 + '/' + mm1 + '/' + y1;
                        var  today2 = y1+'-'+mm1+'-'+dd1;
                        document.getElementById('date_limite_reservation').value = someFormattedDate;
                        document.getElementById('date_limite_reservation2').value = today2;



                    }

                    <?php endforeach ?>
                // var aa= document.getElementById('test').value;



                });  
            }
        </script> 
    </body>

</html>
