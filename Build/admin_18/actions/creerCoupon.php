<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'creerCoupon'))
{
	if(isset($_POST['code'], $_POST['titre'], $_POST['pourcent']))
	{
		$code = htmlspecialchars($_POST['code']);
		$titre = htmlspecialchars($_POST['titre']);
		$pourcent = htmlspecialchars($_POST['pourcent']);
		if(isset($_POST['OuiCat']))
			$categorie = intval($_POST['cat']);
		else
			$categorie = null;
		if(isset($_POST['OuiTemps']))
		{
			$debut = strtotime($_POST['dDebut']);
			$fin = strtotime($_POST['dFin']);
		}
		else
		{
			$debut = null;
			$fin = null;
		}
		if(isset($_POST['OuiFois']))
			$expire = intval($_POST['expire']);
		else
			$expire = null;

		$req = $bddConnection->prepare('INSERT INTO cmw_boutique_reduction (code_promo, pourcent, titre, categorie, debut, fin, expire) VALUES (:code, :pourcent, :titre, :cat, :debut, :fin, :expire)');
		$req->execute(array('code' => $code,
							'pourcent' => $pourcent,
							'titre' => $titre,
							'cat' => $categorie,
							'debut' => $debut,
							'fin' => $fin,
							'expire' => $expire
		));
	}
}