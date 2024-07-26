<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idU = isset($_POST['idU']) ? $_POST['idU'] :0;
$login = isset($_POST['login']) ? $_POST['login'] : "";
$email = isset($_POST['emailU']) ? $_POST['emailU'] : "";

// Requête SQL avec des marqueurs de position pour PDO
$req = "UPDATE utilisateur SET Login_Utilisateur=?,email_Utilisateur=? WHERE ID_Utilisateur=?";

// Tableau des paramètres pour la méthode execute
    $params = array($login,$email,$idU);
// Préparer la requête
$resultatA = $pdo->prepare($req);
// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: utilisateur.php');


?>