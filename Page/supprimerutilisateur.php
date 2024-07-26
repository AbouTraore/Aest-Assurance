<?php
    session_start();
    if(isset($_SESSION['user'])){
        require_once("connexion.php");
        // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
        $idU= isset($_GET['idU']) ? $_GET['idU'] : 0;
        // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
        $req = "DELETE FROM utilisateur  WHERE ID_Utilisateur=?";
        // Tableau des paramètres pour la méthode execute
        $params = array($idU);
        // Préparer la requête
        $resultatA = $pdo->prepare($req);
        // Exécuter la requête avec les paramètres
        $resultatA->execute($params);
        // Rediriger vers agence.php après la mise à jour
        header('Location:utilisateur.php');
        // Requête SQL avec des marqueurs de position pour PDO
   }else{
        header('Location: login.php');

}
?>
