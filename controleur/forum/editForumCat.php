<?php
require('modele/forum/forum.class.php');
$_Forum_ = new Forum($bddConnection);
$fofo = $_Forum_->affichageForum();
if (((Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $fofo[$_POST['index']]['perms'] or Permission::getInstance()->verifPerm("createur")) and !$_SESSION['mode']) or $fofo[$_POST['index']]['perms'] == 0) {

    $nom = htmlspecialchars($_POST['nom']);

    $insert = $bddConnection->prepare('UPDATE cmw_forum SET nom=:nom WHERE id=:id');
    $insert->execute(array(
        'nom' => $nom,
        'id' => $_POST['id']
    ));
}
?>