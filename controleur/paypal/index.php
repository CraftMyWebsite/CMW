<?php
require_once('controleur/connection_base.php'); 
$recupOpffresPaypal = $bddConnection->prepare('SELECT * FROM cmw_jetons_paypal_offres WHERE id = :id');
$recupOpffresPaypal->execute(array('id' => $_GET['offer']));
$donneesActions = $recupOpffresPaypal->fetch();
include("controleur/paypal/fonction_api.php");
$requete = construit_url_paypal($_Serveur_['Payement']['paypalUser'], $_Serveur_['Payement']['paypalPass'], $_Serveur_['Payement']['paypalSignature']);
$requete = $requete."&METHOD=SetExpressCheckout".
			"&CANCELURL=".urlencode("http://undergard.fr/controleur/paypal/cancel.php").
			"&RETURNURL=".urlencode("http://undergard.fr/?&action=achatPaypalReturn&offre=") . $_GET['offer'] .
			"&AMT=" . $donneesActions['prix'] .
			"&CURRENCYCODE=EUR".
			"&DESC=".urlencode("Vous pouvez faire un don pour le serveur qui server à payer les hébergements et à acheter des grades ou items.").
			"&LOCALECODE=FR".
			"&HDRIMG=".urlencode("http://images5.fanpop.com/image/polls/1103000/1103948_1345399475397_full.png");

$ch = curl_init($requete);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$resultat_paypal = curl_exec($ch);

if (!$resultat_paypal)
	{echo "<p>Erreur</p><p>".curl_error($ch)."</p>";}
else
{
	$liste_param_paypal = recup_param_paypal($resultat_paypal); // Lance notre fonction qui dispatche le résultat obtenu en un array

	// Si la requête a été traitée avec succès
	if ($liste_param_paypal['ACK'] == 'Success')
	{
		// Redirige le visiteur sur le site de PayPal
		header("Location: https://www.paypal.com/webscr&cmd=_express-checkout&token=".$liste_param_paypal['TOKEN']);
                exit();
	}
	else // En cas d'échec, affiche la première erreur trouvée.
	{echo "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";}		
}
curl_close($ch);
?>
