<?php  

require_once("identifier.php");

require_once("connexion.php");

$reqassurer="SELECT * FROM assurerprincipal ";
$resultatassurer=$pdo->query($reqassurer);


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
  <title>Nouveau Bénéficiaire</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Veuillez saisir les informations du béneficiaire</h3></h1><hr>
                  </div>
                  <form  method="POST" action="insertbene.php" class="form" enctype="multipart/form-data">
                  <div class="form-group">
                      <label><h5>Nom :</h5></label>
                      <input type="text" name="nomB" class="form-control" id="exampleInputFirstName" placeholder=" Nom">
                    </div>
                    <div class="form-group">
                      <label><h5>prénom :</h5></label>
                      <input type="text" name="prenomB" class="form-control" id="exampleInputFirstName" placeholder=" prénom">
                    </div>
                    <div class="form-group">
                      <label><h5>Sexe :</h5></label>
                      <div class="radio">
                        <label for=""><input type="radio" name="sexeA" value="F"checked />  F </label>
                        <label for=""><input type="radio" name="sexeA" value="M"/> M </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label><h5>Date de naissance :</h5></label>
                      <input type="Date" name="datenaissanceB" class="form-control" id="exampleInputFirstName" placeholder=" Date de naissance ">
                    </div>
                    <label for="idagence"><h5>nom de l'assuré</h5></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="idassurer" class="form-control">
                        <?php while($assurer=$resultatassurer->fetch()) {  ?>
                           <option value="<?php echo $assurer['ID_AssurerPrincipal'] ?>">
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
                      <button type="submit" class="btn btn-success btn-block">Enregistrer</button>
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