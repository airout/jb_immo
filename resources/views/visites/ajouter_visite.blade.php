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
                <a class="nav-link"> <b>Nouvelle visite</b> </a>
              </li>
            </ul>

            <ul class="navbar-nav ml-auto">
              <li class="breadcrumb-item"><a href="/home">Accueil</a></li>
              <li class="breadcrumb-item"><a href="/projets/detail/{{$projet->id}}">{{$projet->nom}}</a></li>
              <li class="breadcrumb-item"><a href="/projets/{{$projet->id}}/visites">Visites</a></li>
              <li class="breadcrumb-item active">Nouvelle visite</li>
            </ul>
        </nav>
        @extends('includes.nav2')
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
                          <form enctype="multipart/form-data" method="post" action="/projets/{{$projet->id}}/add_visite">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}  
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4">Nom *</label>
                                            <input class="col-md-8 form-control" type="text" name="nom" required>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Prénom *</label>
                                            <input type="text" class="form-control col-md-8" name="prenom" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Téléphone*</label>
                                            <input type="text" class="form-control col-md-8" name="telephone" required>
                                            
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-4">CIN</label>
                                            <input type="text" class="form-control col-md-8" name="cin">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Source*</label>
                                            <select id="source" class="col-md-8 form-control" name="source" onchange="afficherPartenaire(this);" required>
                                                <option value=""></option>
                                                <option value="Avito">Avito</option>
                                                <option value="Kekemonos">Kekemonos</option>
                                                <option value="Palissade">Palissade</option>
                                                <option value="Panneaux">Panneaux 4*3</option>
                                                <option value="Flyer">Flyer</option>
                                                <option value="Panneaux">Panneaux 4*3</option>
                                                <option value="Caravane">Caravane</option>
                                                <option value="Taxi">Taxi</option>
                                                <option value="Bouche_oreille">Bouche à Oreille</option>
                                                <option value="site_web">Site Web</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Smsing">Smsing</option>
                                                <option value="Phoning">Phoning BDD</option>
                                                <option value="Youtube">Youtube</option>
                                                <option id="partenaireValue" value="Partenaire">Partenaire</option>

                                            </select>
                                        </div>
                                        <div id="partenaires" style="display: none;">
                                            <div  class="form-group row">
                                                <label class="col-md-4">Partenaire*</label>
                                                <select id="partenaire"  class="col-md-8 form-control" name="partenaire_id" >
                                                    <option value="" ></option>
                                                    @foreach($partenaires as $partenaire)
                                                        <option value="{{$partenaire->id}}">{{$partenaire->nom}}</option>
                                                    @endforeach
                                                   

                                                </select>
                                            </div>
                                        </div>
                                             
                                         <div class="form-group row">
                                            <label class="col-md-4">Intérêt*</label>
                                            <select class="col-md-8 form-control" name="interet" onchange="resultInteret(this);" required>
                                                <option value=""></option>
                                                <option id="receptif" value="réceptif">Réceptif</option>
                                                <option id="interesse" value="intéressé">Intéressé</option>
                                                <option id="perdu" value="perdu">Perdu</option>
                                                

                                            </select>
                                        </div>
                                        <div id="frein_div" style="display: none;">
                                            <div class="form-group row">
                                                <label class="col-md-4">Frein*</label>
                                                <select id="frein" class="col-md-8 form-control" name="frein" onchange="resultFrein(this);" >
                                                    <option value=""></option>
                                                    <option value="tranche">Tranche</option>
                                                    <option value="etage">Etage</option>
                                                    <option value="avance">Avance</option>
                                                    <option value="prix">Prix</option>
                                                    <option value="superficie">Superficie</option>
                                                    <option value="prix_superficie">Prix/Superficie</option>
                                                    <option value="emplacement">Emplacement</option>
                                                    <option value="ne_souhaite_plus_investir">Ne souhaite plus investir</option>
                                                       

                                                </select>
                                            </div>
                                        </div>
                                            
                                        
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div id="choix_bien" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche*</label>
                                                <select id="tranche" class="col-md-8 form-control" name="tranche_id" >
                                                    <option value=""></option>
                                                    @foreach($tranches as $tranche)
                                                        <option value="{{$tranche->id}}">{{$tranche->description}}</option>
                                                    @endforeach
                                                    

                                                </select>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label class="col-md-4">Bloc*</label>
                                                <select id="bloc" class="col-md-8 form-control" name="bloc_id">
                                                    <option value=""></option>
                                                    

                                                </select>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-md-4">Immeuble*</label>
                                                <select id="immeuble" class="col-md-8 form-control" name="immeuble_id" >
                                                    <option value=""></option>
                                                    
                                                    

                                                </select>
                                            </div> -->
                                            
                                            
                                            
                                            <div class="form-group row">
                                                <label class="col-md-4">Bien*</label>
                                                <select id="bien" class="col-md-8 form-control" name="bien_id" >
                                                    <option value=""></option>
                                                   

                                                </select>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-md-4">Statut*</label>
                                                <select id="statut" class="col-md-8 form-control" name="statut" >
                                                    <option value=""></option>
                                                    <option value="pré-réservé">Pré-réservé</option>
                                                    <option value="vendu">Vendu</option>
                                                   

                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div id="date_relance_div" style="display: none;">
                                             <div class="form-group row">
                                                <label class="col-md-4">Mode Relance</label>
                                                <select id="" class="col-md-8 form-control" name="mode_relance" >
                                                    <option value="Appel" selected>Appel</option>
                                                    <option value="Sms">Sms</option>
                                                    <option value="Email">Email</option>
                                                    
                                                    

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Date Relance</label>
                                                <input id="date_relance" type="date" class="col-md-8 form-control" name="prochaine_relance" value="">
                                                
                                            </div>
                                             
                                        </div>
                                        <div id="rdv_div" style="display: none;">
                                            <div class="form-group row">
                                                <label class="col-md-4">RDV</label>
                                                <input id="rdv" type="date" class="col-md-8 form-control" name="rdv" value="">
                                            </div>
                                        </div>
                                        <div id="resultat_frein" style="display: none;">
                                            <div class="form-group row">
                                                <label class="col-md-4">Tranche</label>
                                                <select id="frein_tranche" class="col-md-8 form-control" name="frein_tranche_id" >
                                                    <option value=""></option>
                                                    @foreach($tranches as $tranche)
                                                        <option value="{{$tranche->id}}">{{$tranche->description}}</option>
                                                    @endforeach
                                                    

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Etage</label>
                                                <select id="frein_niveau" class="col-md-8 form-control" name="frein_niveau" >
                                                    <option value=""></option>
                                                    
                                                    

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Orientation</label>
                                                <select id="frein_orientation" class="col-md-8 form-control" name="frein_orientation" >
                                                    <option value=""></option>
                                                    <option value="N">N</option>
                                                    <option value="E" >E</option>
                                                    <option value="S" >S</option>
                                                    <option value="O" >O</option>
                                                    <option value="N/E" >N/E</option>
                                                    <option value="N/O" >N/O</option>
                                                    <option value="N/S" >N/S</option>
                                                    <option value="O/E" >O/E</option>
                                                    <option value="O/S" >O/S</option>
                                                    <option value="E/S" >E/S</option>
                                                    

                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Avance</label>
                                                <input type="text" class="col-md-8 form-control"  name=" frein_avance">
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-4">Prix</label>

                                                <div class="form-group col-md-8 row">
                                                    <label class="col-md-2">min</label>
                                                    <input type="text" class="col-md-4 form-control"  name=" frein_prix_min">
                                                
                                                    <label class="col-md-2">max</label>
                                                    <input type="text" class="col-md-4 form-control"  name=" frein_prix_max">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4">Superficie</label>

                                                <div class="form-group col-md-8 row">
                                                    <label class="col-md-2">min</label>
                                                    <input type="text" class="col-md-4 form-control"  name=" frein_superficie_min">
                                                
                                                    <label class="col-md-2">max</label>
                                                    <input type="text" class="col-md-4 form-control"  name=" frein_superficie_max">
                                                </div>
                                            </div>
                                        </div>
                                           
                                        <div class="form-group row">
                                            <label class="col-md-4">Commentaire</label>
                                            <textarea class="col-md-8 form-control" name="commentaire"></textarea>
                                        </div>
                                        
                                    </div>
                              </div>
                              <div class="row">
                                <div class="col-12">
                                  <a href="/projets/{{$projet->id}}/visites" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
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
    <script type="text/javascript">
        function afficherPartenaire(source)
        {
            console.log(source);
            if(source){
                partenaireValue = document.getElementById("partenaireValue").value;
                if(partenaireValue == source.value){
                    document.getElementById("partenaires").style.display = "block";
                    $('#partenaire').attr('required', 'required');
                }
                else{
                    document.getElementById("partenaires").style.display = "none";
                }
            }
            else{
                document.getElementById("partenaires").style.display = "none";
            }
        }
        function resultInteret(interet)
        {
            document.getElementById("choix_bien").style.display = "none";
            $('#tranche').removeAttr('required');
            $('#bien').removeAttr('required');
            $('#statut').removeAttr('required');
            document.getElementById("date_relance_div").style.display = "none";
            document.getElementById("rdv_div").style.display = "none";
            document.getElementById('date_relance').value = '';
            document.getElementById("frein_div").style.display = "none";
            document.getElementById("resultat_frein").style.display = "none";
            $('#frein').removeAttr('required');
            console.log(interet);
            if(interet){
                perdu = document.getElementById("perdu").value;
                interesse = document.getElementById("interesse").value;
                receptif = document.getElementById("receptif").value;
                if(perdu == interet.value){
                    document.getElementById("frein_div").style.display = "block";
                    $('#frein').attr('required', 'required');
                }
                
                if(receptif == interet.value){
                    document.getElementById("date_relance_div").style.display = "block";
                        var newdate = new Date();
                        newdate.setDate(newdate.getDate() + 7 );

                        var dd1 = newdate.getDate();
                        var mm1 = newdate.getMonth()+ 1 ;
                        var y1 = newdate.getFullYear();
                        if(dd1<10){
                            dd1='0'+dd1;
                        }
                        if(mm1<10){
                            mm1='0'+mm1;
                        }
                        var someFormattedDate = dd1 + '/' + mm1 + '/' + y1;
                        var  today2 = y1+'-'+mm1+'-'+dd1;
                        console.log('date_relance: '+someFormattedDate);
                        document.getElementById('date_relance').value = today2;
                    
                }
                
                if(interesse == interet.value){
                    document.getElementById("choix_bien").style.display = "block";
                    $('#tranche').attr('required', 'required');
                    $('#bien').attr('required', 'required');
                    $('#statut').attr('required', 'required');
                    document.getElementById("date_relance_div").style.display = "block";
                    document.getElementById("rdv_div").style.display = "block";
                    
                        
                        //Date de relance=t+24h
                        var newdate = new Date();
                        newdate.setDate(newdate.getDate() + 1 );

                        var dd1 = newdate.getDate();
                        var mm1 = newdate.getMonth()+ 1 ;
                        var y1 = newdate.getFullYear();
                        if(mm1<10){
                            mm1='0'+mm1;
                        }
                        var someFormattedDate = dd1 + '/' + mm1 + '/' + y1;
                        var  today2 = y1+'-'+mm1+'-'+dd1;
                        console.log('date_relance: '+someFormattedDate);
                        document.getElementById('date_relance').value = today2;
                
                }
                
                
            }
            else{
                document.getElementById("frein_div").style.display = "none";
                document.getElementById("choix_bien").style.display = "none";
                document.getElementById("date_relance_div").style.display = "none";
            }

        }

        function resultFrein(frein)
        {
            var frein=frein.value;
            if (frein=='tranche' || frein=='etage' || frein=='prix' || frein=='avance' || frein=='superficie' || frein=='prix_superficie' || frein=='emplacement' ) {
                document.getElementById('resultat_frein').style.display='block'
            }
            else{
                document.getElementById('resultat_frein').style.display='none'
            }

        }

                var token="{{Session::token()}}";
                
                $('#tranche').on('change', function () {
                    var tranche_id = this.selectedOptions[0].value;

                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getBiensDispoByTrancheId',
                        data: {tranche_id:tranche_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                           console.log('tranche:  '+data);
                            $('#bien').empty();
                            $('#bien').append('<option></option>');
                            for (var i = 0; i< data.length; i++) {
                               $('#bien').append('<option value='+data[i].id+'>'+data[i].propriete_dite_bien+'</option')
                            }
                             
                        }
                              
                    });
                    
                    
                });
                $('#frein_tranche').on('change', function () {
                    var tranche_id = this.selectedOptions[0].value;
                   console.log(tranche_id);
                    $.ajax({

                        type: 'POST',
                        url: '/biens/getNiveauByTrancheId',
                        data: {tranche_id:tranche_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            console.log(data);
                            $('#frein_niveau').empty();
                            $('#frein_niveau').append('<option></option>');
                            for (var i = 0; i<= data.niveau_etages; i++) {
                               $('#frein_niveau').append('<option value='+i+'>'+i+'</option')
                            }

                        }

                    });
                    
                });
               /* $('#bloc').on('change', function () {
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
                    var tranche_id = this.selectedOptions[0].value;
                    $.ajax({
          
                        type: 'POST',
                        url: '/biens/getBiensDispoByTrancheId',
                        data: {tranche_id:tranche_id,_token:token},
                         dataType: 'JSON',
                        success: function(data){
                            $('#bien').empty();
                            $('#bien').append('<option></option>');
                            for (var i = 0; i< data.length; i++) {
                               $('#bien').append('<option value='+data[i].id+'>'+data[i].propriete_dite_bien+'</option')
                            }
                             
                        }
                              
                    });
                });*/

    </script>
      
  </body>

</html>
