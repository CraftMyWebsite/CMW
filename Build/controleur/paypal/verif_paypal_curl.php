

<?php


$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$PostData = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
    $PostData[$keyval[0]] = urldecode($keyval[1]);
}

$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
  $get_magic_quotes_exists = true;
}
foreach ($PostData as $key => $value) {
  if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
    $value = urlencode(stripslashes($value));
  } else {
    $value = urlencode($value);
  }
  $req .= "&".$key."=".$value;
}


$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

if ( !($res = curl_exec($ch)) ) {
  curl_close($ch);
  exit;
}
if (strcmp ($res, "VERIFIED") == 0) {
	
	$return = explode(',', $_POST['custom']);
	
	$recupOpffresPaypal = $bddConnection->prepare('SELECT * FROM cmw_jetons_paypal_offres WHERE id = :id');
	$recupOpffresPaypal->execute(array('id' => $return[1]));
	$donneesActions = $recupOpffresPaypal->fetch(PDO::FETCH_ASSOC);
	
	if ($_POST['payment_status']=="Completed" AND $_POST['receiver_email']==$_Serveur_['Payement']['paypalEmail'] AND (string)$_POST['mc_gross']==(string)$donneesActions['prix'] AND (string)$_POST['mc_currency']=="EUR")
	{
		require_once('modele/joueur/maj.class.php');
		$joueurMaj = new Maj($return[0], $bddConnection);
		$playerData = $joueurMaj->getReponseConnection();
		$playerData = $playerData->fetch(PDO::FETCH_ASSOC);
		$playerData['tokens'] = $playerData['tokens'] + $donneesActions['jetons_donnes'];
		$joueurMaj->setReponseConnection($playerData);
		$joueurMaj->setNouvellesDonneesTokens($playerData);
	}
}

curl_close($ch);
exit;
?>
