<?php
require_once('controleur/connection_base.php'); 
$recupOpffresPaypal = $bddConnection->prepare('SELECT * FROM cmw_jetons_paypal_offres WHERE id = :id');
$recupOpffresPaypal->execute(array('id' => $_GET['offre']));
$donneesActions = $recupOpffresPaypal->fetch();
include("fonction_api.php"); // On importe la page créée précédemment
$requete = construit_url_paypal($_Serveur_['Payement']['paypalUser'], $_Serveur_['Payement']['paypalPass'], $_Serveur_['Payement']['paypalSignature']);

// On ajoute le reste des options
// La fonction urlencode permet d'encoder au format URL les espaces, slash, deux points, etc.)
$requete = $requete."&METHOD=DoExpressCheckoutPayment".
			"&TOKEN=".htmlentities($_GET['token'], ENT_QUOTES). // Ajoute le jeton qui nous a été renvoyé
			"&AMT=" . $donneesActions['prix'] .
			"&CURRENCYCODE=EUR".
			"&PayerID=".htmlentities($_GET['PayerID'], ENT_QUOTES). // Ajoute l'identifiant du paiement qui nous a également été renvoyé
			"&PAYMENTACTION=sale";

// Initialise notre session cURL. On lui donne la requête à exécuter.
$ch = curl_init($requete);

// Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné. 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// On lance l'exécution de la requête URL et on récupère le résultat dans une variable
$resultat_paypal = curl_exec($ch);

if (!$resultat_paypal) // S'il y a une erreur, on affiche "Erreur", suivi du détail de l'erreur.
	{echo "<p>Erreur</p><p>".curl_error($ch)."</p>";}
// S'il s'est exécuté correctement, on effectue les traitements...
else
{
	$liste_param_paypal = recup_param_paypal($resultat_paypal); // Lance notre fonction qui dispatche le résultat obtenu en un array
	
	
	// Si la requête a été traitée avec succès
	if ($liste_param_paypal['ACK'] == 'Success')
	{
		require_once('modele/joueur/maj.class.php');
		$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
		$playerData = $joueurMaj->getReponseConnection();
		$playerData = $playerData->fetch();
		$playerData['tokens'] = $playerData['tokens'] + $donneesActions['jetons_donnes'];
		$joueurMaj->setReponseConnection($playerData);
		$joueurMaj->setNouvellesDonneesTokens($playerData);
		$_Joueur_['tokens'] = $_Joueur_['tokens'] + $donneesActions['jetons_donnes'];
		$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
	}
	else // En cas d'échec, affiche la première erreur trouvée.
	{echo "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";}
}
// On ferme notre session cURL.
curl_close($ch);
?>
