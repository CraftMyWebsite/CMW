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


	function isPage($str, $pages) {
		return strpos($str, "=") ? ( in_array(explode("=", $str)[1], $pages)) : null;
	}
	
	require("modele/menu.class.php");
	$menu = new menu($bddConnection);
	$menu = $menu->getMenuGroup();
}
?>