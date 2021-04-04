<?php 
require('modele/joueur/donneesJoueur.class.php');

$reseau = array();

$req = $bddConnection->query("DESCRIBE cmw_reseaux");
$req = $req->fetchAll(PDO::FETCH_ASSOC);

$changementsReseaux = array();

foreach($req as $value) {
    if($value['Field'] != "id" && $value['Field'] != "idJoueur") {
        if(!empty($_POST[$value['Field']]))
        {
            $temp = htmlspecialchars($_POST[$value['Field']]);
            $changementsReseaux += [ $value['Field'] => $temp ];
        }
    }
}


require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
if(!empty($changementsReseaux))
{
    $maj->setNouvellesDonneesReseaux($changementsReseaux, $_Joueur_['id']);
}
header('Location: profil/' . $_Joueur_['pseudo'] . '/12');
?>