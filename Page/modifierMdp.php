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
  <title>Changement de mot de passe </title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <script src="../js1/jquery-3.3.1.js"></script>
  <script src="../js1/monjs.js"></script>
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <hr>
                  <div class="text-center modifierpwd-page">
                    <h1 >Changement de mot de passe</h1>
                    <h2 >Compte :  <?php echo $_SESSION['user']['Login_Utilisateur']?></h2>
                  </div><br>
                  <hr>
                  <form  method="POST" action="updateMdp.php" class="form">
                    <div class="form-group">
                    <div class="form-group">
                    <label><h5>Ancien Mot de passe :</h5></label>
                      <input type="password" class="form-control oldpwd" name="oldpwd" placeholder="Taper l'ancien Mot de passe "required="required">
                      <i class="fa fa-eye fa-2x show-old-pwd clickable"></i>
                    </div><br>
                    <div class="form-group">
                    <label><h5>Nouveau Mot de passe:</h5></label>
                      <input type="password" autocomplete="false" class="form-control newpwd" name="newpwd" placeholder="Taper votre nouveau Mot de passe " required="required"
                      >
                      <i class="fa fa-eye fa-2x show-old-pwd clickable"></i>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Enregristrer</button>
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
  <!-- Login Content -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>