<?php
if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets') || $_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) {

	require("modele/widgets.class.php");
	$widgets = new widgets($bddConnection);
	$widgets = $widgets->getWidgets();

}
?>