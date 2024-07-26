<?php

require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$nomB= isset($_POST['nomB']) ? $_POST['nomB'] : "";
$prenomB = isset($_POST['prenomB']) ? $_POST['prenomB'] : "";

$datenaissanceB = isset($_POST['datenaissanceB']) ? $_POST['datenaissanceB'] : "";
$sexeB = isset($_POST['sexeB']) ? $_POST['sexeB'] : "F";
$photoB = isset($_FILES['photoB']['name']) ? $_FILES['photoB']['name'] : "";
$idB = isset($_POST['idB']) ? $_POST['idB'] :1;
$imageTemp=$_FILES['photoB']['tmp_name'];
move_uploaded_file($imageTemp,"../img/beneficiaire/".$photoB);
// Requête SQL avec des marqueurs de position pour PDO
$req = "insert into  beneficiaire (Nom_Beneficiaire, Prenom_Beneficiaire, DateNaissance_Beneficiaire,Sexe_Beneficiaire,Photo_Beneficiaire,ID_AssurerPrincipal)values(?,?,?,?,?,?)";
// Tableau des paramètres pour la méthode execute
$params = array($nomB,$prenomB,$datenaissanceB,$sexeB,$photoB,$idB);
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: beneficiaire.php');


?>