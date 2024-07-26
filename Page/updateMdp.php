<?php 

require_once('identifier.php');
require_once("connexion.php");



$iduser=$_SESSION['user']['ID_Utilisateur'];


$oldpwd=isset($_POST['oldpwd'])?$_POST['oldpwd']:"";

$newpwd=isset($_POST['newpwd'])?$_POST['newpwd']:"";


$requete="SELECT * FROM utilisateur where ID_Utilisateur=$iduser and Mdp_Utilisateur=MD5('$oldpwd')";
$resultat=$pdo->prepare($requete);

$resultat->execute();

$msg="";
$interval=3;
$url="login.php";



if($resultat->fetch()){
    $requete="UPDATE utilisateur set Mdp_Utilisateur=MD5(?) where ID_Utilisateur=?";
    $params=array($newpwd,$iduser);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    $msg="<div class='alert alert-success'>
               <strong>Félicitation</strong> Votre  mot de passe est modifié avec succés 
            </div>";
        
    

}else{         
    $msg="<div class='alert alert-danger'>
    <strong>Erreur</strong> L'ancien mot de passe est incorrect !!!
    </div>";
    $url=$_SERVER['HTTP_REFERER'];
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
  <title>changement de mot de passe </title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
    <div class="container"><br><br><br>
     <?php   
        echo $msg;
        header("refresh:$interval;url=$url");
    ?>
    </div>
 
</body>

</html>





?>