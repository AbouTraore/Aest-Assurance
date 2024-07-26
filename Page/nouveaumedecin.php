<?php 
require_once("identifier.php");
require_once("connexion.php");

$reqcente_sante = "SELECT * FROM cente_sante";
$resultatC=$pdo->query($reqcente_sante);

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
  <title>Nouveau Médecin</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Veuillez saisir les données du médecin</h3></h1><hr>
                  </div>
                  <form  method="POST" action="insertmedecin.php" class="form">
                    <div class="form-group">
                      <label><h4>Nom :</h4></label>
                      <input type="text" name="nomM" class="form-control" id="exampleInputFirstName" placeholder="Nom ">
                    </div>
                    <div class="form-group">
                      <label><h4>Prénom :</h4></label>
                      <input type="text" name="premonM" class="form-control" id="exampleInputFirstName" placeholder="Prémon  ">
                    </div>
                    <label for="ville"><h4>Specialité</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="SpecialiteM" class="form-control">
                      <option value="Dentiste">Dentiste</option>
                      <option value="Churirgie">Churirgie</option>
                      <option value="Ophtamologue">Ophtamologue</option>
                      <option value="Dermatologue">Dermatologue</option>
                      </select>
                    </div>
                    <label for="idagence"><h4>Centre de santé</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="idcente_sante" class="form-control">
                        <?php while($cente_sante=$resultatC->fetch()) {  ?>
                           <option value="<?php echo $cente_sante['ID_Cente_Sante'] ?>">
                            <?php echo $cente_sante['Nom_Cente_Sante'] ?>
                        </option> 
                        <?php } ?>
                      </select>
                    <div class="form-group">
                      <label><h4>Adresse mail :</h4></label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="adresseM" placeholder="Entrez  Email Adresse svp ?">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Enregister</button>
                    </div>
                    <hr>
                  </form>
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