<?php
if ($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'addOffrePaypal')) {
    $req = $bddConnection->prepare('INSERT INTO cmw_jetons_paypal_offres(nom, description, prix, jetons_donnes) VALUES(:nom, :description, :prix, :jetons_donnes)');
    $req->execute(array(
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'prix' => $_POST['prix'],
        'jetons_donnes' => $_POST['jetons_donnes']));
}
?>