<?php  

session_start();
require_once("connexion.php");

$login=isset($_POST['login'])?$_POST['login']:"";
$pwd=isset($_POST['pwd'])?$_POST['pwd']:"";

$req="SELECT ID_Utilisateur,Login_Utilisateur,Role_Utilisateur,email_Utilisateur,Etat_Utilisateur FROM utilisateur where Login_Utilisateur='$login'or email_Utilisateur='$login' and Mdp_Utilisateur=MD5('$pwd')";
$resultat=$pdo->query($req);

if($utilisateur=$resultat->fetch()){
    if($utilisateur['Etat_Utilisateur']==1){
        $_SESSION['user']=$utilisateur;
        header('location:../index.php');
    }else{
        $_SESSION['erreurLogin']="<strong>Erreur !!</strong> Votre compte est désactivé .<br>Veuillez contacter l'administrateur ";
        header('location:login.php');
    }
}else{
    $_SESSION['erreurLogin']="<strong>Erreur !!</strong> Login ou mot de passe incorrecte !!!";
    header('location:login.php');
}

?>