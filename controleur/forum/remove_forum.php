<?php
if (Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') and isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $remove = $bddConnection->prepare('DELETE FROM cmw_forum WHERE id = :id');
    $remove->execute(array(
        'id' => $id
    ));
    header('Location: index.php?page=forum');
} elseif (!isset($_Joueur_)) {
    header('Location: index.php?page=erreur&erreur=16');
} elseif ($_Joueur_ != 1) {
    header('Location: index.php?page=erreur&erreur=7');
} else {
    header('Location: index.php?page=erreur&erreur=0');
}