<?php
if($_Joueur_['rang'] == 1) {
	$lectureStats = new Lire('modele/config/config.yml');
	$lectureStats = $lectureStats->GetTableau();
}
?>