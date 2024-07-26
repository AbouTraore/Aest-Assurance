<?php 
require_once("identifier.php");

require_once("connexion.php");

$date = isset($_GET['date']) ? $_GET['date'] : "";
$idbene = isset($_GET['idbene']) ? $_GET['idbene'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$reqbene = "SELECT * FROM beneficiaire";

if ($idbene == 0) {
  $reqconsu = "SELECT consultation.ID_Consultation, consultation.frai_Consultation, consultation.Date_Consultation, medecin.Nom_Medecin, beneficiaire.Nom_Beneficiaire
               FROM consultation
               INNER JOIN medecin ON consultation.ID_Medecin = medecin.ID_Medecin
               INNER JOIN beneficiaire ON consultation.ID_Beneficiaire = beneficiaire.ID_Beneficiaire
               WHERE consultation.Date_Consultation LIKE '%$date%' 
               ORDER BY consultation.ID_Consultation 
               LIMIT $size OFFSET $offset";

  $reqcount = "SELECT COUNT(*) AS countC 
               FROM consultation 
               WHERE Date_Consultation LIKE '%$date%'";
} else {
  $reqconsu = "SELECT consultation.ID_Consultation, consultation.frai_Consultation, consultation.Date_Consultation, medecin.Nom_Medecin, beneficiaire.Nom_Beneficiaire
               FROM consultation
               INNER JOIN medecin ON consultation.ID_Medecin = medecin.ID_Medecin
               INNER JOIN beneficiaire ON consultation.ID_Beneficiaire = beneficiaire.ID_Beneficiaire
               WHERE consultation.Date_Consultation LIKE '%$date%' 
               AND consultation.ID_Beneficiaire = $idbene 
               ORDER BY consultation.ID_Consultation
               LIMIT $size OFFSET $offset";

  $reqcount = "SELECT COUNT(*) AS countC 
               FROM consultation 
               WHERE Date_Consultation LIKE '%$date%'  
               AND ID_Beneficiaire = $idbene";
}


$resultatbene = $pdo->query($reqbene);
$resultatC = $pdo->query($reqconsu);
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
  <title>Gestion des Assurés</title>
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
            <h1 class="h3 mb-0 text-gray-800">Liste des Consultations</h1>
            <div>
            <form method="get" action="consultation.php" class="form-inline">
              <div class="form-group">
                <input type="date" name="date" 
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idbene">Béneficiaire : </label>&nbsp &nbsp;
                <select name="idbene"id="idbene" class="form-control"
            onchange="this.form.submit()">
            <option value=0>Toutes les Béneficiaires</option>
            <?php while($bene=$resultatbene->fetch()){ ?>
                    <option value="<?php echo $bene["ID_Beneficiaire"] ?>"
                       <?php if($bene['ID_Beneficiaire']===$idbene)echo"selected" ?>><?php echo $bene["Nom_Beneficiaire"]?>
                    </option>
                    <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a  class="text-success"href="nouveauconsu.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i>  Nouvelle Consultation</a>
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
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrassurer?> consultation enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Béneficiaire</th>
                        <th>Medecin</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <th>Action</th>
                         <?php }?>
                      </tr>
                    </thead>
                    <thead>
                        <?php while($consu=$resultatC->fetch()){ ?>
                      <tr>
                        <td><?php echo $consu["Date_Consultation"] ?></td>
                        <td><?php echo $consu["frai_Consultation"] ?></td>
                        <td><?php echo $consu["Nom_Beneficiaire"] ?></td>
                        <td><?php echo $consu["Nom_Medecin"] ?></td>

                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <td>
                          <a onclick="return confirm('etes vous sur de vouloir modifier')" href="modifierconsu.php?idA=<?php echo $consu["ID_Consultation"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                           &nbsp &nbsp;
                          <a onclick="return confirm('etes vous sur de vouloir supprimer')" href="supprimerconsu.php?idA=<?php echo $consu["ID_Consultation"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                        </td>
                         <?php }?>
                       
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Béneficiaire</th>
                        <th>Medecin</th>
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
                            <a class="page-link" href="consultation.php?page=<?php echo $i; ?>&date=<?php echo $date; ?>&idbene=<?php echo $idbene; ?>">
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