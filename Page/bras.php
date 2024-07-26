<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Agence.php">
        <div class="sidebar-brand-icon">
          <img src="../img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Gest-Assurance</div>
      </a>
      <hr class="sidebar-divider my-0">
      <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>

      <li class="nav-item active">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <?php }?>

      <hr class="sidebar-divider">
      
      <div class="sidebar-heading">
       caractéristiques
      </div>
      <hr class="sidebar-divider">
      </li>
      <li class="nav-item">
        <li class="nav-item">
        <a class="nav-link" href="Agence.php">
          <i class="fas fa-home  text-primary"></i>
          <span>Agences</span>
        </a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fas fa-users text-info"></i>
          <span>Assuré Principal</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-3 collapse-inner rounded">
            <h6 class="collapse-header">Assuré</h6>
            <a class="collapse-item" href="assureprincipal.php">Liste des Assurés</a>
            <a class="collapse-item" href="beneficiaire.php">Liste des bénéficiers</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fa fa-user-md text-success "></i>
          <span>Médecins</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-3 collapse-inner rounded">
            <h6 class="collapse-header">Médecins</h6>
            <a class="collapse-item" href="Medecin.php">Liste des médecins</a>
            <a class="collapse-item" href="soins.php">Soins</a>
            <a class="collapse-item" href="consultation.php">Consultations</a>
        </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
          aria-controls="collapsePage">
          <i class="fa fa-hospital text-warning"></i>
          <span>Centre de sante</span>
        </a>
        <div id="collapsePage" class="collapse show" aria-labelledby="headingPage" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Centre de sante</h6>
            <a class="collapse-item" href="Centre_sante.php">Liste des Centre de sante</a>
            <a class="collapse-item" href="contrat.php">Contrat</a>
          </div>
        </div>
      </li>
      
      
      <hr class="sidebar-divider">
      <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
            <li class="nav-item">
              <a class="nav-link" href="utilisateur.php">
                <i class="fa fa-user text-dark"></i>
                <span>Utilisateur</span>
              </a>
            </li>      
        <hr class="sidebar-divider">
      <?php }?>
      <div class="version" id="version-ruangadmin"></div>
    </ul>