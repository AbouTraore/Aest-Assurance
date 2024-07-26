<?php
if(isset($_SESSION['user'])){
        require_once("connexion.php");
        // Supposons que $_GET['idA'] est utilisé pour identifier l'enregistrement à mettre à jour
        $idAg = isset($_GET['idA']) ? $_GET['idA'] : 0;
        
        $reqassurer="SELECT count(*) countassurer FROM assurerprincipal where ID_Medecin =$idAg";
        $resultatassurer = $pdo->prepare($reqassurer);
        $tabcountassurer=$resultatassurer->fetch();
        $nbrassurer=$tabcountassurer['countassurer'];
        
        if($nbrassurer==0){
            $req = "DELETE FROM medecin  WHERE ID_Medecin=?";
            // Tableau des paramètres pour la méthode execute
            $params = array($idAg);
            // Préparer la requête
            $resultatA = $pdo->prepare($req);
            // Exécuter la requête avec les paramètres
            $resultatA->execute($params);
            // Rediriger vers agence.php après la mise à jour
            header('Location:medecin.php');
        }else{
            $msg="Suppression impossible:Vous devez supprimer tous assurer inscrit dans l'agence";
            // Rediriger vers agence.php après la mise à jour
            header("Location:alert.php?message=$msg");
        }
}else{
header('Location: login.php');

}



// Requête SQL avec des marqueurs de position pour PDO





?>
