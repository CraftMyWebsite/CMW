<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) {
	$lectureVotes = new Lire('modele/config/configVotes.yml');
	$lectureVotes = $lectureVotes->GetTableau();

	unset($lectureVotes['liens'][$_GET['id']]);

	$ecriture = new Ecrire('modele/config/configVotes.yml', $lectureVotes);
}
?>