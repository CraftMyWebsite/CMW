<?php
$req_report = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0 AND new = 0');
$signalement = $req_report->rowCount();
$update = $bddConnection->exec('UPDATE cmw_forum_report SET new = 1 WHERE vu = 0');
echo $signalement;
?>