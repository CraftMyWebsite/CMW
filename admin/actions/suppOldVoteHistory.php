<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) {
    $req = $bddConnection->prepare('DELETE FROM cmw_votes WHERE pseudo = :pseudo and isOld=1');
    $req->execute(array('pseudo' => $_GET['pseudo']));
}