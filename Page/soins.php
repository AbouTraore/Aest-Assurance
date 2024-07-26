<?php 
require_once("identifier.php");
require_once("connexion.php");

$date = isset($_GET['date']) ? $_GET['date'] : "";
$idmedecin = isset($_GET['idmedecin']) ? $_GET['idmedecin'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$reqmedecin = "SELECT * FROM medecin";

if ($idmedecin == 0) {
    $reqsoins = "SELECT soins.ID_Soins, soins.Nature_Soins, soins.Date_Soins, soins.Montant_Soins, soins.Analyse_Soins, medecin.Nom_Medecin 
                 FROM soins
                 INNER JOIN medecin ON soins.ID_Medecin = medecin.ID_Medecin
                 WHERE soins.Date_Soins LIKE '%$date%' 
                 ORDER BY soins.ID_Soins 
                 LIMIT $size OFFSET $offset";

    $reqcount = "SELECT COUNT(*) AS countS FROM soins WHERE Date_Soins LIKE '%$date%'";
} else {
    $reqsoins = "SELECT soins.ID_Soins, soins.Nature_Soins, soins.Date_Soins, soins.Montant_Soins, soins.Analyse_Soins, medecin.Nom_Medecin 
                 FROM soins
                 INNER JOIN medecin ON soins.ID_Medecin = medecin.ID_Medecin
                 WHERE soins.Date_Soins LIKE '%$date%' 
                 AND soins.ID_Medecin = $idmedecin 
                 ORDER BY soins.ID_Soins
                 LIMIT $size OFFSET $offset";    

    $reqcount = "SELECT COUNT(*) AS countS FROM soins WHERE Date_Soins LIKE '%$date%' AND ID_Medecin = $idmedecin";
}

$resultatmedecin = $pdo->query($reqmedecin);
$resultatS = $pdo->query($reqsoins);
$resultatcount = $pdo->query($reqcount);
$tabcount = $resultatcount->fetch();
$nbrassurer = $tabcount['countS'];
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
  <title>Gestion des soins</title>
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
            <h1 class="h3 mb-0 text-gray-800">Liste des soins</h1>
            <div>
            <form method="get" action="soins.php" class="form-inline">
              <div class="form-group">
                <input type="date" name="date" placeholder="Entrez le nom de l'agence"
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idagence">Médecin : </label>&nbsp &nbsp;
                <select name="idmedecin"id="idagence" class="form-control"
            onchange="this.form.submit()">
            <option value=0>Toutes les médecin</option>
            <?php while($medecin=$resultatmedecin->fetch()){ ?>
                    <option value="<?php echo $medecin["ID_Medecin"] ?>"
                       <?php if($medecin['ID_Medecin']===$idmedecin)echo"selected" ?>><?php echo $medecin["Nom_Medecin"] ?>
                    </option>
                    <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a  class="text-success"href="nouveausoins.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i>  Nouveau soins</a>
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
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrassurer?> Soins enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                  <thead class="thead-light">
                      <tr>
                        <th>Nature</th>
                        <th>Date de soins</th>
                        <th>Montant</th>
                        <th>Analyse</th>
                        <th>Médecin</th> <!-- Nouvelle colonne pour le nom du médecin -->
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <th>Action</th>
                        <?php }?>
                      </tr>
                    </thead>
                    <thead>
                      <?php while($soins = $resultatS->fetch()){ ?>
                      <tr>
                        <td><?php echo $soins["Nature_Soins"] ?></td>
                        <td><?php echo $soins["Date_Soins"] ?></td>
                        <td><?php echo $soins["Montant_Soins"] ?></td>
                        <td><?php echo $soins["Analyse_Soins"] ?></td>
                        <td><?php echo $soins["Nom_Medecin"] ?></td> <!-- Afficher le nom du médecin -->
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <td>
                            <a onclick="return confirm('etes vous sur de vouloir modifier')" href="modifiersoins.php?idA=<?php echo $soins["ID_Soins"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                            &nbsp &nbsp;
                            <a onclick="return confirm('etes vous sur de vouloir supprimer')" href="supprimersoins.php?idA=<?php echo $soins["ID_Soins"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                          </td>
                        <?php }?>
                      </tr>
                      <?php } ?>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nature</th>
                        <th>Date de soins</th>
                        <th>Montant</th>
                        <th>Analyse</th>
                        <th>Médecin</th>
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
                            <a class="page-link" href="soins.php?page=<?php echo $i; ?>&date=<?php echo $date; ?>&idmedecin=<?php echo $idmedecin; ?>">
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