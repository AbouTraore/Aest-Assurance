<?php 


function rechercher_par_login($login){
    global $pdo;
    $requete=$pdo->prepare("select * from utilisateur where Login_Utilisateur =?");
    $requete->execute(array($login));
    return $requete->rowCount();
}
function rechercher_par_email($email){
    global $pdo;
    $requete=$pdo->prepare("select * from utilisateur where email_Utilisateur =?");
    $requete->execute(array($email));
    return $requete->rowCount();
}

function rechercher_utilisateur_par_email($email){
    global $pdo;

    $requete=$pdo->prepare("select * from utilisateur where email_Utilisateur =?");

    $requete->execute(array($email));

    $user=$requete->fetch();

    if($user)
        return $user;
    else
        return null;
}








?>