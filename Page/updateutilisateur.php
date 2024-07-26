<?php
// Inclut le fichier 'identifier.php' qui vérifie probablement si l'utilisateur est authentifié
require_once("identifier.php");

// Inclut le fichier 'connexion.php' qui établit la connexion à la base de données
require_once("connexion.php");

// Récupère l'identifiant de l'utilisateur à mettre à jour à partir des données POST, ou assigne 0 par défaut
$idU = isset($_POST['idU']) ? $_POST['idU'] : 0;

// Récupère le login de l'utilisateur à partir des données POST, ou assigne une chaîne vide par défaut
$login = isset($_POST['login']) ? $_POST['login'] : "";

// Récupère le rôle de l'utilisateur à partir des données POST, ou assigne une chaîne vide par défaut
$Role = isset($_POST['RoleU']) ? $_POST['RoleU'] : "";

// Récupère l'email de l'utilisateur à partir des données POST, ou assigne une chaîne vide par défaut
$email = isset($_POST['emailU']) ? $_POST['emailU'] : "";

// Requête SQL pour mettre à jour les informations de l'utilisateur avec des marqueurs de position pour PDO
$req = "UPDATE utilisateur SET Login_Utilisateur=?, email_Utilisateur=?, Role_Utilisateur=? WHERE ID_Utilisateur=?";

// Tableau des paramètres pour la méthode execute, correspondant aux marqueurs de position de la requête SQL
$params = array($login, $email, $Role, $idU);

// Prépare la requête SQL avec PDO pour éviter les injections SQL
$resultatA = $pdo->prepare($req);

// Exécute la requête préparée avec les paramètres fournis
$resultatA->execute($params);

// Redirige l'utilisateur vers 'utilisateur.php' après la mise à jour des informations
header('Location: utilisateur.php');
?>
