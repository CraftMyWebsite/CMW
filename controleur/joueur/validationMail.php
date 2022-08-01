<?php
if (urldecode($_GET['pseudo']) and urldecode($_GET['cle'])) {
    $get_Pseudo = urldecode($_GET['pseudo']);
    $get_CleUnique = urldecode($_GET['cle']);

    $bddConnection = $base->getConnection();
    require_once('modele/joueur/ScriptBySprik07/reqVerifActivateMail.class.php');
    $req_verifActivateMail = new VerifActivateMail($get_Pseudo, $bddConnection);
    $rep_verifActivateMail = $req_verifActivateMail->getReponseConnection();
    $get_verifActivateMail = $rep_verifActivateMail->fetch(PDO::FETCH_ASSOC);
    $get_CleBdd = $get_verifActivateMail['CleUnique'];
    $get_Actif = $get_verifActivateMail['ValidationMail'];

    if ($get_Actif == '1') {
        header('Location: index.php?page=erreur&erreur=13');
    } else {
        if ($get_CleUnique == $get_CleBdd) {
            require_once('modele/joueur/ScriptBySprik07/inscriptionValidateMail.class.php');
            $validateMail = new UserValidateMail($get_Pseudo, $bddConnection);
            header('Location: index.php?page=accueil&ActivateSuccess');
        } else {
            header('Location: index.php?page=accueil&ActivateImpossible');
        }
    }
} else {
    header('Location: index.php?page=erreur&erreur=12');
}
?>