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

                            <li class="nav-item has-treeview">
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
                                  <a href="@if(isset($projet)){{'/projets/'.$projet->id.'/tranches'}}@elseif(isset($proj)){{'/projets/'.$proj->id.'/tranches'}}@else{{'/tranches'}}@endif" class="nav-link" style="margin-left: 22px;">
                                    <i class="fab fa-buffer"></i>&nbsp;&nbsp;
                                    <p>Tranches</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="@if(isset($projet)){{'/projets/'.$projet->id.'/blocs'}}@elseif(isset($proj)){{'/projets/'.$proj->id.'/blocs'}}@else{{'/blocs'}}@endif" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-th"></i>&nbsp;&nbsp;
                                    <p>Blocs</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="@if(isset($projet)){{'/projets/'.$projet->id.'/immeubles'}}@elseif(isset($proj)){{'/projets/'.$proj->id.'/immeubles'}}@else{{'/immeubles'}}@endif" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-building"></i>&nbsp;&nbsp;
                                    <p>Immeubles</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="@if(isset($projet)){{'/projets/'.$projet->id.'/biens'}}@elseif(isset($proj)){{'/projets/'.$proj->id.'/biens'}}@else{{'/biens'}}@endif" class="nav-link" style="margin-left: 22px;">
                                    <i class="fas fa-home"></i>&nbsp;&nbsp;
                                    <p>Biens</p>
                                  </a>
                                </li>
                              </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="@if(isset($projet)){{'/projets/'.$projet->id.'/visites'}}@elseif(isset($proj)){{'/projets/'.$proj->id.'/visites'}}@endif" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Visites
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
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-stopwatch nav-icon"></i>
                                    <p>
                                        Echéances
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-exclamation-circle nav-icon"></i>
                                    <p>
                                        Désistement
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-phone-square-alt"></i>
                                    <p>
                                        Appels
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="/RH" class="nav-link">
                                    <i class="fab fa-resolving nav-icon"></i>
                                    <p>
                                        RH
                                    </p>
                                </a>
                            </li>
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
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Reporting journalier
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>
                                        Statistiques
                                    </p>
                                </a>
                            </li>
                        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
