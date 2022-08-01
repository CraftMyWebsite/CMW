<?php
if ($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'deleteAllTicket')) {
    $req = $bddConnection->exec('TRUNCATE TABLE cmw_support');
    $req = $bddConnection->exec('TRUNCATE TABLE cmw_support_commentaires');
}
?>