<?php

   require_once("identifier.php");

   require_once("connexion.php");

   $nomMe=isset($_POST['nomM'])?$_POST['nomM']:"";
   $prenomMe=isset($_POST['premonM'])?$_POST['premonM']:"";
   $specialiteMe=isset($_POST['SpecialiteM'])?$_POST['SpecialiteM']:"";
   $adresseMe=isset($_POST['adresseM'])?$_POST['adresseM']:"";
   $idS=isset($_POST['idS']) ? $_POST['idS'] :1;

   

   $req="insert into medecin(Nom_Medecin,Prenom_Medecin,Specialite_Medecin,Adresse_Medecin,ID_Cente_Sante)values(?,?,?,?,?)";
   $params=array($nomMe,$prenomMe,$specialiteMe,$adresseMe,$idS);
   $resultat=$pdo->prepare($req);
   $resultat->execute($params);

   header('location:Medecin.php');

?>