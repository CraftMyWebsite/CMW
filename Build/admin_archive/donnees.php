<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'showPage'))
	require_once('donnees/informations.php');
if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'showPage'))
	require_once('donnees/general.php');
if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'showPage'))
	require_once('donnees/accueil.php');
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'showPage'))
	require_once('donnees/regServeur.php');
if(Permission::getInstance()->verifPerm('PermsPanel', 'pages', 'showPage'))
	require_once('donnees/pages.php'); 
if(Permission::getInstance()->verifPerm('PermsPanel', 'news', 'showPage'))
	require_once('donnees/news.php'); 
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'showPage'))
	require_once('donnees/boutique.php'); 
if(Permission::getInstance()->verifPerm('PermsPanel', 'menus', 'showPage'))
	require_once('donnees/menu.php'); 
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'showPage'))
	require_once('donnees/membres.php');
if(Permission::getInstance()->verifPerm("createur"))
	require_once('donnees/grades.php'); 
?>