<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true) { 
	$news = $bddConnection->query('SELECT * FROM cmw_news');

	$i = 0;
	while($donneesNews = $news->fetch(PDO::FETCH_ASSOC))
	{
		$tableauNews[$i]= $donneesNews;
		$i++;
	}
	$req_newsStats = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id');

	$i = 0;
	while($newsStatsDonnees = $req_newsStats->fetch(PDO::FETCH_ASSOC))
	{
		$newsStats[$i]= $newsStatsDonnees;
		$i++;
	}
}
?>