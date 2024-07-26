<?php

require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAg = isset($_POST['idA']) ? $_POST['idA'] : 0;
$nomAg = isset($_POST['nomA']) ? $_POST['nomA'] : "";
$villeAg = isset($_POST['villeA']) ? $_POST['villeA'] : "";
$adresseAg = isset($_POST['adresseA']) ? $_POST['adresseA'] : "";

// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE agence SET Nom_Agence=?, Adresse_Agence=?, Ville_Agence=? WHERE ID_Agence=?";

// Tableau des paramètres pour la méthode execute
$params = array($nomAg, $adresseAg, $villeAg, $idAg);

// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: agence.php');


?>