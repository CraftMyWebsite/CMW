<?php
$news = $bddConnection->query('SELECT * FROM cmw_news');

$i = 0;
while($donneesNews = $news->fetch())
{
	$tableauNews[$i]['id'] = $donneesNews['id'];
	$tableauNews[$i]['titre'] = $donneesNews['titre'];
	$tableauNews[$i]['message'] = $donneesNews['message'];
	$tableauNews[$i]['auteur'] = $donneesNews['auteur'];
	$tableauNews[$i]['date'] = $donneesNews['date'];
	$tableauNews[$i]['image'] = $donneesNews['image'];
	$i++;
}
?>

<!-- Stats des News -->

<?php
$req_newsStats = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id');

$i = 0;
while($newsStatsDonnees = $req_newsStats->fetch())
{
	$newsStats[$i]['id'] = $newsStatsDonnees['id'];
	$newsStats[$i]['titre'] = $newsStatsDonnees['titre'];
	$newsStats[$i]['message'] = $newsStatsDonnees['message'];
	$newsStats[$i]['auteur'] = $newsStatsDonnees['auteur'];
	$newsStats[$i]['date'] = $newsStatsDonnees['date'];
	$newsStats[$i]['image'] = $newsStatsDonnees['image'];
	$i++;
}
?>