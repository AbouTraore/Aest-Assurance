<?php
session_start();
require_once("connexion.php");

// Récupérer le login à vérifier depuis le formulaire POST
$login = isset($_POST['login']) ? $_POST['login'] : '';

if ($login !== '') {
    // Préparer la requête SQL pour vérifier l'existence du login
    $req = "SELECT COUNT(*) FROM utilisateur WHERE Login_Utilisateur = ?";
    $stmt = $pdo->prepare($req);
    $stmt->execute([$login]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Le login existe, le garder dans une session et rediriger vers le formulaire de réinitialisation
        $_SESSION['login'] = $login;
        header('Location: reinitialisation_mot_de_passe.php');
        exit();
    } else {
        // Le login n'existe pas, afficher un message d'erreur
        $msg1="Login non trouvé.";
    }
} else {
    // Le login n'a pas été soumis, afficher un message d'erreur
    $msg="Veuillez entrer un login.";
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Vérification du Login

                       </h3></h1><hr>
                      
                  </div>
                  <form  method="POST"  class="form">
                  <?php if(!empty($msg1)) {?>
                      <div class="alert alert-danger  text-center">
                        <?php  echo $msg1 ?>
                      </div>
                    <?php }?>

                        <div class="form-group">
                        <label class="control-label">
                        Veuillez saisir votre email de récuperation
                       </label>
                        <input type="login"name="login" class="form-control"  
                        ><br>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Vérification</button>

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