<?php 
require_once("identifier.php");

 require_once("connexion.php");
 $nomCs=isset($_GET['nomC'])?$_GET['nomC']:"";
 $villeCs=isset($_GET['villeC'])?$_GET['villeC']:"tv";

 $size=isset($_GET['size'])?$_GET['size']:7;
 $page=isset($_GET['page'])?$_GET['page']:1;
 $offset=($page-1)* $size;


 if($villeCs=="tv"){
  $req="SELECT * FROM cente_sante where Nom_Cente_sante like '%$nomCs%'
limit $size
offset $offset";

$reqcount="SELECT count(*) countC FROM cente_sante where Nom_Cente_sante like '%$nomCs%'";


 }else{
$req="SELECT * FROM cente_sante where Nom_Cente_sante like '%$nomCs%'and Ville_Cente_sante='$villeCs'
limit $size
offset $offset";

$reqcount="SELECT count(*) countC FROM cente_sante where Nom_Cente_sante like '%$nomCs%'and Ville_Cente_sante='$villeCs'";
 }
 $resultatA=$pdo->query($req);
 $resultatcount=$pdo->query($reqcount);
 $tabcount=$resultatcount->fetch();
 $nbrcentre_sante=$tabcount['countC'];
 $reste=$nbrcentre_sante % $size;
 if($reste===0)
     $nbrPage=$nbrcentre_sante/$size;
else
    $nbrPage= floor($nbrcentre_sante/$size)+1;





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
  <title>Centre de sante</title>
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
            <h1 class="h3 mb-0 text-gray-800">Liste des centre de santes</h1>
            <div>
            <form method="get" action="centre_sante.php" class="form-inline">
              <div class="form-group">
                <input type="text" name="nomC" placeholder="Entrez le nom du centre"
                class="form-control" value="">
              </div>
              &nbsp &nbsp;
            <label for="ville">VILLE : </label>&nbsp &nbsp;
                <select name="villeC"id="ville" class="form-control"
            onchange="this.form.submit()">
              <option value="tv"<?php if($villeCs==="tv") echo "selected"?>>tous les villes</option>
              <option value="abidjan"<?php if($villeCs==="abidjan") echo "selected"?>>Abidjan</option>
              <option value="oume"<?php if($villeCs==="oume") echo "selected"?>>Oumé</option>
              <option value="bouake"<?php if($villeCs==="bouake") echo "selected"?>>Bouaké</option>
              <option value="sassandra"<?php if($villeCs==="bouake") echo "selected"?>>Sassandra</option>
            </select>
            &nbsp &nbsp;
            <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i>
            chercher...
            </button>
            &nbsp &nbsp;
        
            <a  class="text-success"href="nouvellecentresante.php"><i class="fa fa-plus  text-success" aria-hidden="true"></i> Nouveau centre </a>
          </form>
          </div>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-danger"><?php echo $nbrcentre_sante?> Centre de santes enregistré</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Nom</th>
                        <th>Adresse mail</th>
                        <th>Ville</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <th>Action</th>
                         <?php }?>
                      </tr>
                    </thead>
                    <thead>
                        <?php while($centre_sante=$resultatA->fetch()){ ?>
                      <tr>
                        
                        <td><?php echo $centre_sante["Nom_Cente_Sante"] ?></td>
                        <td><?php echo $centre_sante["Addrees_Cente_Sante"] ?></td>
                        <td><?php echo $centre_sante["Ville_Cente_Sante"] ?></td>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <td>
                            <a onclick="return confirm('etes vous sur de vouloir modifier')" href="modifiercentresante.php?idC=<?php echo $centre_sante["ID_Cente_Sante"] ?>"><i class="fa fa-edit text-success" aria-hidden="true"></a></i>
                            &nbsp;
                            <a onclick="return confirm('etes vous sur de vouloir supprimer')" href="supprimercentresante.php?idC=<?php echo $centre_sante["ID_Cente_Sante"] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"></a></i>
                          </td>

                        <?php }?>
                        
                        
                      </tr>
                      <?php } ?>
						       </thead>
                    <tfoot>
                      <tr>
                        <th>Nom</th>
                        <th>Adresse mail</th>
                        <th>Ville</th>
                        <?php if($_SESSION['user']['Role_Utilisateur']=='ADMIN') { ?>
                          <th>Action</th>
                         <?php }?>
                      </tr>
                    </tfoot>
                    <tbody>
                      
                    </tbody>
                  </table>
                  <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?php  for( $i=1;$i<=$nbrPage;$i++ ){?>
                          <li class="page-item <?php if($i==$page)echo"page-item active"?>">
                            <a class="page-link" href="Centre_sante.php?page=<?php echo $i; ?>&nomC=<?php echo $nomCs; ?>&villeC=<?php echo $villeCs; ?>">
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