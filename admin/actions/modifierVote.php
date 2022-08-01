<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) {
    $req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config');
    $data = $req_donnees->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($data); $i++) {

        $action = $_POST['action' . $i];
        $serveur = htmlspecialchars($_POST['serveur' . $i]);
        $lien = htmlspecialchars($_POST['lien' . $i]);
        $titre = htmlspecialchars($_POST['titre' . $i]);
        $temps = htmlspecialchars($_POST['temps' . $i]);
        $idCustom = $_POST['idCustom' . $i];
        $enligne = isset($_POST['enligne' . $i]) && !empty($_POST['enligne' . $i]) ? 1 : 0;

        $update = $bddConnection->prepare('UPDATE cmw_votes_config SET action = :action, serveur = :serveur, lien = :lien, temps = :temps, titre = :titre, idCustom = :idCustom, enligne = :enligne WHERE id = :id');
        $update->execute(array(
            'action' => $action,
            'serveur' => $serveur,
            'lien' => $lien,
            'temps' => $temps,
            'titre' => $titre,
            'idCustom' => $idCustom,
            'enligne' => $enligne,
            'id' => $data[$i]['id']
        ));
    }
}

