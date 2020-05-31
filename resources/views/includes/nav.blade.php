<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #03121f;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="background: #03121f;">
        <img src="/dist/img/logo-jbimmobilier.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><Strong>JB</Strong> IMMOBILIER</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



                <!--  <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-cubes"></i>
                       <p>
                         Stock
                         <i class="fas fa-angle-left right"></i>
                       </p>
                     </a>
                     <ul class="nav nav-treeview">
                       <li class="nav-item">
                         <a href="/projets" class="nav-link" style="margin-left: 22px;">
                           <i class="fas fa-project-diagram"></i>&nbsp;&nbsp;
                           <p>Projets</p>
                         </a>
                       </li>
                       <li class="nav-item">
                         <a href="/tranches" class="nav-link" style="margin-left: 22px;">
                           <i class="fab fa-buffer"></i>&nbsp;&nbsp;
                           <p>Tranches</p>
                         </a>
                       </li>
                       <li class="nav-item">
                         <a href="/blocs" class="nav-link" style="margin-left: 22px;">
                           <i class="fas fa-th"></i>&nbsp;&nbsp;
                           <p>Blocs</p>
                         </a>
                       </li>
                       <li class="nav-item">
                         <a href="/immeubles" class="nav-link" style="margin-left: 22px;">
                           <i class="fas fa-building"></i>&nbsp;&nbsp;
                           <p>Immeubles</p>
                         </a>
                       </li>
                       <li class="nav-item">
                         <a href="/biens" class="nav-link" style="margin-left: 22px;">
                           <i class="fas fa-file-contract"></i>&nbsp;&nbsp;
                           <p>Biens</p>
                         </a>
                       </li>
                     </ul>
                 </li> -->
                @if(Auth::user()->is_admin<2)
                    <li class="nav-item has-treeview">
                        <a href="/projets" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"> </i>
                            <p>
                                Stock
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="/clients" class="nav-link">
                            <i class="nav-icon fas fa-book-reader"> </i>
                            <p>
                                Clients
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Réservations
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/reservations/dossiers" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-folder"></i>&nbsp;&nbsp;
                                    <p>Dossiers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="reservations/paiement" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;
                                    <p>Paiement</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::user()->is_admin==1)
                    <li class="nav-item has-treeview">
                        <a href="/RH" class="nav-link">
                            <i class="fab fa-resolving nav-icon"></i>

                            <p>
                                RH
                            </p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->is_admin==2)
                    <li class="nav-item has-treeview">
                        <a href="/appels" class="nav-link">
                            <i class="fab fa-resolving nav-icon"></i>

                            <p>
                                Appels
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="/appels/relance" class="nav-link">
                            <i class="fab fa-resolving nav-icon"></i>

                            <p>
                                Relance
                            </p>
                        </a>
                    </li>
                @elseif(Auth::user()->is_admin==0)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Appels
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{'/appels/traite/' . Auth::user()->id}}"class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-folder"></i>&nbsp;&nbsp;
                                    <p> Traité</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{'/appels/recu/' . Auth::user()->id}}" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;
                                    <p>Reçu </p><p style="margin-left: 10px">{{ $nbre_appel_recu  ?? '' }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif
                <li class="nav-item has-treeview">
                    @if(Auth::user()->is_admin==1)
                        <a href="/users" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Utilisateurs
                            </p>
                        </a>

                    @else

                        <a href=" {{'/profil/' . Auth::user()->id}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profil
                            </p>
                        </a>

                    @endif
                </li>

            </ul>
        </nav>



        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


