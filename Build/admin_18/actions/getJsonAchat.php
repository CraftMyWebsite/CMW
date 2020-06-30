<?php if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{

if($_POST['axe'] == 'pseudo') {
	$boutiqueListeReq = $bddConnection->prepare('SELECT cmw_boutique_stats.id as id, cmw_boutique_stats.id AS id2, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id WHERE pseudo LIKE :search ORDER BY :axe :axetype');
		$boutiqueListeReq->execute(array(
			'search' => '%'.$_POST['search'].'%',
			'axe' => $_POST['axe'],
			'axetype' => $_POST['axeType']
		));
} else {
	$boutiqueListeReq = $bddConnection->prepare('SELECT cmw_boutique_stats.id as id, cmw_boutique_stats.id AS \'id2\', cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id ORDER BY :axe :axetype');
	$boutiqueListeReq->execute(array(
			'axe' => $_POST['axe'],
			'axetype' => $_POST['axeType']
		));
}

			while($boutiqueListeData = $boutiqueListeReq->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				if($i > ($_POST['index']) * $_POST['max'])
				{
					
					if($i > ($_POST['index']+1 ) * $_POST['max'])
					{
						break;
					} else {
						$boutiqueListeData['id'] = $i;
						$boutiqueListeData['quantite'] = ($boutiqueListeData['prixTotal'] > 0) ? ceil($boutiqueListeData['prixTotal']/$boutiqueListeData['prix']) : 'Non renseigné';
						$allachat[$i] =$boutiqueListeData;
					}
				}
			}
	if(isset($allachat) && !empty($allachat)) {
		echo '[DIV]'.json_encode(array_values($allachat)); 
	}



} ?>