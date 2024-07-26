<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idC'] est utilisé pour identifier l'enregistrement à mettre à jour
$idCs = isset($_POST['idC']) ? $_POST['idC'] : 0;
$nomCs = isset($_POST['nomC']) ? $_POST['nomC'] : "";
$villeCs = isset($_POST['villeC']) ? $_POST['villeC'] : "";
$adresseCs = isset($_POST['adresseC']) ? $_POST['adresseC'] : "";

// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE cente_sante SET Nom_Cente_Sante=?,Addrees_Cente_Sante=?,Ville_Cente_Sante=? WHERE ID_Cente_Sante=?";

// Tableau des paramètres pour la méthode execute
$params = array($nomCs, $adresseCs, $villeCs, $idCs);

// Préparer la requête
$resultatC= $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatC->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: Centre_sante.php');


?>