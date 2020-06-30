<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true) 
{
	$ecritureTheme['Pied']['facebook'] = htmlspecialchars($_POST['facebook']);
	$ecritureTheme['Pied']['twitter'] = htmlspecialchars($_POST['twitter']);
	$ecritureTheme['Pied']['youtube'] = htmlspecialchars($_POST['youtube']);
	$ecritureTheme['Pied']['discord'] = htmlspecialchars($_POST['discord']);
	$ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);
}
?>