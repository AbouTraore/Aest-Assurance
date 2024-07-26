<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAs = isset($_POST['idA']) ? $_POST['idA'] :0;
$montant = isset($_POST['montant']) ? $_POST['montant'] : "";
$date = isset($_POST['date']) ? $_POST['date'] : "";
$idAg = isset($_POST['idmedecin']) ? $_POST['idmedecin'] :1;
$idB = isset($_POST['idbene']) ? $_POST['idbene'] :1;


// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE consultation SET frai_Consultation=?, Date_Consultation=?,ID_Beneficiaire=?, ID_Medecin=? WHERE ID_Consultation=?";
// Tableau des paramètres pour la méthode execute
$params = array($montant,$date,$idB,$idAg,$idAs);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: consultation.php');


?>