<?php
if(!(!$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addLinkMenu') AND !$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addDropLinkMenu') AND !$_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu'))) {

	require("modele/app/page.class.php");
	$page = new page();
	
	$pages = $page->getPagesName();
	
	array_push($pages, "boutique");
	array_push($pages, "voter");
	array_push($pages, "tokens");
	array_push($pages, "forum");
	array_push($pages, "support");
	array_push($pages, "chat");
	array_push($pages, "membres");
	array_push($pages, "panier");
	array_push($pages, "banlist");


	function isPage($str, $pages) {
		return strpos($str, "=") ? ( in_array(explode("=", $str)[1], $pages)) : null;
	}
	
	require("modele/menu.class.php");
	$menu = new menu($bddConnection);
	$menu = $menu->getMenuGroup();
}
?>