<?php 
require_once("identifier.php");
require_once("connexion.php");

$nomprenom = isset($_GET['nomprenom']) ? $_GET['nomprenom'] : "";
$idcentre = isset($_GET['idcentre']) ? $_GET['idcentre'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$reqcentre = "SELECT * FROM cente_sante";

if ($idcentre == 0) {
    $reqmede = "SELECT medecin.ID_Medecin, medecin.Nom_Medecin, medecin.Prenom_Medecin, medecin.Specialite_Medecin, medecin.Adresse_Medecin, cente_sante.Nom_Cente_Sante
                FROM medecin
                JOIN cente_sante ON medecin.ID_Cente_Sante = cente_sante.ID_Cente_Sante
                WHERE medecin.Nom_Medecin LIKE '%$nomprenom%' OR medecin.Prenom_Medecin LIKE '%$nomprenom%'
                ORDER BY medecin.ID_Medecin
                LIMIT $size OFFSET $offset";

    $reqcount = "SELECT COUNT(*) AS countM 
                 FROM medecin 
                 WHERE Nom_Medecin LIKE '%$nomprenom%' OR Prenom_Medecin LIKE '%$nomprenom%'";
} else {
    $reqmede = "SELECT medecin.ID_Medecin, medecin.Nom_Medecin, medecin.Prenom_Medecin, medecin.Specialite_Medecin, medecin.Adresse_Medecin, cente_sante.Nom_Cente_Sante
                FROM medecin
                JOIN cente_sante ON medecin.ID_Cente_Sante = cente_sante.ID_Cente_Sante
                WHERE (medecin.Nom_Medecin LIKE '%$nomprenom%' OR medecin.Prenom_Medecin LIKE '%$nomprenom%')
                AND medecin.ID_Cente_Sante = $idcentre 
                ORDER BY medecin.ID_Medecin
                LIMIT $size OFFSET $offset";    

    $reqcount = "SELECT COUNT(*) AS countM 
                 FROM medecin  
                 WHERE (Nom_Medecin LIKE '%$nomprenom%' OR Prenom_Medecin LIKE '%$nomprenom%') 
                 AND ID_Cente_Sante = $idcentre";
}

$resultatC = $pdo->query($reqcentre);
$resultatM = $pdo->query($reqmede);
$resultatcount = $pdo->query($reqcount);
$tabcount = $resultatcount->fetch();
$nbrassurer = $tabcount['countM'];
$reste = $nbrassurer % $size;

if ($reste === 0) {
    $nbrPage = $nbrassurer / $size;
} else {
    $nbrPage = floor($nbrassurer / $size) + 1;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Gestion des Médecion</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
       require_once("bras.php");
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php require_once("menu.php"); ?> 
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Liste des Médecins</h1>
            <div>
            <form method="get" action="Medecin.php" class="form-inline">
              <div class="form-group">
                <input type="text" name="nomprenom" placeholder="Entrez le nom "
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idagence">Centre de santé : </label>&nbsp &nbsp;
                <select name="idcentre" id="idagence" class="form-control"
            onchange="this.form.submit()">
            <option value=0>Toutes les centres</option>
            <?php while($centre=$resultatC->fetch()){ ?>
                    <option value="<?php echo $centre["ID_Cente_Sante"] ?>"
                       <?php if($centre['ID_Cente_Sante']===$idcentre)echo"selected" ?>><?php echo $centre["Nom_Cente_Sante"] ?>
                    </option>
                    <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a class="text-success" href="nouveaumedecin.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i> Nouveau Médecin</a>
              <?php }?>
          </form>
          </div>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrassurer?> Médecin enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Specialite</th>
                        <th>Adresse</th>
                        <th>Centre Sante</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                        <th>Action</th>
                        <?php }?>

                      </tr>
                    </thead>
                    <thead>
                        <?php while($mede=$resultatM->fetch()){ ?>
                      <tr>
                        <td><?php echo $mede["Nom_Medecin"] ?></td>
                        <td><?php echo $mede["Prenom_Medecin"] ?></td>
                        <td><?php echo $mede["Specialite_Medecin"] ?></td>
                        <td><?php echo $mede["Adresse_Medecin"] ?></td>
                        <td><?php echo $mede["Nom_Cente_Sante"] ?></td>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                        <td>
                          <a onclick="return confirm('êtes-vous sûr de vouloir modifier')" href="modifierassuer.php?idA=<?php echo $mede["ID_Medecin"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                           &nbsp;
                           &nbsp;
                           &nbsp;
                          <a onclick="return confirm('êtes-vous sûr de vouloir supprimer')" href="supprimerassuer.php?idA=<?php echo $mede["ID_Medecin"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                        </td>
                        <?php }?>
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Specialite</th>
                        <th>Adresse</th>
                        <th>Centre Sante</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                        <th>Action</th>
                        <?php }?>
                      </tr>
                    <tbody>
                    </tbody>
                  </table>
                  <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?php  for( $i=1;$i<=$nbrPage;$i++ ){?>
                          <li class="page-item <?php if($i==$page)echo"page-item active"?>">
                            <a class="page-link" href="Medecin.php?page=<?php echo $i; ?>&nomprenom=<?php echo $nomprenom; ?>&idcentre=<?php echo $idcentre; ?>">
                              <?php  echo $i;?>
                            </a>
                          <?php } ?>
                      </li>
                        </ul>
                 </nav>
                </div>
              </div>
            </div>
            
  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->



</body>

</html>