<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/register', 'HomeController@register');
Route::get('/projets', 'HomeController@home')->middleware('auth');
Route::get('/home', 'HomeController@home')->middleware('auth');
Route::get('/searchBien','BienController@searchBien')->middleware('auth');
Route::get('/searchImmeuble','ImmeubleController@searchImmeuble')->middleware('auth');
Route::get('/searchBloc','BlocController@searchBloc')->middleware('auth');
Route::get('/searchTranche','TrancheController@searchTranche')->middleware('auth');
Route::get('/searchProjet','ProjetController@searchProjet')->middleware('auth');
Route::get('/searchClient', 'ClientController@searchClient')->middleware('auth');
Route::get('/searchUser', 'UserController@searchUSer');

/****************************************************************************
									Stock
*****************************************************************************/

/***********************************Projet************************************/

Route::get('/projets/detail/{id}', 'ProjetController@detail_projet')->middleware('auth');
Route::get('/projets/nouveau_projet', 'ProjetController@ajouterProjet')->middleware('auth');
Route::put('/projets/add_projet', 'ProjetController@store')->middleware('auth');
Route::get('/projets/modifier_projet/{id}', 'ProjetController@modifierProjet')->middleware('auth');
Route::put('/projets/edit_projet/{id}', 'ProjetController@edit')->middleware('auth');
Route::get('/projets/supprimer_projet/{id}', 'ProjetController@destroy')->middleware('auth');


/***********************************Tranche By Projet************************************/

Route::get('/projets/{id}/tranches', 'TrancheController@getTrancheByProjet')->middleware('auth');
Route::get('/projets/{id}/nouvelle_tranche', 'TrancheController@ajouterTrancheByProjet')->middleware('auth');
Route::put('/tranches/addTrancheByProjet/{id}', 'TrancheController@storeByProjet')->middleware('auth');
Route::get('/projets/{projet_id}/modifier_tranche/{id}', 'TrancheController@modifierTrancheByProjet')->middleware('auth');

Route::put('/projets/{projet_id}/edit_tranche/{id}', 'TrancheController@editByProjet')->middleware('auth');
Route::get('/projets/{projet_id}/supprimer_tranche/{id}', 'TrancheController@destroyByProjet')->middleware('auth');


/***********************************Tranche ************************************/
Route::get('/tranches', 'TrancheController@index')->middleware('auth');
Route::get('/tranches/detail/{id}', 'TrancheController@detail_tranche')->middleware('auth');
Route::get('/tranches/nouvelle_tranche', 'TrancheController@ajouterTranche')->middleware('auth');
Route::put('/tranches/add_tranche', 'TrancheController@store')->middleware('auth');
Route::get('/tranches/modifier_tranche/{id}', 'TrancheController@modifierTranche')->middleware('auth');
Route::put('/tranches/edit_tranche/{id}', 'TrancheController@edit')->middleware('auth');
Route::get('/tranches/supprimer_tranche/{id}', 'TrancheController@destroy')->middleware('auth');


/***********************************Bloc By Projet************************************/
Route::get('/projets/{id}/blocs', 'BlocController@getBlocByProjet')->middleware('auth');
Route::get('/projets/{id}/nouveau_bloc', 'BlocController@ajouterBlocByProjet')->middleware('auth');
Route::get('/projets/{projet_id}/supprimer_bloc/{id}', 'BlocController@destroyByProjet')->middleware('auth');

Route::put('/blocs/addBlocByProjet/{id}', 'BlocController@storeByProjet')->middleware('auth');

/***********************************Bloc By Tranche************************************/
Route::get('/tranches/{id}/blocs', 'BlocController@getBlocByTranche')->middleware('auth');
Route::get('/tranches/{id}/nouveau_bloc', 'BlocController@ajouterBlocByTranche')->middleware('auth');
Route::put('/blocs/addBlocByTranche/{id}', 'BlocController@storeByTranche')->middleware('auth');
Route::get('/tranches/{tranche_id}/supprimer_bloc/{id}', 'BlocController@destroyByTranche')->middleware('auth');
Route::post('/blocs/getTranchesByProjetId','BlocController@getTranchesByProjetId');


/***********************************Blocs ************************************/
Route::get('/blocs', 'BlocController@index')->middleware('auth');
Route::get('/blocs/detail/{id}', 'BlocController@detail_bloc')->middleware('auth');
Route::get('/blocs/nouveau_bloc', 'BlocController@ajouterBloc')->middleware('auth');
Route::put('/blocs/add_bloc', 'BlocController@store')->middleware('auth');
Route::get('/blocs/modifier_bloc/{id}', 'BlocController@modifierBloc')->middleware('auth');
Route::put('/blocs/edit_bloc/{id}', 'BlocController@edit')->middleware('auth');
Route::get('/blocs/supprimer_bloc/{id}', 'BlocController@destroy')->middleware('auth');

/***********************************Immeubles By Projet************************************/
Route::get('/projets/{id}/immeubles', 'ImmeubleController@getImmeubleByProjet')->middleware('auth');

Route::get('/projets/{id}/nouvel_immeuble', 'ImmeubleController@ajouterImmeubleByProjet')->middleware('auth');
Route::put('/immeubles/addImmeubleByProjet/{id}', 'ImmeubleController@storeByProjet')->middleware('auth');
Route::get('/projets/{projet_id}/supprimer_immeuble/{id}', 'ImmeubleController@destroyByProjet')->middleware('auth');

/***********************************Immeubles By Tranche************************************/
Route::get('/tranches/{id}/immeubles', 'ImmeubleController@getImmeubleByTranche')->middleware('auth');
Route::get('/tranches/{id}/nouvel_immeuble', 'ImmeubleController@ajouterImmeubleByTranche')->middleware('auth');
Route::put('/immeubles/addImmeubleByTranche/{id}', 'ImmeubleController@storeByTranche')->middleware('auth');
Route::get('/tranches/{tranche_id}/supprimer_immeuble/{id}', 'ImmeubleController@destroyByTranche')->middleware('auth');
Route::post('/immeubles/getTranchesByProjetId','ImmeubleController@getTranchesByProjetId');

/***********************************Immeubles By Bloc************************************/
Route::get('/blocs/{id}/immeubles', 'ImmeubleController@getImmeubleByBloc')->middleware('auth');
Route::get('/blocs/{id}/nouvel_immeuble', 'ImmeubleController@ajouterImmeubleByBloc')->middleware('auth');
Route::put('/immeubles/addImmeubleByBloc/{id}', 'ImmeubleController@storeByBloc')->middleware('auth');
Route::get('/blocs/{bloc_id}/supprimer_immeuble/{id}', 'ImmeubleController@destroyByBloc')->middleware('auth');
Route::post('/immeubles/getBlocsByTrancheId','ImmeubleController@getBlocsByTrancheId');

/***********************************Immeubles ************************************/
Route::get('/immeubles', 'ImmeubleController@index')->middleware('auth');
Route::get('/immeubles/detail/{id}', 'ImmeubleController@detail_immeuble')->middleware('auth');
Route::get('/immeubles/nouvel_immeuble', 'ImmeubleController@ajouterImmeuble')->middleware('auth');
Route::put('/immeubles/add_immeuble', 'ImmeubleController@store')->middleware('auth');
Route::get('/immeubles/modifier_immeuble/{id}', 'ImmeubleController@modifierImmeuble')->middleware('auth');
Route::put('/immeubles/edit_immeuble/{id}', 'ImmeubleController@edit')->middleware('auth');
Route::get('/immeubles/supprimer_immeuble/{id}', 'ImmeubleController@destroy')->middleware('auth');


/***********************************Biens By Projet************************************/
Route::get('/projets/{id}/biens', 'BienController@getBienByProjet')->middleware('auth');

Route::get('/projets/{id}/nouveau_bien', 'BienController@ajouterBienByProjet')->middleware('auth');
Route::put('/biens/addBienByProjet/{id}', 'BienController@storeByProjet')->middleware('auth');
Route::get('/projets/{projet_id}/supprimer_bien/{id}', 'BienController@destroyByProjet')->middleware('auth');

/***********************************Biens By Tranche************************************/
Route::get('/tranches/{id}/biens', 'BienController@getBienByTranche')->middleware('auth');
Route::get('/tranches/{id}/nouveau_bien', 'BienController@ajouterBienByTranche')->middleware('auth');
Route::put('/biens/addBienByTranche/{id}', 'BienController@storeByTranche')->middleware('auth');
Route::get('/tranches/{tranche_id}/supprimer_bien/{id}', 'BienController@destroyByTranche')->middleware('auth');
Route::post('/biens/getTranchesByProjetId','BienController@getTranchesByProjetId');
Route::post('/biens/getNiveauByTrancheId','BienController@getNiveauByTrancheId');

/***********************************Biens By Bloc************************************/
Route::get('/blocs/{id}/biens', 'BienController@getBienByBloc')->middleware('auth');
Route::get('/blocs/{id}/nouveau_bien', 'BienController@ajouterBienByBloc')->middleware('auth');
Route::put('/biens/addBienByBloc/{id}', 'BienController@storeByBloc')->middleware('auth');
Route::get('/blocs/{bloc_id}/supprimer_bien/{id}', 'BienController@destroyByBloc')->middleware('auth');
Route::post('/biens/getBlocsByTrancheId','BienController@getBlocsByTrancheId');

/***********************************Biens By Immeuble ************************************/
Route::get('/immeubles/{id}/biens', 'BienController@getBienByImmeuble')->middleware('auth');
Route::get('/immeubles/{id}/nouveau_bien', 'BienController@ajouterBienByImmeuble')->middleware('auth');
Route::put('/biens/addBienByImmeuble/{id}', 'BienController@storeByImmeuble')->middleware('auth');
Route::get('/immeubles/{immeuble_id}/supprimer_bien/{id}', 'BienController@destroyByImmeuble')->middleware('auth');
Route::post('/biens/getImmeublesByBlocId','BienController@getImmeublesByBlocId');

/***********************************Biens ************************************/
Route::get('/biens', 'BienController@index')->middleware('auth');
Route::get('/biens/detail/{id}', 'BienController@detail_bien')->middleware('auth');
Route::get('/biens/nouveau_bien', 'BienController@ajouterBien')->middleware('auth');
Route::put('/biens/add_bien', 'BienController@store')->middleware('auth');
Route::get('/biens/modifier_bien/{id}', 'BienController@modifierBien')->middleware('auth');
Route::put('/biens/edit_bien/{id}', 'BienController@edit')->middleware('auth');
Route::get('/biens/supprimer_bien/{id}', 'BienController@destroy')->middleware('auth');
Route::post('/biens/getBiensDispoByTrancheId','BienController@getBiensDispoByTrancheId');
Route::post('/biens/getBiensDispoByImmeubleId','BienController@getBiensDispoByImmeubleId');
Route::get('/biens/getPrixByBienId', 'BienController@getPrixByBienId')->middleware('auth');


/****************************************************************************
									Users
*****************************************************************************/
Route::get('/users', 'UserController@index')->middleware('auth');
Route::get('/users/nouveau_user', 'UserController@ajouterUser')->middleware('auth');
Route::put('/users/add_user', 'UserController@store')->middleware('auth');
Route::get('/users/detail/{id}', 'UserController@show')->middleware('auth');
Route::get('/users/modifier_user/{id}', 'UserController@edit')->middleware('auth');
Route::put('/users/update_user/{id}', 'UserController@update')->middleware('auth');
Route::get('/users/supprimer_user/{id}', 'UserController@destroy')->middleware('auth');
Route::get('/users/search', 'UserController@search');

Route::get('/profil/{id}', 'UserController@indexProfil')->middleware('auth');
Route::get('/profil/modifier_profil/{id}', 'UserController@editProfil')->middleware('auth');
Route::put('/profil/update_profil/{id}', 'UserController@updateProfil')->middleware('auth');

/****************************************************************************
									Clients
*****************************************************************************/
Route::get('/clients', 'ClientController@index')->middleware('auth');
Route::get('/clients/nouveau_client', 'ClientController@ajouterClient')->middleware('auth');
Route::put('/clients/add_client', 'ClientController@store')->middleware('auth');
Route::get('/clients/modifier_client/{id}', 'ClientController@edit')->middleware('auth');
Route::put('/clients/update_client/{id}', 'ClientController@update')->middleware('auth');
Route::get('/clients/supprimer_client/{id}', 'ClientController@destroy')->middleware('auth');
Route::get('/clients/detail/{id}', 'ClientController@show')->middleware('auth');
Route::get('/clients/search', 'ClientController@search');

Route::get('/dossiers/{id}/nouvel_aquereur', 'ClientController@nouvel_aquereur')->middleware('auth');
Route::put('/dossiers/{id}/add_nouvel_aquereur', 'ClientController@store_nouvel_aquereur')->middleware('auth');


/****************************************************************************
									Réservation
*****************************************************************************/
Route::get('/reservations/dossiers', 'ReservationController@dossier_all')->middleware('auth');
Route::get('/clients/{id}/ajouter_dossier', 'ReservationController@ajouter_dossier')->middleware('auth');
Route::put('/clients/{id}/add_dossier', 'ReservationController@store_dossier')->middleware('auth');
Route::put('/dossiers/add_dossier', 'ReservationController@store_dossier')->middleware('auth');
Route::get('/clients/{id}/dossiers', 'ReservationController@show_dossiers')->middleware('auth');
Route::get('/dossiers/modifier_dossier/{id}', 'ReservationController@edit_dossier')->middleware('auth');
Route::get('/dossiers/supprimer_dossier/{id}', 'ReservationController@destroy_dossier')->middleware('auth');
Route::get('/dossiers/{id}/detail_dossier', 'ReservationController@detail_dossier')->middleware('auth');
Route::get('/dossiers/{id}/paiement', 'ReservationController@paiement')->middleware('auth');
Route::get('/reservations/nouveau_dossier', 'ReservationController@ajouter_dossier')->middleware('auth');
Route::put('/dossiers/{id}/add_aquereur', 'reservationController@store_aquereur')->middleware('auth');
Route::get('/dossiers/{dossier_id}/supprimer_aquereur/{aq_id}', 'ReservationController@destroy_aquereur')->middleware('auth');

/***********************************Paiement************************************/
Route::put('/dossiers/{id}/add_paiement', 'reservationController@storepaiment')->middleware('auth');
Route::put('/dossiers/{id}/update_paiement', 'reservationController@updatepaiment')->middleware('auth');



/****************************************************************************
									Visites
*****************************************************************************/
Route::get('/projets/{id}/visites', 'VisiteController@getVisitesByProjet')->middleware('auth');
Route::get('/projets/{id}/nouvelle_visite', 'VisiteController@ajouter_visite')->middleware('auth');
Route::put('/projets/{id}/add_visite', 'VisiteController@store')->middleware('auth');
Route::get('/visites/detail/{id}', 'VisiteController@detail_visite')->middleware('auth');
Route::get('/visites/deuxieme_visite/{id}', 'VisiteController@deuxieme_visite')->middleware('auth');


Route::get('/searchVisit','VisiteController@searchVisite')->middleware('auth');
Route::get('/visites/{projet_id}/modifier_visite/{id}', 'VisiteController@modifier_visite')->middleware('auth');
Route::put('/visites/{projet_id}/modifier_visite/{id}', 'VisiteController@edit')->middleware('auth');
Route::get('/visites/supprimer_visite/{id}', 'VisiteController@destroy')->middleware('auth');

/*****************************appels*********/
Route::get('/appels', 'AppelController@index')->middleware('auth');
Route::get('/appels/nouveau_appel', 'AppelController@ajouterAppel')->middleware('auth');
Route::put('/appels/add_appel', 'AppelController@store')->middleware('auth');
Route::get('/appels/supprimer_appel/{id}', 'AppelController@destroy')->middleware('auth');
Route::get('/searchAppel', 'AppelController@searchAppel');
Route::get('/appels/detail/{id}', 'AppelController@show')->middleware('auth');


Route::get('/appels/modifier_appel/{id}', 'AppelController@editAppel')->middleware('auth');
Route::put('/appels/update_appel_assistante/{id}', 'AppelController@updateAppelAss')->middleware('auth');
Route::put('/appels/update_appel_commercial/{id}', 'AppelController@updateAppelComm')->middleware('auth');



Route::get('/appels/recu/{id}', 'AppelController@indexAppelrecu')->middleware('auth');
Route::get('/appels/traite/{id}', 'AppelController@indexAppelTrait')->middleware('auth');
Route::get('/appels/recu/traiter_appel/{id}', 'AppelController@traiterAppelrecu')->middleware('auth');
Route::put('/appels/recu/update_appel/{id}', 'AppelController@updateTraiterAppelrecu')->middleware('auth');
Route::get('/appels/relance', 'AppelController@relanceAppel')->middleware('auth');


/************************RH***********************/
Route::get('/RH', 'EmployeController@index')->middleware('auth');

Route::get('/RH/nouveau_employe', 'EmployeController@ajouterEmp')->middleware('auth');
Route::put('/RH/add_employe', 'EmployeController@storeEmp')->middleware('auth');
Route::get('/RH/detail_employe/{id}', 'EmployeController@show')->middleware('auth');
Route::get('/RH/supprimer_employe/{id}', 'EmployeController@destroy')->middleware('auth');
Route::get('/searchEmp', 'EmployeController@searchEmp');

Route::get('/RH/modifier_employe/{id}', 'EmployeController@edit')->middleware('auth');
Route::put('/RH/update_employe/{id}', 'EmployeController@update')->middleware('auth');
