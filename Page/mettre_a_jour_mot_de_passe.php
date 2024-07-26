<?php
require_once("connexion.php");

// Récupérer le login et le nouveau mot de passe depuis le formulaire POST
$login = isset($_POST['login']) ? $_POST['login'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($login !== '' && $password !== '') {

    // Préparer la requête SQL pour mettre à jour le mot de passe
    $req = "UPDATE utilisateur SET Mdp_Utilisateur = MD5(?) WHERE Login_Utilisateur = ?";
    $params=array($login,$password);
    $resultat=$pdo->prepare($req);

    $resultat->execute($params);


    echo "Mot de passe mis à jour avec succès.";
    header('Location: login.php');

} else {
    echo "Erreur : Veuillez soumettre un login et un mot de passe.";
    header('Location:reinitialisation_mot_de_passe.php');

}
?>
