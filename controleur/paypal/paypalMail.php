<?php

$email_paypal = $_Serveur_['Payement']['paypalEmail'];/*email associé au compte paypal du vendeur*/
$item_prix = $offresTableau[$i]['prix'];    /*prix du produit*/
$item_nom = $offresTableau[$i]['description'];; /*Nom du produit*/
$url_retour = $_Serveur_['General']['url']. '/index.php?page=token&notif=0';/*page de remerciement à créer*/
$url_cancel = $_Serveur_['General']['url']. '/index.php?page=token&notif=1'; /* page d'annulation d'achat SI RETOUR */
$url_confirmation = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_confirmation = substr($url_confirmation, 0, -12);
$url_confirmation = $_Serveur_['General']['url'] .'/?action=verif_paypal&offre='. $offresTableau[$i]['id'];/*page de confirmation d'achat*/
/* fin déclaration des variables */

$lien = 'https://www.paypal.com/cgi-bin/webscr';
$postfields = array(
	'cmd' => '_xclick',
	'business' => $email_paypal,
	'item_name' => $item_nom,
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
	'custom' => $_Joueur_['pseudo']
);
?>
<form style="width: 50%; float: left;" action="<?php echo $lien; ?>" method="post">
	<?php 
	foreach($postfields as $cle => $valeur)
	{
		echo '<input type="hidden" name="'. $cle .'" value="'. $valeur .'" />';
	}
	?>
	<input type="submit" class="btn btn-primary" value="Acheter !" />
</form>
