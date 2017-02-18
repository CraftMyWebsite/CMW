<?php
if(isset($_Joueur_)) {
	$microTokens = new Lire('modele/config/configAlloconv.yml');
	$microTokens = $microTokens->GetTableau();
	$codeTokens = htmlspecialchars($_POST['code']);

	$apiC = 'https://secure.alloconv.fr/api/1.1/?idclient='.$microTokens['Infos']['idClient'].'&idsite='.$microTokens['Infos']['idSite'].'&cle='.$microTokens['Infos']['cle'].'&action=getnumber&code_palier='.$microTokens['palier'];
	$rawC = file_get_contents($apiC);
	$alloconvC = json_decode($rawC, true);

	if(strlen($codeTokens) == 8 AND $microTokens['enabled'] == true AND $alloconvC['statut'] == 'true') {
		$apiT = 'https://secure.alloconv.fr/api/1.1/?idclient='.$microTokens['Infos']['idClient'].'&idsite='.$microTokens['Infos']['idSite'].'&cle='.$microTokens['Infos']['cle'].'&action=transactioncode&code_palier='.$microTokens['palier'].'&code1='.$codeTokens;
		$rawT = file_get_contents($apiT);
		$alloconvT = json_decode($rawT, true);

		if($alloconvT['statut'] == 'true' OR $alloconvT['test'] == 'yes') {
			require_once('modele/alloconv.class.php');
			$insertInfos = new alloConvInfos($bddConnection);
			$insertInfos->insertInfos($_Joueur_['pseudo'], $codeTokens, $alloconvT['numero_surtaxe'], $alloconvT['prix_total']);

			require_once('modele/joueur/maj.class.php');
			$majInfos = new Maj($_Joueur_['pseudo'], $bddConnection);
			$dataInfos = $majInfos->getReponseConnection();
			$dataInfos = $dataInfos->fetch();
			$dataInfos['tokens'] = $dataInfos['tokens'] + $microTokens['tokens'];
			$majInfos->setReponseConnection($dataInfos);
			$majInfos->setNouvellesDonneesTokens($dataInfos);
			$_Joueur_['tokens'] = $_Joueur_['tokens'] + $microTokens['tokens'];
			$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
			header('Location: index.php?&page=token&transactionStatus=true');
			
		} else {
			header('Location: index.php?&page=token&transactionStatus=false');
		}
	} else {
		header('Location: index.php?&page=token&transactionStatus=false');
	}
} else {
	header('Location: index.php?&NotOnline=true');
}
?>