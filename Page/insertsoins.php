<?php

require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$Nature = isset($_POST['Nature']) ? $_POST['Nature'] : "";
$montant = isset($_POST['montant']) ? $_POST['montant'] : "";
$Analyse = isset($_POST['Analyse']) ? $_POST['Analyse'] : "";
$datesoins = isset($_POST['dateS']) ? $_POST['dateS'] : "";
$idM = isset($_POST['idmedecin']) ? $_POST['idmedecin'] :1;
// Requête SQL avec des marqueurs de position pour PDO
$req = "INSERT INTO  soins(Nature_Soins,Date_Soins,Montant_Soins,Analyse_Soins,ID_Medecin)VALUES(?,?,?,?,?)";
// Tableau des paramètres pour la méthode execute
$params = array($Nature,$datesoins,$montant,$Analyse,$idM);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: soins.php');


?>