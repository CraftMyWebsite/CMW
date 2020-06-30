<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true) {
	$pagesReq = $bddConnection->query('SELECT * FROM cmw_pages');

	unset($pages);
	$i = 0;
	while($pagesDonnees = $pagesReq->fetch(PDO::FETCH_ASSOC))
	{
		$pages[$i]['id'] = $pagesDonnees['id'];
		$pages[$i]['titre'] = $pagesDonnees['titre'];
		$pages[$i]['contenu'] = $pagesDonnees['contenu'];
		$pages[$i]['tableauPages'] = explode('#µ¤#', $pages[$i]['contenu']);
		for($j = 0; $j < count($pages[$i]['tableauPages']); $j++) 
			$pageContenu[$i][$j] = explode('|;|', $pages[$i]['tableauPages'][$j]);
		$i++;
	}
}
?>