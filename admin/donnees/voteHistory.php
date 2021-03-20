<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { 
	$req = $bddConnection->query('SELECT COUNT(DISTINCT pseudo) AS count FROM cmw_votes');
	$data = $req->fetch(PDO::FETCH_ASSOC);

	$top = $bddConnection->query('SELECT * FROM cmw_votes WHERE isOld=1 group by pseudo ORDER BY nbre_votes DESC');
	$oldHistory = $top->fetchAll(PDO::FETCH_ASSOC);


	$allOld = $bddConnection->query('SELECT SUM(`nbre_votes`) as total FROM cmw_votes WHERE isOld=1');
	$allOld = $allOld->fetch(PDO::FETCH_ASSOC);
	if(isset($allOld['total']))
    {
    	$countallOld = $allOld['total'];
    } else {
    	$countallOld = 0;
    }
	$all = $bddConnection->query('SELECT SUM(`nbre_votes`) as total FROM cmw_votes WHERE isOld=0');
	$all = $all->fetch(PDO::FETCH_ASSOC);
	if(isset($all['total']))
    {
    	$countall = $all['total'];
    } else {
    	$countall = 0;
    }
} ?> 