<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['actions']['editWidgets'] == true) {
	$lectureWidgets = new Lire('modele/config/configWidgets.yml');
	$lectureWidgets = $lectureWidgets->GetTableau();

	unset($lectureWidgets['Widgets'][$_GET['id']]);

	$ecriture = new Ecrire('modele/config/configWidgets.yml', $lectureWidgets);
}
?>