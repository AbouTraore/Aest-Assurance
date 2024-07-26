<?php  

require_once("identifier.php");

require_once("connexion.php");

$idB=isset($_GET['idB'])?$_GET['idB']:0;
$reqbene="SELECT * FROM beneficiaire where ID_Beneficiaire=$idB";
$resultatbene=$pdo->query($reqbene);
$bene=$resultatbene->fetch();
$nomB=$bene['Nom_Beneficiaire'];
$prenomB=$bene ['Prenom_Beneficiaire']; 
$datenaissanceB=$bene['DateNaissance_Beneficiaire'];
$sexeB=strtoupper($bene ['Sexe_Beneficiaire']); 
$photoB=$bene['Photo_Beneficiaire'];
$idAs=$bene['ID_AssurerPrincipal'];

$reqassurer="SELECT * FROM assurerprincipal ";
$resultatAs=$pdo->query($reqassurer);


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
  <title>Modification d'un bénéficiaire </title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Modification de l'bénéficiaire</h3></h1><hr>
                  </div>
                  <form  method="POST" action="updatebene.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><h5>ID du bénéficiaire : <?php echo $idB ?></h5></label>
                        <input type="hidden"name="idB" class="form-control" id="exampleInputFirstName" value="<?php echo $idB ?>">
                        </div>  
                    <div class="form-group">
                      <label><h5>Nom :</h5></label>
                      <input type="text" name="nomB" class="form-control" id="exampleInputFirstName" placeholder=" Nom  "value="<?php echo $nomB ?>">
                    </div>
                    <div class="form-group">
                      <label><h5>prénom :</h5></label>
                      <input type="text" name="prenomB" class="form-control" id="exampleInputFirstName" placeholder=" prénom  "value="<?php echo $prenomB ?>">
                    </div>
                    <div class="form-group">
                      <label><h5>Sexe :</h5></label>
                      <div class="radio">
                        <label for=""><input type="radio" name="sexeB" value="F"
                        <?php if($sexeB==="F")echo "checked"?> checked />  F </label>
                        <label for=""><input type="radio" name="sexeB" value="M" 
                        <?php if($sexeB==="M")echo "checked"?>/> M </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><h5>Date de naissance :</h5></label>
                      <input type="Date" name="datenaissanceB" class="form-control" id="exampleInputFirstName" placeholder=" Date de naissance  "value="<?php echo $datenaissanceB ?>">
                    </div>
                    
                    <label for="idassurer"><h4>Assuré</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="idbene" class="form-control">
                        <?php while($assurer=$resultatAs->fetch()) {  ?>
                           <option value="<?php echo $assurer['ID_AssurerPrincipal'] ?>"
                           <?php if($idAs===$assurer['ID_AssurerPrincipal']) echo "selected" ?>>
                            <?php echo $assurer['Nom_AssurerPrincipal'] ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>       
                    <div class="form-group">
                      <label><h5>Photo :</h5></label>
                      <input type="file" name="photoB">
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