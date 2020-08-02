<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'widgets', 'showPage')) {
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