<?php
   require_once("identifier.php");

   require_once("connexion.php");

   $nomAg=isset($_POST['nomA'])?$_POST['nomA']:"";
   $villeAg=isset($_POST['villeA'])?$_POST['villeA']:"";
   $adresseAg=isset($_POST['adresseA'])?$_POST['adresseA']:"         ";

   $req="insert into agence(Nom_Agence,Adresse_Agence,Ville_Agence)values (?,?,?)";
   $params=array($nomAg,$adresseAg,$villeAg);
   $resultat=$pdo->prepare($req);
   $resultat->execute($params);

   header('location:agence.php');

?>