<?php
if ($_Permission_->verifPerm('PermsPanel', 'reseaux', 'showPage')) {
    $nom = htmlspecialchars($_GET['nom']);
    $req = $bddConnection->prepare('ALTER TABLE cmw_reseaux DROP :nom');
    $req->execute(array('nom' => $nom));
}
?>