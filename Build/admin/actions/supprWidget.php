<?php
if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) {
	$lectureWidgets = new Lire('modele/config/configWidgets.yml');
	$lectureWidgets = $lectureWidgets->GetTableau();

	unset($lectureWidgets['Widgets'][$_GET['id']]);

	$ecriture = new Ecrire('modele/config/configWidgets.yml', $lectureWidgets);
}
?>