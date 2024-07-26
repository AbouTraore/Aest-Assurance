<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAs = isset($_POST['idA']) ? $_POST['idA'] :0;
$dateS = isset($_POST['dateS']) ? $_POST['dateS'] : "";
$dateD = isset($_POST['dateD']) ? $_POST['dateD'] : "";
$dateF = isset($_POST['dateF']) ? $_POST['dateF'] : "";
$idM = isset($_POST['idmedecin']) ? $_POST['idmedecin'] :1;
$idC = isset($_POST['idcentre']) ? $_POST['idcentre'] :1;


// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE contrat SET Date_signature_Contrat=?, DateDebut_Contrat=?,DateFin_Contrat=?, medecin_id_medecin =?,ID_Cente_Sante =? WHERE Code_Contrat=?";
// Tableau des paramètres pour la méthode execute
$params = array($dateS,$dateD,$dateF,$idM,$idC,$idAs);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: contrat.php');


?>