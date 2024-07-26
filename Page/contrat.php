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
    $reqmede = "SELECT contrat.Code_Contrat , contrat.Date_signature_Contrat, contrat.DateDebut_Contrat, contrat.DateFin_Contrat, cente_sante.Nom_Cente_Sante, medecin.Nom_Medecin
                FROM contrat
                INNER JOIN cente_sante ON contrat.ID_Cente_Sante = cente_sante.ID_Cente_Sante
                INNER JOIN medecin ON contrat.medecin_id_medecin  = medecin.ID_Medecin
                WHERE contrat.Date_signature_Contrat LIKE '%$date%' 
                ORDER BY contrat.Code_Contrat
                LIMIT $size OFFSET $offset";

    $reqcount = "SELECT COUNT(*) AS countC 
                 FROM contrat 
                 WHERE Date_signature_Contrat LIKE '%$date%'";
} else {
    $reqmede = "SELECT contrat.Code_Contrat , contrat.Date_signature_Contrat, contrat.DateDebut_Contrat, contrat.DateFin_Contrat, cente_sante.Nom_Cente_Sante, medecin.Nom_Medecin
                FROM contrat
                INNER JOIN cente_sante ON contrat.ID_Cente_Sante = cente_sante.ID_Cente_Sante
                INNER JOIN medecin ON contrat.medecin_id_medecin = medecin.ID_Medecin
                WHERE contrat.Date_signature_Contrat LIKE '%$date%'
                AND contrat.ID_Medecin = $idmedecin 
                ORDER BY contrat.Code_Contrat
                LIMIT $size OFFSET $offset";    

    $reqcount = "SELECT COUNT(*) AS countC 
                 FROM contrat 
                 WHERE Date_signature_Contrat LIKE '%$date% 
                 AND contrat.ID_Medecin = $idmedecin";
}

$resultatC = $pdo->query($reqmedecin);
$resultatM = $pdo->query($reqmede);
$resultatcount = $pdo->query($reqcount);
$tabcount = $resultatcount->fetch();
$nbrassurer = $tabcount['countC'];
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
  <title>Gestion des contrat</title>
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
            <h1 class="h3 mb-0 text-gray-800">Liste des contrat</h1>
            <div>
            <form method="get" action="Medecin.php" class="form-inline">
              <div class="form-group">
                <input type="date" name="date" placeholder="Entrez le nom "
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idagence">Médecin : </label>&nbsp &nbsp;
                <select name="idmedecin" id="idagence" class="form-control"
            onchange="this.form.submit()">
            <option value=0>Toutes les médecins</option>
            <?php while($mede=$resultatC->fetch()){ ?>
                    <option value="<?php echo $mede["ID_Medecin"] ?>"
                       <?php if($mede['ID_Medecin']===$idmedecin)echo"selected" ?>><?php echo $mede["Nom_Medecin"] ?>
                    </option>
                    <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a class="text-success" href="nouveaucontrat.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i> Nouveau contrat</a>
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
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrassurer?> Contrat enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Médecin</th>
                        <th>Date de signature </th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
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
                        <td><?php echo $mede["Date_signature_Contrat"] ?></td>
                        <td><?php echo $mede["DateDebut_Contrat"] ?></td>
                        <td><?php echo $mede["DateFin_Contrat"] ?></td>
                        <td><?php echo $mede["Nom_Cente_Sante"] ?></td>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                        <td>
                          <a onclick="return confirm('êtes-vous sûr de vouloir modifier')" href="modifiercontrat.php?idA=<?php echo $mede["Code_Contrat"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                           &nbsp;
                           &nbsp;
                           &nbsp;
                          <a onclick="return confirm('êtes-vous sûr de vouloir supprimer')" href="supprimercontrat.php?idA=<?php echo $mede["Code_Contrat"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                        </td>
                        <?php }?>
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                       <th>Médecin</th>
                        <th>Date de signature </th>
                        <th>Date de debut</th>
                        <th>Date de fin</th>
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
                            <a class="page-link" href="contrat.php?page=<?php echo $i; ?>&date=<?php echo $date; ?>&idmedecin=<?php echo $idmedecin; ?>">
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