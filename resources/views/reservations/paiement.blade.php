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
                    <a class="nav-link"> <b></b> </a>
                  </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                   <li class="breadcrumb-item"><a href="/projets">Accueil</a></li>
                   <li class="breadcrumb-item"><a href="/reservations">Reservations</a></li>
                   <li class="breadcrumb-item"><a href="/reservations/dossiers">Dossiers</a></li>
                   <li class="breadcrumb-item active">Paiement</li>
                </ul>
               
            </nav>

            @extends('includes.nav')
      <div class="content-wrapper">
        
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"> Paiement</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>

                </div>

                <div class="card-body">
                  <form>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="inputReçu" class="col-md-4">N°  Reçu</label>
                            <input type="text" id="" class="form-control col-md-6" name="num_reçu" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group ">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="sr" >
                                 <label for="customCheckbox1" >SR</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label for="inputMontant" class="col-md-2">Montant</label>
                            <input type="number" id="" class="form-control col-md-6" name="montant" placeholder="0.00">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label for="inputMlettre" class="col-md-2">Montant en lettre</label>
                            <input type="text" id="" class="form-control col-md-6" name="montant_lettre" placeholder="Zero Dirhams">
                          </div>
                        </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label for="inputReglement" class="col-md-2">Date de Réglement</label>
                          <input type="date" id="" class="form-control col-md-6" name="date_regelement">
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group row">
                              <label for="inputEchéance" class="col-md-2">Modalité de paiement</label>
                              <select class="form-control col-md-6" name="modalite_paiement">
                                <option selected="" disabled="">Modalité de paiement</option>
                                <option value="espece">Espèce</option>
                                <option value="cheque">Chèque</option>
                                <option value="virement">Virement</option>
                                <option value="versement">Versement</option>
                              </select>
                            </div>
                        </div>
                      <div class="col-md-12">
                          <div class="form-group row">
                              <label for="inputEchéance" class="col-md-2">Echéance</label>
                              <input type="date" class="form-control col-md-6" name="echeance">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                              <label for="inputEchéance" class="col-md-2">Banque</label>
                              <input type="text" class="form-control col-md-6" name="banque">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                              <label for="inputEchéance" class="col-md-2">N° de paiement</label>
                              <input type="text" class="form-control col-md-6" name="num_paiement">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <a href="{{'/immeubles'}}" class="btn btn-secondary float-right" style="margin-left: 2%">Annuler</a>
                          <input type="submit" value="Sauvegarder" class="btn btn-primary float-right">
                                                        
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

           
         
        </section>
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="#">JB Immo</a>.</strong>
        All rights reserved.
      </footer>
    </div>
   
  </body>

</html>
