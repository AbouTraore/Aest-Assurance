<?php
session_start();
if(isset($_SESSION['user'])){
    require_once("connexion.php");
    // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
    $idB = isset($_GET['idB']) ? $_GET['idB'] : 0;
    // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
    $req = "DELETE FROM beneficiaire  WHERE ID_Beneficiaire=?";
    // Tableau des paramètres pour la méthode execute
    $params = array($idB);
    // Préparer la requête
    $resultatB = $pdo->prepare($req);
    // Exécuter la requête avec les paramètres
    $resultatB->execute($params);
    // Rediriger vers agence.php après la mise à jour
    header('Location:beneficiaire.php');
    // Requête SQL avec des marqueurs de position pour PDO
        
}else{
    header('Location: login.php');

}
 

?>
