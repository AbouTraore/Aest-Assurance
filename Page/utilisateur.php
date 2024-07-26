<?php 

require_once("identifier.php");

require_once("connexion.php");

$login = isset($_GET['login']) ? $_GET['login'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
$requtilisateur = "SELECT * FROM utilisateur where Login_Utilisateur like '%$login%'";
$reqcount = "SELECT COUNT(*) countU FROM utilisateur";

$resultatutilisateur = $pdo->query($requtilisateur);
$resultatcount = $pdo->query($reqcount);
$tabcount = $resultatcount->fetch();
$nbrutilisateur = $tabcount['countU'];
$reste = $nbrutilisateur % $size;

if ($reste === 0) {
    $nbrPage = $nbrutilisateur / $size;
} else {
    $nbrPage = floor($nbrutilisateur / $size) + 1;
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
  <title>Gestion des Utilisateurs</title>
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
            <h1 class="h3 mb-0 text-gray-800">Liste des Utilisateurs</h1>
            <div>
            <form method="get" action="utilisateur.php" class="form-inline">
              <div class="form-group">
                <input type="text" name="login" placeholder="login"
                class="form-control" value="<?php echo $login?>">
              </div>
              &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
          </form>
          </div>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrutilisateur?> Utilisateurs enregristrer</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                    <tr>
                        <th>Login</th>
                        <th >Role</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead >
                    <thead>
                        <?php while($utilisateur=$resultatutilisateur->fetch()){ ?>
                      <tr class="<?php echo $utilisateur["Etat_Utilisateur"]==1?'bg-success':'bg-danger' ?>">
                        <td><?php echo $utilisateur["Login_Utilisateur"] ?></td>
                        <td><?php echo $utilisateur["Role_Utilisateur"] ?></td>
                        <td><?php echo $utilisateur["email_Utilisateur"] ?></td>
                        <td>
                          <a onclick="return confirm('etes vous sur de vouloir modifier cet utilisateur')" href="modifierutilisateur.php?idU=<?php echo $utilisateur["ID_Utilisateur"] ?>"><i class="fa fa-edit text-default" aria-hidden="true"></a></i>
                           &nbsp;
                          <a onclick="return confirm('etes vous sur de vouloir supprimer cet utilisateur')" href="supprimerutilisateur.php?idU=<?php echo $utilisateur["ID_Utilisateur"] ?>"><i class="fa fa-trash text-default" aria-hidden="true"></a></i>
                          &nbsp;
                          <a href="Activerutilisateur.php?idU=<?php echo $utilisateur["ID_Utilisateur"] ?>&etat=<?php echo $utilisateur["Etat_Utilisateur"] ?>">
                          <?php 
                              if($utilisateur["Etat_Utilisateur"]==1)
                                 echo'<i class="fa fa-times" aria-hidden="true"></i>';
                             else
                                echo'<i class="fa fa-check" aria-hidden="true"></i>';
                          ?>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                    <tr>
                        <th class>Login</th>
                        <th class>Role</th>
                        <th class>Email</th>
                        <th class>Actions</th>
                      </tr>
                    <tbody>
                      
                    </tbody>
                  </table>
                  <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?php  for( $i=1;$i<=$nbrPage;$i++ ){?>
                          <li class="page-item <?php if($i==$page)echo"page-item active"?>">
                            <a class="page-link" href="utilisateur.php?page=<?php echo $i; ?>&login=<?php echo $login; ?> ">
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