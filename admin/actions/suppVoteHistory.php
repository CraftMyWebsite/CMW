<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) {
    $req = $bddConnection->prepare('UPDATE cmw_votes SET `isOld`=1 WHERE pseudo = :pseudo ');
    $req->execute(array('pseudo' => $_GET['pseudo']));
}