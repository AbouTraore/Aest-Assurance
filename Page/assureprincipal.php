<?php 
require_once("identifier.php");

require_once("connexion.php");

$nomprenom = isset($_GET['nomprenom']) ? $_GET['nomprenom'] : "";
$idagence = isset($_GET['idagence']) ? $_GET['idagence'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$reqagence = "SELECT * FROM agence";

if ($idagence == 0) {
    $reqAssurer = "SELECT ID_AssurerPrincipal, Nom_AssurerPrincipal, Prenom_AssurerPrincipal, Email_AssurerPrincipal, Telephone_AssurerPrincipal, DateNaissance_AssurerPrincipal, Sexe_AssurerPrincipal, DateSouscription_AssurerPrincipal, Fonction_AssurerPrincipal, Photo_AssurerPrincipal, ID_Agence
     FROM assurerprincipal
     WHERE Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%'
     order by ID_AssurerPrincipal
      LIMIT $size OFFSET $offset";

    $reqcount = "SELECT COUNT(*) AS countAs FROM assurerprincipal WHERE Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%'";
} else {
    $reqAssurer = "SELECT ID_AssurerPrincipal, Nom_AssurerPrincipal, Prenom_AssurerPrincipal, Email_AssurerPrincipal, Telephone_AssurerPrincipal, DateNaissance_AssurerPrincipal, Sexe_AssurerPrincipal, DateSouscription_AssurerPrincipal, Fonction_AssurerPrincipal, Photo_AssurerPrincipal, ID_Agence
                   FROM assurerprincipal
                   WHERE (Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%')
                   AND ID_Agence = $idagence 
                   order by ID_AssurerPrincipal
                   LIMIT $size OFFSET $offset";    

    $reqcount = "SELECT COUNT(*) AS countAs FROM assurerprincipal WHERE (Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%') AND ID_Agence = $idagence";
}

$resultatagence = $pdo->query($reqagence);
$resultatAssurer = $pdo->query($reqAssurer);
$resultatcount = $pdo->query($reqcount);
$tabcount = $resultatcount->fetch();
$nbrassurer = $tabcount['countAs'];
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
            <h1 class="h3 mb-0 text-gray-800">Liste des Assurés</h1>
            <div>
            <form method="get" action="assureprincipal.php" class="form-inline">
              <div class="form-group">
                <input type="text" name="nomprenom" placeholder="Entrez le nom "
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idagence">AGENCE : </label>&nbsp &nbsp;
                <select name="idagence"id="idagence" class="form-control"
            onchange="this.form.submit()">
            <option value=0>Toutes les Agence</option>
            <?php while($agence=$resultatagence->fetch()){ ?>
                    <option value="<?php echo $agence["ID_Agence"] ?>"
                       <?php if($agence['ID_Agence']===$idagence)echo"selected" ?>><?php echo $agence["Nom_Agence"] ?>
                    </option>
                    <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a  class="text-success"href="nouveauassurer.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i>  Nouveau Assurer</a>
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
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrassurer?> Assuré enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Télephone</th>
                        <th>Sexe</th>
                        <th>Date de souscription</th>
                        <th>Fonction</th>
                        <th>Photo</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <thead>
                        <?php while($assurer=$resultatAssurer->fetch()){ ?>
                      <tr>
                        <td><?php echo $assurer["Nom_AssurerPrincipal"] ?></td>
                        <td><?php echo $assurer["Prenom_AssurerPrincipal"] ?></td>
                        <td><?php echo $assurer["Telephone_AssurerPrincipal"] ?></td>
                        <td><?php echo $assurer["Sexe_AssurerPrincipal"] ?></td>
                        <td><?php echo $assurer["DateSouscription_AssurerPrincipal"] ?></td>
                        <td><?php echo $assurer["Fonction_AssurerPrincipal"] ?></td>
                        <td>
                          <img src="../img/assurer/<?php echo $assurer["Photo_AssurerPrincipal"] ?>"width="60px" height="60px" class="rounded-circle">
                        </td>
                          <td>
                          <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <a onclick="return confirm('etes vous sur de vouloir modifier')" href="modifierassuer.php?idA=<?php echo $assurer["ID_AssurerPrincipal"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                           &nbsp;
                          <a onclick="return confirm('etes vous sur de vouloir supprimer')" href="supprimerassuer.php?idA=<?php echo $assurer["ID_AssurerPrincipal"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                       
                          <?php }?>
                          <a onclick="return confirm('etes vous sur de vouloir voir les détaille')" href="detailleassurer.php?idA=<?php echo $assurer["ID_AssurerPrincipal"] ?>"><i class="fa fa-info-circle" aria-hidden="true"></a></i>

                        </td>
                       
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Télephone</th>
                        <th>Sexe</th>
                        <th>Date de souscription</th>
                        <th>Fonction</th>
                        <th>Photo</th>
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
                            <a class="page-link" href="assureprincipal.php?page=<?php echo $i; ?>&nomprenom=<?php echo $nomprenom; ?>&idagence=<?php echo $idagence; ?>">
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