<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) { 
	$i = 0;
	foreach($_POST as $cle => $element)
	{
		$post[$i] = explode('-', $cle);
		$i++;
	}
	for($i = 0; $i < count($post); $i = $i + 2)
	{
		$req = $bddConnection->prepare('UPDATE cmw_boutique_action SET methode = :methode, commande_valeur = :commande_valeur WHERE id = :id');
		$req->execute(array (
			'methode' => $_POST['methode-'. $post[$i][1]],
			'commande_valeur' => $_POST['commandeValeur-'. $post[$i][1]],
			'id' => $post[$i][1]		));
	}
}
?>