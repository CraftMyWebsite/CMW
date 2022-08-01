<?php if ($_Permission_->verifPerm('PermsPanel', 'forum', 'showPage')) {
    $reqPrefix = $bddConnection->query('SELECT id, span, nom FROM cmw_forum_prefix ORDER BY id ASC');
}
?>