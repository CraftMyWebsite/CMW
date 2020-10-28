<?php

	$recupOffres = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');
		
	$tableauOffres = $recupOffres->fetchAll(PDO::FETCH_ASSOC);

	//Mise en place des paramètres invariant
	$email_paypal = $_Serveur_['Payement']['paypalEmail'];/*email associé au compte paypal du vendeur*/
	$url_retour = $_Serveur_['General']['url']. '/index.php?page=token&notif=0';/*page de remerciement à créer*/
	$url_cancel = $_Serveur_['General']['url']. '/index.php?page=token&notif=1'; /* page d'annulation d'achat SI RETOUR */
	$url_confirmation = $_Serveur_['General']['url'] .'/?action=verif_paypal'; //Page de confirmation (callback IPN)
	$lien = 'https://www.paypal.com/cgi-bin/webscr';
	//Fin des paramètres invariant

	foreach($tableauOffres as $key => $value)
	{
		//Set des paramètres variables
		$item_prix = $value['prix'];    /*prix du produit*/
		$item_nom = $value['nom']; /*Nom du produit*/
		$item_id = $value['id'];
		/* fin déclaration des variables */
		
		$tableauOffres[$key]['paramPaypal'] = array(
			'cmd' => '_xclick',
			'cn' => $_Serveur_['General']['description'],
			'business' => $email_paypal,
			'item_name' => $item_nom,
			'item_number' => '1',
			'quantity' => '1',
			'amount' => $item_prix,
			'currency_code' => 'EUR',
			'no_note' => '1',
			'no-shipping' => '1',
			'tax' => '0.00',
			'bn' => 'PP-BuyNowBF',
			'lc' => 'FR',
			'notify_url' => $url_confirmation,
			'cancel_return' => $url_cancel,
			'return' => $url_retour,
			'custom' => $_Joueur_['pseudo'].','.$item_id
		);
	}
?>