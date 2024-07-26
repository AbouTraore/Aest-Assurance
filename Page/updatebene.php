<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idB = isset($_POST['idB']) ? $_POST['idB'] :0;
$nomB = isset($_POST['nomB']) ? $_POST['nomB'] : "";
$prenomB = isset($_POST['prenomB']) ? $_POST['prenomB'] : "";
$datenaissanceB = isset($_POST['datenaissanceB']) ? $_POST['datenaissanceB'] : "";
$sexeB = isset($_POST['sexeB']) ? $_POST['sexeB'] : "F";
$photoB = isset($_FILES['photoB']['name']) ? $_FILES['photoB']['name'] : "";
$idAs = isset($_POST['idbene']) ? $_POST['idbene'] :1;
$imagetTemp=$_FILES['photoB']['tmp_name'];
move_uploaded_file($imagetTemp,"../img/beneficiaire/".$photoB);


if(!empty($photoB)){
    // Requête SQL avec des marqueurs de position pour PDO
     $req = "UPDATE beneficiaire SET Nom_Beneficiaire=?, Prenom_Beneficiaire=?, DateNaissance_Beneficiaire=?,Sexe_Beneficiaire=?, Photo_Beneficiaire=?,ID_AssurerPrincipal=? WHERE ID_Beneficiaire=?";

    // Tableau des paramètres pour la méthode execute
    $params = array($nomB,$prenomB,$datenaissanceB,$sexeB,$photoB,$idAs,$idB);
}else{
    // Requête SQL avec des marqueurs de position pour PDO
    $req = "UPDATE beneficiaire SET Nom_Beneficiaire=?, Prenom_Beneficiaire=?, DateNaissance_Beneficiaire=?,Sexe_Beneficiaire=?,ID_AssurerPrincipal=? WHERE ID_Beneficiaire=?";

    // Tableau des paramètres pour la méthode execute
    $params = array($nomB,$prenomB,$datenaissanceB,$sexeB,$idAs,$idB);

}
// Préparer la requête
$resultatB = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatB->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: beneficiaire.php');


?>