<?php
require_once("identifier.php");

require_once("connexion.php");
// Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
$idAs = isset($_POST['idA']) ? $_POST['idA'] :0;
$nomAs = isset($_POST['nomA']) ? $_POST['nomA'] : "";
$prenomAs = isset($_POST['prenomA']) ? $_POST['prenomA'] : "";
$emailAs = isset($_POST['emailA']) ? $_POST['emailA'] : "";
$telephoneAs = isset($_POST['telephoneA']) ? $_POST['telephoneA'] : "";
$datenaissanceAs = isset($_POST['datenaissanceA']) ? $_POST['datenaissanceA'] : "";
$sexeAs = isset($_POST['sexeA']) ? $_POST['sexeA'] : "F";
$datesouscriptionAs = isset($_POST['datesouscriptionA']) ? $_POST['datesouscriptionA'] : "";
$fonctionAs = isset($_POST['fonctionA']) ? $_POST['fonctionA'] : "";
$photoAs = isset($_FILES['photoA']['name']) ? $_FILES['photoA']['name'] : "";
$idAg = isset($_POST['idagence']) ? $_POST['idagence'] :1;
$imagetTemp=$_FILES['photoA']['tmp_name'];
move_uploaded_file($imagetTemp,"../img/assurer/".$photoAs);




if(!empty($photoAs)){
    // Requête SQL avec des marqueurs de position pour PDO
     $req = "UPDATE assurerprincipal SET Nom_AssurerPrincipal=?, Prenom_AssurerPrincipal=?, Email_AssurerPrincipal=?,Telephone_AssurerPrincipal=?, DateNaissance_AssurerPrincipal=?, Sexe_AssurerPrincipal=?,DateSouscription_AssurerPrincipal=?,Fonction_AssurerPrincipal=?, Photo_AssurerPrincipal=?,ID_Agence=? WHERE ID_AssurerPrincipal=?";

    // Tableau des paramètres pour la méthode execute
    $params = array($nomAs,$prenomAs,$emailAs, $telephoneAs,$datenaissanceAs,$sexeAs,$datesouscriptionAs,$fonctionAs,$photoAs,$idAg,$idAs);
}else{
    // Requête SQL avec des marqueurs de position pour PDO
    $req = "UPDATE assurerprincipal SET Nom_AssurerPrincipal=?, Prenom_AssurerPrincipal=?, Email_AssurerPrincipal=?,Telephone_AssurerPrincipal=?, DateNaissance_AssurerPrincipal=?, Sexe_AssurerPrincipal=?,DateSouscription_AssurerPrincipal=?,Fonction_AssurerPrincipal=?,ID_Agence=? WHERE ID_AssurerPrincipal=?";
   // Tableau des paramètres pour la méthode execute
   $params = array($nomAs,$prenomAs,$emailAs,$telephoneAs,$datenaissanceAs,$sexeAs,$datesouscriptionAs,$fonctionAs,$idAg,$idAs);

}
// Préparer la requête
$resultatA = $pdo->prepare($req);

// Exécuter la requête avec les paramètres
$resultatA->execute($params);

// Rediriger vers agence.php après la mise à jour
header('Location: assureprincipal.php');


?>