<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['addOffrePaypal'] == true) { 
	$req = $bddConnection->prepare('INSERT INTO cmw_jetons_paypal_offres(nom, description, prix, jetons_donnes) VALUES(:nom, :description, :prix, :jetons_donnes)');
	$req->execute(Array(    
		'nom'           =>  $_POST['nom'],
		'description'   =>  $_POST['description'],
		'prix'          =>  $_POST['prix'],
		'jetons_donnes' =>  $_POST['jetons_donnes'] ));
}
?>