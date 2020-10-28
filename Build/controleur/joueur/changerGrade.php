<?php

require_once('modele/joueur/tempgrades.class.php');
$tempGrades = new TempGrades($bddConnection);

$joueurGradesReq = $tempGrades->GetPlayer();

while($joueurGrades = $joueurGradesReq->fetch(PDO::FETCH_ASSOC))
{
	$tempGrades->SetPseudo($joueurGrades['pseudo']);
	$gradeJoueur = $tempGrades->RecupDonnees();
	if($gradeJoueur['grade_temps']< time() AND $gradeJoueur['is_active'] == 1)
	{		
		foreach($jsonCon as $serveur)
		{
			$serveur->ResetPlayer($joueurGrades['pseudo'], $gradeJoueur['grade_vie']);
		}
		$tempGrades->MajJoueurTimeOut();
	}
}

// Pour la vérif des tokens en cas d'achat
$req = $bddConnection->prepare('SELECT tokens FROM cmw_users WHERE pseudo = :pseudo');
$req->execute(array('pseudo' => $_Joueur_['pseudo']));

$donnees = $req->fetch(PDO::FETCH_ASSOC);
$_SESSION['Player']['tokens'] = $donnees['tokens'];
$_Joueur_['tokens'] = $donnees['tokens'];
?>
