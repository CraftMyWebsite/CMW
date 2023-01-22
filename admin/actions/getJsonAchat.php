<?php if($_Permission_->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{

	$boutiqueListeReq = $bddConnection->query('SELECT cmw_boutique_stats.id as id, cmw_boutique_stats.id AS \'id2\', cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id WHERE pseudo LIKE \'%'.$_POST['search'].'%\' ORDER BY \''.$_POST['axe'].'\' \''.$_POST['axeType'].'\'');
		
		$i = 0;
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
					$boutiqueListeData['date_achat'] = str_replace(':', 'H', str_replace(' ', ' à ', substr($boutiqueListeData['date_achat'], 0,-3)));
					$boutiqueListeData['quantite'] = ($boutiqueListeData['prixTotal'] > 0) ? ceil($boutiqueListeData['prixTotal']/$boutiqueListeData['prix']) : 'Non renseigné';
					$allachat[$i] =$boutiqueListeData;
				}
			}
		}
	echo '[DIV]';
	if(isset($allachat) && !empty($allachat)) {
		echo json_encode(array_values($allachat)); 
	}



} ?>