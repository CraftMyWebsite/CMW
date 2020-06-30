<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true)
	require_once('donnees/informations.php');
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true)
	require_once('donnees/general.php');
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true)
	require_once('donnees/accueil.php');
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true)
	require_once('donnees/regServeur.php');
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true)
	require_once('donnees/pages.php'); 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true)
	require_once('donnees/news.php'); 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true)
	require_once('donnees/boutique.php'); 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['showPage'] == true)
	require_once('donnees/menu.php'); 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true)
	require_once('donnees/membres.php');
if($_Joueur_['rang'] == 1)
	require_once('donnees/grades.php'); 
?>