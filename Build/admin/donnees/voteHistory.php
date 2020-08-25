<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { 
	$req = $bddConnection->query('SELECT COUNT(DISTINCT pseudo) AS count FROM cmw_votes');
	$data = $req->fetch(PDO::FETCH_ASSOC);
} ?> 