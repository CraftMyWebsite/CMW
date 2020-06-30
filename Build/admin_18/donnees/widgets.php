<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['showPage'] == true) {
	$lectureWidgets = new Lire('modele/config/configWidgets.yml');
	$lectureWidgets = $lectureWidgets->GetTableau();

	$widgets = $lectureWidgets['Widgets'];
	$widgetsAssos = array(
		0 => 'Compte Gestion',
		1 => 'Serveurs',
		2 => 'Joueurs',
		3 => 'Champ Texte' );
}
?>