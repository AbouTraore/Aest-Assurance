<?php
session_start();
if (!isset($_SESSION['login'])) {
    // Rediriger vers la page de login si le login n'est pas dans la session
    header('Location:login.php');
    exit();
}

$login = $_SESSION['login'];
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
  <title>Initiliser votre mot de passe</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Réinitialisation du Mot de Passe
                    <?php echo htmlspecialchars($login); ?></h3></h1><hr>
                     </div>
                  <form  method="POST"action="mettre_a_jour_mot_de_passe.php"  class="form">
            
                   <div class="form-group">
                        <input type="hidden" name="login" value="<?php echo $login; ?>">
                   <div class="form-group">   
                  <div class="form-group">
                        <label class="control-label">
                        Veuillez saisir votre nouveau  mot de passe
                       </label>
                        <input type="password"name="password" class="form-control"  
                        ></div><br>
                        <div class="form-group">
                        <label class="control-label">
                        Veuillez resaisir le mot de passe 
                       </label>
                        <input type="password"name="password1" class="form-control "  
                        ></div>
                        <div class="form-group ">
                        <button type="submit" class="btn btn-success ">Réinitialiser</button>

                    </div>

                  </form>
                  <div class="form-group">
                    

                  </div>

                 
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





















