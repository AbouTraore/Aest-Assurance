<?php 
session_start();
if(isset($_SESSION['erreurLogin']))
  $erreurLogin = $_SESSION['erreurLogin'];
else{
      $erreurLogin = "";
    }
session_destroy();
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
  <title>Se connecter</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

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
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Se connecter  </h1>
                  </div>
                  <hr>
                  <form  method="POST" action="seconnecter.php" class="form">
                    <?php if(!empty($erreurLogin)) {?>
                      <div class="alert alert-danger  text-center">
                        <?php  echo $erreurLogin ?>
                      </div>
                    <?php }?>

                    <div class="form-group">
                    <label><h5>Login :</h5></label>
                      <input type="text" class="form-control"name="login" aria-describedby="emailHelp"
                        placeholder="Login ou email " autocomplete="false">
                    </div>
                    <div class="form-group">
                    <label><h5>Mot de passe :</h5></label>
                      <input type="password" class="form-control" name="pwd"autocomplete="false"placeholder="Mot de passe  ">
                    </div><br>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i>&nbsp;  Se connecter</button>
                    </div>
                  </form><br>
                  <hr>
                  <a href="nouveautilisateur.php" class="btn btn-primary btn-block">
                  <i class="fa fa-user-plus" aria-hidden="true"></i>
                  créer un compte
                    </a>
                  <a href="oubliermdp.php" class="btn btn-danger btn-block">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                      recuperation de mot de passe pas mail
                  </a>
                  <hr>
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
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>