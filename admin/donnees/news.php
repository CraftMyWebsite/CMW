<?php
if(!(!$_Permission_->verifPerm('PermsPanel', 'news', 'actions', 'addNews') AND !$_Permission_->verifPerm('PermsPane', 'news', 'actions', 'editNews'))) { 
	$news = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id');

	$i = 0;
	while($donneesNews = $news->fetch(PDO::FETCH_ASSOC))
	{
		$tableauNews[$i]= $donneesNews;
		$i++;
	}
	
}
?>