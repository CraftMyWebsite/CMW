<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { 
	$req = $bddConnection->query('SELECT COUNT(DISTINCT pseudo) AS count FROM cmw_votes');
	$data = $req->fetch(PDO::FETCH_ASSOC);

	$top = $bddConnection->query('SELECT * FROM cmw_votes WHERE isOld=1 group by pseudo ORDER BY nbre_votes DESC');
	$oldHistory = $top->fetchAll(PDO::FETCH_ASSOC);
} ?> 