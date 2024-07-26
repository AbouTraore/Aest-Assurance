<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once("connexion.php");

    // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à supprimer
    $idAg = isset($_GET['idA']) ? $_GET['idA'] : 0;

    // Requête pour compter le nombre d'assurés dans l'agence
    $reqassurer = "SELECT COUNT(*) AS countassurer FROM assurerprincipal WHERE ID_Agence = ?";
    $resultatassurer = $pdo->prepare($reqassurer);
    $resultatassurer->execute([$idAg]);
    $tabcountassurer = $resultatassurer->fetch();
    $nbrassurer = $tabcountassurer['countassurer'];

    if ($nbrassurer == 0) {
        // Suppression de l'agence si aucun assuré n'est inscrit
        $req = "DELETE FROM agence WHERE ID_Agence = ?";
        $resultatA = $pdo->prepare($req);
        $resultatA->execute([$idAg]);
        // Redirection après suppression
        header('Location: Agence.php');
    } else {
        // Message d'erreur si des assurés sont encore inscrits dans l'agence
        $msg = "Suppression impossible : Vous devez supprimer tous les assurés inscrits dans l'agence";
        header("Location: Alert.php?message=" . urlencode($msg));
        
    }
} else {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location:login.php');
}
exit();
?>
