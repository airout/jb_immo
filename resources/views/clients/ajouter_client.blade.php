
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
                    <a class="nav-link"> <b>Nouveau Client</b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/clients">Clients</a></li>
                   <li class="breadcrumb-item active">Nouveau</li>
                </ul>
                <!-- Right navbar links -->
            </nav>

            @extends('includes.nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content" style="padding: 6px">
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" method="post" action="@if(isset($dossier)){{'/dossiers/'.$dossier->id.'/add_nouvel_aquereur'}}@else{{'/clients/add_client'}}@endif">
                        {{csrf_field()}}
                        {{method_field('PUT') }}
                    <div class="card card-primary">
                        <div class="card-header">
                           <h3 class="card-title">Informations Générales</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>

                        </div>

                        <div class="card-body">
                            <div> 
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li> {{$error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br />
                                @endif
                            </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="controls">
                                               <label for="tagid1" id="tagid1-lbl" class="radio">
                                                  <input type="radio" name="situation_pro" value="particulier"  checked="checked" />Particulier
                                               </label>
                                               <label for="tagid2" id="tagid2-lbl" class="radio" style="margin-left: 50px">
                                                   <input type="radio" name="situation_pro" value="societe"  />Société
                                               </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputcivilite">Société</label>
                                            <select class="form-control custom-select" name="societe_id">
                                                <option selected   disabled="">société</option>
                                                @foreach($societes as $st)
                                                    
                                                    <option value="{{$st->id}}">{{$st->societe}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="">Nom *</label>
                                                   <input type="text" id="" class="form-control" name="nom" placeholder="Nom" value="{{old('nom')}}">



                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Prénom *</label>
                                                    <input type="text" id="" class="form-control" name="prenom" placeholder="Prénom" value="{{old('prenom')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputtele">Téléphone 1 *</label>
                                                    <input type="tel" id="" class="form-control"  name="telephone1" placeholder="" value="{{old('telephone1')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputmobile">Téléphone 2</label>
                                                    <input type="tel" id="" class="form-control" name="mobile" placeholder="">
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="inputcivilite">Civilité</label>
                                            <select class="form-control custom-select" name="civilite">
                                                <option selected   disabled="">civilité</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mme">Mme</option>
                                                <option value="Mlle">Mlle</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputadresse">Adresse</label>
                                            <input type="text" id="" class="form-control"  name="adresse" placeholder="Adresse">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputadresse">Ville</label>
                                                    <input type="text" id="" class="form-control" name="ville" placeholder="Ville">
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputadresse">Pays</label>
                                                    <input type="text" id="" class="form-control" name="pays" placeholder="Pays">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputprofession">Profession</label>
                                            <input type="text" id="" class="form-control" name="profession" placeholder="Ex : Directeur Commercial">
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                           <h3 class="card-title">Informations Personnelles</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>

                        </div>

                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label for="inputcin">CIN *</label>
                                            <input type="text" id="" class="form-control" name="cin" placeholder="cin" value="{{old('cin')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputlieunaissance">lieu de naissance</label>
                                            <input type="text" id="" class="form-control" name="lieu_naissance" placeholder="Lieu de naissance">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputlieunaissance">Nationalité</label>
                                            <input type="text" id="" class="form-control" name="nationalite" placeholder="Nationalité">
                                        </div>



                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnaissance">Date de naissance</label>
                                                    <input type="date" class="form-control" name="date_naissance"  id="dob"    onChange="showAge()" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputage">Age</label>
                                                    <input type="number" id=test class="form-control" name="age"  disabled>
                                                    <textarea type="number" id="age" class="form-control" name="age"  placeholder="Age" style="display: none"   ></textarea>
                                                </div>
                                            </div>
                                        </div>






                                        <div class="form-group" style="display: none;"  id="nom_responsable">
                                            <label for="inputresponsable">Nom de responsable</label>
                                            <input type="text" id="" class="form-control"  name="nom_responsable" placeholder="Nom de responsable">
                                        </div>
                                        <div class="form-group"  style="display: none;"  id="relation_familiale">
                                            <label for="inputrelation">Relation familiale</label>
                                            <input type="text" id="" class="form-control"name="relation_familiale" placeholder="Relation familiale">
                                        </div>


                                    </div>

                                </div>
                        </div>
                    </div>
                     <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Situation Familiale</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>

                        </div>

                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="inputmariage">Situation familiale </label>
                                           <select class="form-control custom-select" name="situation_familiale" onchange="afficherInfosMariage(this);">
                                                <option value="célibataire">Célibataire</option>
                                                <option  id="married" value="marié">Marié</option>
                                                <option value="divorcé">Divorcé</option>
                                                <option value="veuf">Veuf</option>
                                            </select>
                                        </div>
                                        <div  id="infosMariage" style="display:none;">
                                            <div class="form-group">
                                                <label for="inputmariage">Marié(e) à M/MME</label>
                                                <input type="text" id="" class="form-control" name="nom_mari" placeholder="M/MME">
                                            </div>
                                            <div class="form-group" >
                                                <label for="inputdatemariage">Date de mariage</label>
                                                <input type="date" id="" name="date_mariage" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group" >
                                                <label for="inputlieuxmariage">Lieu de mariage</label>
                                                <input type="text" id="" name="lieu_mariage" class="form-control" placeholder="Lieux">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="inputdatemariage">Nom père</label>
                                                    <input type="text" id="" name="nom_pere" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="inputdatemariage">Nom mère</label>
                                                    <input type="text" id="" name="nom_mere" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Mode financement</label>
                                            <div class="controls">
                                               <label for="tagid1" id="tagid1-lbl" class="radio">
                                                  <input id="comptant" type="radio" name="mode_financement" value="comptant" onclick="hideBanque()"  checked="checked" />Comptant
                                               </label>
                                               <label for="tagid2" id="tagid2-lbl" class="radio" style="margin-left: 50px">
                                                   <input id="credit" type="radio" name="mode_financement" value="crédit"  onclick="showBanque()"  />Crédit
                                               </label>
                                            </div>
                                        </div>
                                        <div id="banque" class="form-group"  style="display:none;">
                                            <label for="inputbanque">Banque</label>
                                            <input id="banqueValue" type="text" id="" class="form-control" name="banque" placeholder="Banque">
                                        </div>

                                    </div>


                                </div>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-12">
                            <a href="{{'/clients'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                            <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">

                        </div>
                    </div>
             </form>

        </section>

        @extends('includes.footer')

    </div>
</div>
<script type="text/javascript">
    /**** max date,naissance today*/
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("dob").setAttribute("max", today);


/****** fucntion to calculate age and display/hide divs relation-famille......*/
    function afficherInfosMariage(situation)
    {
        console.log(situation);
        if(situation){
            marriedValue = document.getElementById("married").value;
            if(marriedValue == situation.value){
                document.getElementById("infosMariage").style.display = "block";
            }
            else{
                document.getElementById("infosMariage").style.display = "none";
            }
        }
        else{
            document.getElementById("infosMariage").style.display = "none";
        }
    }





    function calculAge(birthDate, ageAtDate) {
        // convert birthDate to date object if already not
        if (Object.prototype.toString.call(birthDate) !== '[object Date]')
            birthDate = new Date(birthDate);

        // use today's date if ageAtDate is not provided
        if (typeof ageAtDate == "undefined")
            ageAtDate = new Date();

        // convert ageAtDate to date object if already not
        else if (Object.prototype.toString.call(ageAtDate) !== '[object Date]')
            ageAtDate = new Date(ageAtDate);

        // if conversion to date object fails return null
        if (ageAtDate == null || birthDate == null)
            return null;


        var _m = ageAtDate.getMonth() - birthDate.getMonth();

        // answer: ageAt year minus birth year less one (1) if month and day of
        // ageAt year is before month and day of birth year
        return (ageAtDate.getFullYear()) - birthDate.getFullYear()
            - ((_m < 0 || (_m === 0 && ageAtDate.getDate() < birthDate.getDate())) ? 1 : 0)
    }

    // Below is for the attached snippet

    function showAge() {

        var myDiv = document.getElementById("nom_responsable");
        var myDiv2 = document.getElementById("relation_familiale");
        $('#age').text(calculAge($('#dob').val()))
        $('#test').val(calculAge($('#dob').val()))
        if(calculAge($('#dob').val())<18){
            myDiv.style.display = "block";
            myDiv2.style.display = "block";
        }
        else {
            myDiv.style.display = "none";
            myDiv2.style.display = "none";
        }



    }

    function showBanque()
    {
        var isCredit= document.getElementById("credit").checked;
        if (isCredit) {
            $('#banqueValue').attr('required', 'required');
            document.getElementById("banque").style.display = "block";
        }
        
    }
    function hideBanque()
    {
        var isComptant= document.getElementById("comptant").checked;
        if (isComptant) {
            $('#banqueValue').removeAttr('required');
           
           document.getElementById("banque").style.display = "none";
        }
    }


    





</script>

</body>

</html>
