<?php  


require_once("identifier.php");

require_once("connexion.php");

$idU=isset($_GET['idU'])?$_GET['idU']:0;
$requtilisateur="SELECT * FROM utilisateur where ID_Utilisateur=$idU";
$resultatutilisateur=$pdo->query($requtilisateur);
$utilisateur=$resultatutilisateur->fetch();
$login=$utilisateur["Login_Utilisateur"];
$Role=strtoupper( $utilisateur["Role_Utilisateur"]); 
$email= $utilisateur["email_Utilisateur"]; 



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
  <title>Modification d'un Utilisateur</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Modifier un Utilisateur</h3></h1><hr>
                  </div>
                  <form  method="POST" action="updateuser.php" class="form">
                    <div class="form-group">
                        <label><h5>ID de l'Utilisateur : <?php echo $idU ?></h5></label>
                        <input type="hidden"name="idU" class="form-control" id="exampleInputFirstName" value="<?php echo $idU ?>">
                        </div>  
                    <div class="form-group">
                      <label><h5>Login :</h5></label>
                      <input type="text" name="login" class="form-control" id="exampleInputFirstName" placeholder=" Login  "value="<?php echo $login ?>">
                    </div>
                    <div class="form-group">
                      <label><h5> Email :</h5></label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="emailU" placeholder="Email"value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                    </div>
                   
                    <a href="modifierMdp.php?idU=<?php echo $idU ?>">Changer le mot de passe</a>
                    
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