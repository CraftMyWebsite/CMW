<?php

$lectureVotes = new Lire('modele/config/configVotes.yml');
$lectureVotes = $lectureVotes->GetTableau();

unset($lectureVotes['liens'][$_GET['id']]);

$ecriture = new Ecrire('modele/config/configVotes.yml', $lectureVotes);

?>
