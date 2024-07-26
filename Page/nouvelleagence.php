



<?php 

require_once("identifier.php");


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
  <title>Nouvelle Agence</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Veuillez saisir les données de la nouvelle agence</h3></h1><hr>
                  </div>
                  <form  method="post" action="insertagence.php" class="form">
                    <div class="form-group">
                      <label><h4>Nom :</h4></label>
                      <input type="text" name="nomA" class="form-control" id="exampleInputFirstName" placeholder="Entrez Nom svp ? ">
                    </div>
                    <div class="form-group">
                      <label><h4>Adresse mail :</h4></label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="adresseA" placeholder="Entrez  Email Adresse svp ?">
                    </div>
                    <label for="ville"><h4>Ville</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="villeA" class="form-control">
                      <option value="Abidjan">Abidjan</option>
                        <option value="Oumé">Oumé</option>
                        <option value="Bouaké">Bouaké</option>
                        <option value="Sassandra">Sassandra</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Enregister</button>
                    </div>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Register with Google
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="login.html">Already have an account?</a>
                  </div>
                  <div class="text-center">
                  </div>
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