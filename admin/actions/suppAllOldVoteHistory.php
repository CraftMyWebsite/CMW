<?php
if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage'))
{
    $bddConnection->exec('DELETE FROM cmw_votes WHERE isOld=1');
}