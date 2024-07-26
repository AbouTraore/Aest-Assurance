<?php 
require_once("identifier.php");
require_once("connexion.php");

$nomAg = isset($_GET['nomA']) ? $_GET['nomA'] : "";
$nomprenom = isset($_GET['nomprenom']) ? $_GET['nomprenom'] : "";
$nomMe = isset($_GET['nomMe']) ? $_GET['nomMe'] : "";
$villeAg = isset($_GET['villeA']) ? $_GET['villeA'] : "tv";

$nomCs=isset($_GET['nomC'])?$_GET['nomC']:"";
$villeCs=isset($_GET['villeC'])?$_GET['villeC']:"tv";

$size = isset($_GET['size']) ? $_GET['size'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($villeAg == "tv") {
    $req = "SELECT * FROM agence WHERE Nom_Agence LIKE '%$nomAg%' LIMIT $size OFFSET $offset";
    $tabcountagence = "SELECT COUNT(*) AS countA FROM agence WHERE Nom_Agence LIKE '%$nomAg%'";
    $reqcountAssurer = "SELECT COUNT(*) AS countAs FROM assurerprincipal WHERE Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%'";
    $reqcountMedecin = "SELECT COUNT(*) AS countM FROM medecin WHERE Nom_Medecin LIKE '%$nomMe%'";
    $reqcount="SELECT count(*) countC FROM cente_sante where Nom_Cente_sante like '%$nomCs%'";
    $reqcountbene = "SELECT COUNT(*) AS countB FROM beneficiaire WHERE Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%'";


} else {
    $req = "SELECT * FROM agence WHERE Nom_Agence LIKE '%$nomAg%' AND Ville_Agence = '$villeAg' LIMIT $size OFFSET $offset";
    $tabcountagence = "SELECT COUNT(*) AS countA FROM agence WHERE Nom_Agence LIKE '%$nomAg%' AND Ville_Agence = '$villeAg'";
    $reqcountAssurer = "SELECT COUNT(*) AS countAs FROM assurerprincipal WHERE (Nom_AssurerPrincipal LIKE '%$nomprenom%' OR Prenom_AssurerPrincipal LIKE '%$nomprenom%') AND ID_Agence = $idagence";
    $reqcountMedecin = "SELECT COUNT(*) AS countM FROM medecin WHERE Nom_Medecin LIKE '%$nomMe%' AND Specialite_Medecin = '$fonctionMe'";
    $reqcount="SELECT count(*) countC FROM cente_sante where Nom_Cente_sante like '%$nomCs%'and Ville_Cente_sante='$villeCs'";
    $reqcountbene = "SELECT COUNT(*) AS countB FROM beneficiaire WHERE (Nom_Beneficiaire LIKE '%$nomprenom%' OR Prenom_Beneficiaire LIKE '%$nomprenom%') AND ID_AssurerPrincipal = $idassurer";

}

$resultatA = $pdo->query($req);
$resultatcount = $pdo->query($tabcountagence);
$tabcountagence = $resultatcount->fetch();

$nbragence = isset($tabcountagence['countA']) ? $tabcountagence['countA'] : 0;

$resultatcountAssurer = $pdo->query($reqcountAssurer);
$tabcountAssurer = $resultatcountAssurer->fetch();

$nbrassurer = isset($tabcountAssurer['countAs']) ? $tabcountAssurer['countAs'] : 0;

$resultatcountMedecin = $pdo->query($reqcountMedecin);
$tabcountMedecin = $resultatcountMedecin->fetch();

$nbrmedecin = isset($tabcountMedecin['countM']) ? $tabcountMedecin['countM'] : 0;

$resultatcount=$pdo->query($reqcount);
$tabcount=$resultatcount->fetch();
$nbrcentre_sante=$tabcount['countC'] ? $tabcount['countC'] : 0;

$resultatcountbene = $pdo->query($reqcountbene);
$tabcountbene = $resultatcountbene->fetch();

$nbrbene = isset($tabcountbene['countB']) ? $tabcountbene['countB'] : 0;


$reste = $nbragence % $size;
if ($reste === 0) {
    $nbrPage = $nbragence / $size;
} else {
    $nbrPage = floor($nbragence / $size) + 1;
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
  <link href="../img/logo/logo.png" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart(){
        <?php
          
          
        
        
       ?>



      }




</script>
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"> nombre d'agence </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbragence?> Agences </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-home fa-3x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre de médecin</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbrmedecin?> Médecin</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-user-md fa-3x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre d'Assurer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrassurer?> Assurés</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre d'Assurer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrassurer?> Assurés</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre d'Assurer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrbene?> Bénéficiaire</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre d'Assurer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrassurer?> Assurés</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-first-aid fa-3x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre d'Assurer</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbrassurer?> Assurés</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">nombre de Centre de santé</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbrcentre_sante?> Centre de santé</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-hospital fa-3x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Géolocalisation de notre Assurance</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4" style=" border-radius 10px;">
             
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card mb-4" style=" border-radius 10px;">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.467838436863!2d-4.055887789827443!3d5.3453278946109375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1eb13ad42f723%3A0x1c011bb4933ce78d!2sUpci(Universit%C3%A9%20Populaire%20De%20C%C3%B4te%20D&#39;ivoire!5e0!3m2!1sfr!2sci!4v1721379814759!5m2!1sfr!2sci" width="100%" height="500px" style="border:0; border-radius 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
          <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developpé par Traoré Abou L3 UPCI
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div>
      </footer>
 
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>  
  
   <!-- Page level custom scripts -->
</body>


</html>