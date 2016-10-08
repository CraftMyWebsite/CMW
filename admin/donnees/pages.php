<?php
$pagesReq = $bddConnection->query('SELECT * FROM cmw_pages');

unset($pages);
$i = 0;
while($pagesDonnees = $pagesReq->fetch())
{
	$pages[$i]['id'] = $pagesDonnees['id'];
	$pages[$i]['titre'] = $pagesDonnees['titre'];
	$pages[$i]['contenu'] = $pagesDonnees['contenu'];
	$pages[$i]['tableauPages'] = explode('#µ¤#', $pages[$i]['contenu']);
	for($j = 0; $j < count($pages[$i]['tableauPages']); $j++) 
		$pageContenu[$i][$j] = explode('|;|', $pages[$i]['tableauPages'][$j]);
	$i++;
}
?>
