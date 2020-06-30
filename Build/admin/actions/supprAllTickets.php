<?php
if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true)) 
{
	$req = $bddConnection->exec('TRUNCATE TABLE cmw_support');
	$req = $bddConnection->exec('TRUNCATE TABLE cmw_support_commentaires');
}
?>