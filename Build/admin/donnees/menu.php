<?php
if(!(!$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addLinkMenu') AND !$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addDropLinkMenu') AND !$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu'))) {
	$pagesReq = $bddConnection->query('SELECT titre FROM cmw_pages');

	$i = 0;
	while($pagesDonnees = $pagesReq->fetch(PDO::FETCH_ASSOC))
	{
		$pages[$i] = $pagesDonnees['titre'];
		$i++;
	}
	if(empty($pages)) $pages[0] = '- Aucune Page -';


	$lectureMenu = new Lire('modele/config/configMenu.yml');
	$lectureMenu = $lectureMenu->GetTableau();

	for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
	{
		$lectureMenuA['MenuTexte'][$i] = str_replace('[glyph]', '<span style="display: none;" class="glyphicon glyphicon-', $lectureMenu['MenuTexte'][$i]);
		$lectureMenuA['MenuTexte'][$i] = str_replace('[/glyph]', '"></span> ', $lectureMenuA['MenuTexte'][$i]);
	}

	function isPage($str, $pages) {
		return strpos($str, "=") ? ( in_array(explode("=", $str)[1], $pages)) : null;
	}
}
?>