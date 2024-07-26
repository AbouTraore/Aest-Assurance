<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAg = isset($_POST['idA']) ? $_POST['idA'] : 0;
$nomAg = isset($_POST['nomA']) ? $_POST['nomA'] : "";
$prenomAg = isset($_POST['prenomA']) ? $_POST['prenomA'] : "";
$villeAg = isset($_POST['villeA']) ? $_POST['villeA'] : "";
$adresseAg = isset($_POST['adresseA']) ? $_POST['adresseA'] : "";
$idS = isset($_POST['idS']) ? $_POST['idS'] :1;


// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE medecin SET Nom_Medecin=?, Prenom_Medecin=?, Specialite_Medecin=?,Adresse_Medecin=?,ID_Cente_Sante=? WHERE ID_Medecin=?";

// Tableau des paramètres pour la méthode execute
$params = array($nomAg,$prenomAg,$villeAg,$adresseAg,$idAg,$idS);

// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: medecin.php');


?>