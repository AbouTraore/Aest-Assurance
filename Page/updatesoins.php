<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAs = isset($_POST['idA']) ? $_POST['idA'] :0;
$nature = isset($_POST['nature']) ? $_POST['nature'] : "";
$analyse = isset($_POST['analyse']) ? $_POST['analyse'] : "";
$montant = isset($_POST['montant']) ? $_POST['montant'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";
$idAg = isset($_POST['idmedecin']) ? $_POST['idmedecin'] :1;

// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE soins SET Nature_Soins=?, Date_Soins=?,Montant_Soins=?,Analyse_Soins=?, ID_Medecin=? WHERE ID_Soins=?";
// Tableau des paramètres pour la méthode execute
$params = array($nature,$date,$montant,$analyse,$idAg,$idAs);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: soins.php');


?>