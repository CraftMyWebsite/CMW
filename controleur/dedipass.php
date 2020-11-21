<?php 
$code = isset($_POST['code']) ? preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['code']) : ''; 
if( empty($code) ) { 
  header('Location: index.php?page=token&success=false');
} 
else { 
  $dedipass = file_get_contents('http://api.dedipass.com/v1/pay/?public_key=' . $_Serveur_['Payement']['public_key'] . '&private_key=' . $_Serveur_['Payement']['private_key'] . '&code=' . $code);
  $dedipass = json_decode($dedipass); 
  if($dedipass->status == 'success') { 
    // Le transaction est validée et payée. 
    // Vous pouvez utiliser la variable $virtual_currency 
    // pour créditer le nombre de Jetons. 
    $virtual_currency = $dedipass->virtual_currency; 
	$rate = $dedipass->rate;
	$payout = $dedipass->payout;
	$code = $dedipass->code;
	if($virtual_currency == 0 OR $virtual_currency == NULL)
	{
		$virtual_currency = 1;
	}
	$achat = $bddConnection->prepare('INSERT INTO cmw_dedipass (pseudo, code, rate, payout, tokens, date_achat) VALUES (:pseudo, :code, :rate, :payout, :tokens, NOW() ) ');
	$achat->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'code' => $code,
		'rate' => $rate,
		'payout' => $payout,
		'tokens' => $virtual_currency
	));
	require_once('modele/joueur/maj.class.php');
	$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
	$playerData = $joueurMaj->getReponseConnection();
	$playerData = $playerData->fetch(PDO::FETCH_ASSOC);
	$playerData['tokens'] = $playerData['tokens'] + $virtual_currency;
	$joueurMaj->setReponseConnection($playerData);
	$joueurMaj->setNouvellesDonneesTokens($playerData);
	$_Joueur_['tokens'] = $_Joueur_['tokens'] + $virtual_currency;
	
  header("Location: index.php?page=token&success=true&tokens={$virtual_currency}");
  } 
  else { 
    // Le code est invalide 
    header('Location: index.php?page=token&success=false');
  } 
} 
?>
