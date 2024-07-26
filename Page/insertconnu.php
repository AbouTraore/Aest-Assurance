<?php

require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$dateC = isset($_POST['dateC']) ? $_POST['dateC'] : "";
$montant = isset($_POST['montant']) ? $_POST['montant'] : "";
$idM = isset($_POST['idmedecin']) ? $_POST['idmedecin'] :1;
$idB = isset($_POST['idbene']) ? $_POST['idbene'] :1;

// Requête SQL avec des marqueurs de position pour PDO
$req = "INSERT INTO  consultation(Date_Consultation,frai_Consultation,ID_Medecin,ID_Beneficiaire)VALUES(?,?,?,?)";
// Tableau des paramètres pour la méthode execute
$params = array($dateC,$montant,$idM,$idB);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: consultation.php');


?>