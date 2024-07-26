<?php  

require_once("identifier.php");

require_once("connexion.php");

$idAs=isset($_GET['idA'])?$_GET['idA']:0;
$reqconsu="SELECT * FROM contrat where Code_Contrat=$idAs";
$resultat=$pdo->query($reqconsu);
$assurer=$resultat->fetch();
$dateS=$assurer['Date_signature_Contrat'];
$dateD=$assurer ['DateDebut_Contrat'];
$dateF=$assurer ['DateFin_Contrat']; 
$idM=$assurer['medecin_id_medecin']; 
$idC=$assurer ['ID_Cente_Sante']; 

$reqmedecin="SELECT * FROM medecin ";
$resultatM=$pdo->query($reqmedecin);


$reqcentre="SELECT * FROM cente_sante ";
$resultatB=$pdo->query($reqcentre);




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
  <title>Modification des contrat</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Modification des Contrat</h3></h1><hr>
                  </div>
                  <form  method="POST" action="updatecontrat.php" class="form" >
                    <div class="form-group">
                        <label><h5>Identifiant de contrat : <?php echo $idAs ?></h5></label>
                        <input type="hidden"name="idA" class="form-control" id="exampleInputFirstName" value="<?php echo $idAs ?>">
                    </div>  
                    <div class="form-group">
                      <label><h5>Date de signature du contrat :</h5></label>
                      <input type="date" name="dateS" class="form-control" id="exampleInputFirstName" placeholder=" date de Consultation" value="<?php echo $dateS ?>">
                    </div>
                    <div class="form-group">
                      <label><h5>Date de début du contrat :</h5></label>
                      <input type="date" name="dateD" class="form-control" id="exampleInputFirstName" placeholder=" date de Consultation"value="<?php echo $dateD ?>">
                    </div>
                    <div class="form-group">
                      <label><h5>Date de Fin du contrat :</h5></label>
                      <input type="date" name="dateF" class="form-control" id="exampleInputFirstName" placeholder=" date de Consultation"value="<?php echo $dateF ?>">
                    </div>
                    <label for="idagence"><h4>Médecin</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="idmedecin" class="form-control">
                        <?php while($medecin=$resultatM->fetch()) {  ?>
                           <option value="<?php echo $medecin['ID_Medecin'] ?>"
                           <?php if($idM===$medecin['ID_Medecin']) echo "selected"?>>
                            <?php echo $medecin['Nom_Medecin'] ?>
                        </option>
                        <?php } ?>
                      </select>
                      <label for="idagence"><h4>Centre de santé</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="idcentre" class="form-control">
                        <?php while($centre=$resultatB->fetch()) {  ?>
                           <option value="<?php echo $centre['ID_Cente_Sante'] ?>">
                            <?php echo $centre['Nom_Cente_Sante'] ?>
                        </option> 
                        <?php } ?>
                      </select>
                     </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                    </div>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>