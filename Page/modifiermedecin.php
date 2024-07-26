<?php  

require_once("identifier.php");

require_once("connexion.php");

$idAg=isset($_GET['idA'])?$_GET['idA']:0;
$req="SELECT * FROM medecin where ID_Medecin=$idAg";
$resultat=$pdo->query($req);
$agence=$resultat->fetch();
$nomAg=$agence['Nom_Medecin'];
$prenomAg=$agence ['Prenom_Medecin']; 
$villeAg=$agence ['Specialite_Medecin']; 
$adresseAg=$agence['Adresse_Medecin']; 



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
  <title>Modification des Médecins</title>
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
                    <h1 class="h4 text-gray-900 mb-4"><hr><h3>Modification des Médecin</h3></h1><hr>
                  </div>
                  <form  method="POST" action="updatemedecin.php" class="form">
                    <div class="form-group">
                        <label><h4>ID du medecin : <?php echo $idAg ?></h4></label>
                        <input type="hidden"name="idA" class="form-control" id="exampleInputFirstName" value="<?php echo $idAg ?>">
                        </div>  
                    <div class="form-group">
                      <label><h4>Nom :</h4></label>
                      <input type="text" name="nomA" class="form-control" id="exampleInputFirstName" placeholder="Entrez Nom svp ? "value="<?php echo $nomAg ?>">
                    </div>
                    <div class="form-group">
                      <label><h4>Prénom :</h4></label>
                      <input type="text" name="prenomA" class="form-control" id="exampleInputFirstName" placeholder="Entrez Nom svp ? "value="<?php echo $prenomAg ?>">
                    </div>
                    <label for="ville"><h4>Specialité</h4></label> :
                    <div class="form-group" id="Villeagence">
                      <select name="villeA" class="form-control">
                        <option value="Dentiste"<?php if($villeAg=="Dentiste") echo "selected"?>>Dentiste</option>
                        <option value="Churirgie"<?php if($villeAg=="Churirgie") echo "selected"?>>Churirgie</option>
                        <option value="Ophtamologue"<?php if($villeAg=="Ophtamologue") echo "selected"?>>Ophtamologue</option>
                        <option value="Dermatologue"<?php if($villeAg=="Dermatologue") echo "selected"?>>Dermatologue</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label><h4>Adresse mail :</h4></label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="adresseA" placeholder="Entrez  Email Adresse svp ?"value="<?php echo $adresseAg ?>">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                    </div>
                    <hr>
                  </form>
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