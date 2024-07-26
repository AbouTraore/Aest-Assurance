<?php 
require_once("identifier.php");

require_once("connexion.php");

$nomprenom = isset($_GET['nomprenom']) ? $_GET['nomprenom'] : "";
$idassurer = isset($_GET['idassurer']) ? $_GET['idassurer'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$reqassurer = "SELECT * FROM assurerprincipal";

if ($idassurer == 0) {
    $reqbene = "SELECT ID_Beneficiaire, Nom_Beneficiaire, Prenom_Beneficiaire, DateNaissance_Beneficiaire, Sexe_Beneficiaire,  Photo_Beneficiaire, ID_AssurerPrincipal
     FROM beneficiaire
     WHERE Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%'
     order by ID_Beneficiaire
      LIMIT $size OFFSET $offset";

    $reqcountbene = "SELECT COUNT(*) AS countB FROM beneficiaire WHERE Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%'";
} else {
    $reqbene = "SELECT ID_Beneficiaire, Nom_Beneficiaire, Prenom_Beneficiaire, DateNaissance_Beneficiaire, Sexe_Beneficiaire,  Photo_Beneficiaire, ID_AssurerPrincipal
                   FROM beneficiaire
                   WHERE (Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%')
                   AND ID_AssurerPrincipal = $idassurer 
                   order by ID_Beneficiaire
                   LIMIT $size OFFSET $offset";    

    $reqcountbene = "SELECT COUNT(*) AS countB FROM beneficiaire WHERE (Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%') AND ID_AssurerPrincipal = $idassurer";
}

$resultatassurer = $pdo->query($reqassurer);
$resultatbene = $pdo->query($reqbene);
$resultatcountbene = $pdo->query($reqcountbene);
$tabcountbene = $resultatcountbene->fetch();
$nbrbene = $tabcountbene['countB'];
$reste = $nbrbene % $size;

if ($reste === 0) {
    $nbrPage = $nbrbene / $size;
} else {
    $nbrPage = floor($nbrbene / $size) + 1;
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
  <title>Gestion des Bénéficiaire</title>
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
            <h1 class="h4 mb-0 text-gray-800">Liste des Bénéficiaires</h1>
            <div>
            <form method="get" action="beneficiaire.php" class="form-inline">
              <div class="form-group">
                <input type="text" name="nomprenom" placeholder="Entrez le nom "
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="idassurer">AGENCE : </label>&nbsp &nbsp;
                <select name="idassurer"id="idassurer" class="form-control"
                onchange="this.form.submit()">
                        <option value=0>Toutes les Assurés</option>
                        <?php while($assurer=$resultatassurer->fetch()){ ?>
                          <option value="<?php echo $assurer["ID_AssurerPrincipal"] ?>"
                            <?php if($assurer['ID_AssurerPrincipal']===$idassurer)echo"selected" ?>><?php echo $assurer["Nom_AssurerPrincipal"] ?>
                          </option>
                        <?php }?>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
             &nbsp;
             <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
              <a  class="text-success"href="nouveaubene.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i>  Nouveau béneficaire</a>
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
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrbene?> béneficaire enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
                        <th>Photo</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <th>Action</th>
                         <?php }?>
                      </tr>
                    </thead>
                    <thead>
                        <?php while($bene=$resultatbene->fetch()){ ?>
                      <tr>
                        <td><?php echo $bene["Nom_Beneficiaire"] ?></td>
                        <td><?php echo $bene["Prenom_Beneficiaire"] ?></td>
                        <td><?php echo $bene["DateNaissance_Beneficiaire"] ?></td>
                        <td><?php echo $bene["Sexe_Beneficiaire"] ?></td>
                        <td>
                          <img src="../img/beneficiaire/<?php echo $bene["Photo_Beneficiaire"] ?>"width="60px" height="60px" class="rounded-circle">
                        </td>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <td>
                          <a onclick="return confirm('etes vous sur de vouloir modifier')" href="modifierbene.php?idB=<?php echo 
                          $bene["ID_Beneficiaire"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                           &nbsp &nbsp;
                          <a onclick="return confirm('etes vous sur de vouloir supprimer')" href="supprimerbene.php?idB=<?php echo $bene["ID_Beneficiaire"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                        </td>
                         <?php }?>
                       
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
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
                            <a class="page-link" href="beneficiaire.php?page=<?php echo $i; ?>&nomprenom=<?php echo $nomprenom; ?>&idassurer=<?php echo $idassurer; ?>">
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










