<?php
if (isset($_POST['pseudo']) and isset($_POST['mdp']) and !empty($_POST['pseudo']) and !empty($_POST['mdp'])) {
    $_POST['mdp'] = htmlspecialchars_decode($_POST['mdp']);
    $get_Pseudo = $_POST['pseudo'];

    $bddConnection = $base->getConnection();
    require_once('modele/joueur/connection.class.php');
    $userConnection = new Connection($_POST['pseudo'], $bddConnection);
    $ligneReponse = $userConnection->getReponseConnection();

    $donneesJoueur = $ligneReponse->fetch(PDO::FETCH_ASSOC);
    if (!empty($donneesJoueur)) {
        if (password_verify($_POST['mdp'], $donneesJoueur['mdp'])) {
            require_once('modele/joueur/ScriptBySprik07/reqVerifMailBDD.class.php');
            $req_verifMailBdd = new VerifMailBdd($get_Pseudo, $bddConnection);
            $rep_verifMailBdd = $req_verifMailBdd->getReponseConnection();
            $get_verifMailBdd = $rep_verifMailBdd->fetch(PDO::FETCH_ASSOC);
            $VerifMailBdd = $get_verifMailBdd['ValidationMail'];

            if ($VerifMailBdd == '1') {

                $reconnexion = false;
                if (isset($_POST['reconnexion'])) {
                    $reconnexion = true;
                }
                $globalJoueur->createUser($bddConnection, $donneesJoueur, $reconnexion);
                header('Location: index.php?page=accueil');
            } else {
                header('Location: index.php?page=erreur&erreur=14');
            }
        } else {
            header('Location: index.php?page=erreur&erreur=6');
        }
    } else {
        header('Location: index.php?page=erreur&erreur=5');
    }
} else {
    header('Location: index.php?page=erreur&erreur=4');
}
?>
