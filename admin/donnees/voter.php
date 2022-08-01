<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) {

    $req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config');
}
?>
