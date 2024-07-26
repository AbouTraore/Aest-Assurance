<?php
   require_once("identifier.php");

   require_once("connexion.php");

   $nomCs=isset($_POST['nomC'])?$_POST['nomC']:"";
   $villeCs=isset($_POST['villeC'])?$_POST['villeC']:"";
   $adresseCs=isset($_POST['adresseC'])?$_POST['adresseC']:"         ";

   $req="insert into cente_sante(Nom_Cente_sante,Addrees_Cente_Sante,Ville_Cente_sante)values (?,?,?)";
   $params=array($nomCs,$adresseCs,$villeCs);
   $resultat=$pdo->prepare($req);
   $resultat->execute($params);

   header('location:Centre_sante.php');

?>