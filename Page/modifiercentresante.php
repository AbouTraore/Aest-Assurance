<?php 
require_once("identifier.php");

require_once("connexion.php");

$idCs=isset($_GET['idC'])?$_GET['idC']:0;
$req="SELECT * FROM cente_sante where ID_Cente_Sante=$idCs";
$resultat=$pdo->query($req);
$centre_sante=$resultat->fetch();
$nomCs=$centre_sante['Nom_Cente_Sante'];
$villeCs=$centre_sante ['Ville_Cente_Sante']; 
$adresseCs=$centre_sante['Addrees_Cente_Sante']; 



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
  <title>Modification de centre de sante</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Modification d'un centre de sante </h3></h1><hr>
                  </div>
                  <form  method="POST" action="updatecentresante.php" class="form">
                    <div class="form-group">
                        <label><h4>ID de l'agence : <?php echo $idCs ?></h4></label>
                        <input type="hidden"name="idC" class="form-control" id="exampleInputFirstName" value="<?php echo $idCs ?>">
                        </div>  
                    <div class="form-group">
                      <label><h4>Nom :</h4></label>
                      <input type="text" name="nomC" class="form-control" id="exampleInputFirstName" placeholder="Entrez Nom svp ? "value="<?php echo $nomCs ?>">
                    </div>
                    <div class="form-group">
                      <label><h4>Adresse mail :</h4></label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="adresseC" placeholder="Entrez  Email Adresse svp ?"value="<?php echo $adresseCs ?>">
                    </div>
                    <label for="ville"><h4>Ville</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="villeC" class="form-control">
                        <option value="Abidjan"<?php if($villeCs=="Abidjan") echo "selected"?>>Abidjan</option>
                        <option value="Oumé"<?php if($villeCs=="Oumé") echo "selected"?>>Oumé</option>
                        <option value="Bouaké"<?php if($villeCs==="Bouaké") echo "selected"?>>Bouaké</option>
                        <option value="Sassandra"<?php if($villeCs=="Sassandra") echo "selected"?>>Sassandra</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                    </div>
                    <hr>
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