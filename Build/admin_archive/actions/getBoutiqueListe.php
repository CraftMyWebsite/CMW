<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'showPage'))
{
	if(isset($_POST['page']))
	{
		$page = intval($_POST['page']);
		$debut = ($page-1)*20;
		$boutiqueListeReq = $bddConnection->query('SELECT cmw_boutique_stats.id AS id, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id ORDER BY date_achat DESC LIMIT '.$debut.', 20');
		$boutiqueListeData = $boutiqueListeReq->fetchAll(PDO::FETCH_ASSOC);
		$req = $bddConnection->query('SELECT COUNT(id) AS count FROM cmw_boutique_stats');
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$nbPage = ceil($data['count']/20);
		echo '<table class="table table-striped table-hover"><tr>
						<th>ID</th>
						<th>Pseudo</th>
						<th>Offre</th>
						<th>Prix Unitaire</th>
						<th>Quantité</th>
						<th>Prix Total</th>
						<th>Date d\'achat</th>
					</tr>';
		for($i = 0; $i < count($boutiqueListeData); $i++)
		{
			echo '<tr>
				<td>'.$boutiqueListeData[$i]['id'].'</td>
				<td>'.$boutiqueListeData[$i]['pseudo'].'</td>
				<td>'.$boutiqueListeData[$i]['titre'].'</td>
				<td>'.$boutiqueListeData[$i]['prix'].'</td>';
			if($boutiqueListeData[$i]['prixTotal'] > 0)
				echo '<td>'.ceil($boutiqueListeData[$i]['prixTotal']/$boutiqueListeData[$i]['prix']).'</td>';
			else
				echo '<td>Non renseigné</td>';
			echo '<td>'.$boutiqueListeData[$i]['prixTotal'].'</td>
				<td>'.date('d-m-Y', strtotime($boutiqueListeData[$i]['date_achat'])).'</td>
			</tr>';
		}
		echo '</table><center><nav aria-label="Page navigation example">
				  <ul class="pagination">';
		if($page <= 1)
		{
			echo '<li class="page-item active"><a class="page-link">1</a></li>';
			$pageDebut = 2;
		}
		else
			$pageDebut = 1;
	    while($pageDebut <= $nbPage)
	    {
	    	echo '<li class="page-item';
	    	if($pageDebut == $page) echo ' active';
	    	echo '"><a class="page-link" onClick="BoutiqueListePage('.$pageDebut.');">'.$pageDebut.'</a></li>';
	    	$pageDebut++;
	    }
	    echo '</ul></nav></center>';
	}
	elseif(isset($_POST['option']))
	{
		$option = htmlspecialchars($_POST['option']);
		$valeur = htmlspecialchars($_POST['value']);
		if($option == "pseudo")
		{
			$boutiqueListeReq = $bddConnection->prepare('SELECT cmw_boutique_stats.id AS id, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id WHERE cmw_boutique_stats.pseudo = :pseudo ORDER BY date_achat DESC');
			$boutiqueListeReq->execute(array(
				'pseudo' => $valeur
			));
			$boutiqueListeData = $boutiqueListeReq->fetchAll(PDO::FETCH_ASSOC);
		}
		elseif($option == "date")
		{
			$date = date('Y-m-d', strtotime($valeur));
			$boutiqueListeReq = $bddConnection->prepare('SELECT cmw_boutique_stats.id AS id, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id WHERE cmw_boutique_stats.date_achat = :date_achat');
			$boutiqueListeReq->execute(array(
				'date_achat' => $date
			));
			$boutiqueListeData = $boutiqueListeReq->fetchAll(PDO::FETCH_ASSOC);
		}
		elseif($option == "offre")
		{
			$boutiqueListeReq = $bddConnection->prepare('SELECT cmw_boutique_stats.id AS id, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id WHERE cmw_boutique_stats.offre_id = :id ORDER BY date_achat DESC');
			$boutiqueListeReq->execute(array(
				'id' => $valeur
			));
			$boutiqueListeData = $boutiqueListeReq->fetchAll(PDO::FETCH_ASSOC);
		}
		echo '<table class="table table-striped table-hover"><tr>
						<th>ID</th>
						<th>Pseudo</th>
						<th>Offre</th>
						<th>Prix Unitaire</th>
						<th>Quantité</th>
						<th>Prix Total</th>
						<th>Date d\'achat</th>
					</tr>';
		for($i = 0; $i < count($boutiqueListeData); $i++)
		{
			echo '<tr>
				<td>'.$boutiqueListeData[$i]['id'].'</td>
				<td>'.$boutiqueListeData[$i]['pseudo'].'</td>
				<td>'.$boutiqueListeData[$i]['titre'].'</td>
				<td>'.$boutiqueListeData[$i]['prix'].'</td>';
			if($boutiqueListeData[$i]['prixTotal'] > 0)
				echo '<td>'.ceil($boutiqueListeData[$i]['prixTotal']/$boutiqueListeData[$i]['prix']).'</td>';
			else
				echo '<td>Non renseigné</td>';
			echo '<td>'.$boutiqueListeData[$i]['prixTotal'].'</td>
				<td>'.date('d-m-Y', strtotime($boutiqueListeData[$i]['date_achat'])).'</td>
			</tr>';
		}
		echo '</table>';
	}
}