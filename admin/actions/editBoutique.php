<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) {

	require('modele/app/ckeditor.class.php');

	$_POST['categorieNom'] = htmlspecialchars($_POST['categorieNom']);
	$_POST['number'] = intval($_POST['number']);

	$_POST['categorieInfo'] = ckeditor::verif($_POST['categorieInfo']);
	$req = $bddConnection->prepare('UPDATE cmw_boutique_categories SET titre = :titre, message = :message, showNumber = :show WHERE id = :id');
	$req->execute(Array (
		'titre' => $_POST['categorieNom'],
		'message' => $_POST['categorieInfo'],
		'id' => $_POST['categorie'],
		'show' => $_POST['number'] 

	));

	require_once('modele/boutique/offres.class.php'); 
	$offre = new OffresList($bddConnection, $jsonCon, $_Joueur_);
	$offres = $offre->GetTableauOffres();

	for($j = 1;$j <= count($offres);$j++) {
        if($offres[$j]['categorie'] == $_POST['categorie']) {
        	if(isset($_POST["suppr".$offres[$j]['id']]) && $_POST["suppr".$offres[$j]['id']] == "true") {
        		$req = $bddConnection->prepare('DELETE FROM `cmw_boutique_offres` WHERE id=:id');
	        	$req->execute(Array ('id' => $offres[$j]['id']));

	        	$req = $bddConnection->prepare('DELETE FROM `cmw_boutique_action` WHERE `id_offre`=:id');
	        	$req->execute(Array ('id' => $offres[$j]['id']));

	        	for($o = 1;$o <= count($offres);$o++) {
	        		if(isset($offres[$o]['evo'])) {
	        			$tp = explode(",",$offres[$o]['evo']);
	        			$flag = false;
	        			$str = "";
                        foreach($tp as $value)
                        {
                        	if($value == $offres[$j]['id']) {
                        		$flag=true;
                        	} else {
                        		$str=$str.$value.",";
                        	}           
                        }
                        if($flag) {
                        	if($str != "") {
                        		$str = substr($str, 0, -1);
                        	} else {
                        		$str = null;
                        	}
                        	$req = $bddConnection->prepare('UPDATE `cmw_boutique_offres` SET `evo`=:evo WHERE `id`=:id');
	        				$req->execute(Array ('id' => $offres[$o]['id'],
	        				'evo' => $str));
                        }
	        		}
	        	}


        	} else {

	        	$_POST['offresNom'.$offres[$j]['id']] = htmlspecialchars($_POST['offresNom'.$offres[$j]['id']]);
	        	$_POST['offresDescription'.$offres[$j]['id']] = htmlspecialchars($_POST['offresDescription'.$offres[$j]['id']]);	
				$_POST['offresDescription'.$offres[$j]['id']] = ckeditor::verif($_POST['offresDescription'.$offres[$j]['id']]);
	        	$req = $bddConnection->prepare('UPDATE `cmw_boutique_offres` SET `nom`=:nom,`description`=:description,`prix`=:prix,`nbre_vente`=:nbre_vente,`categorie_id`=:categorie_id,`ordre`=:ordre,`evo`=:evo,`max_vente`=:max_vente WHERE id=:id');
	        	$req->execute(Array (
						'nom' => $_POST['offresNom'.$offres[$j]['id']],
						'description' => $_POST['offresDescription'.$offres[$j]['id']],
						'prix' => $_POST['offresPrix'.$offres[$j]['id']],
						'nbre_vente' => $_POST['nbre_vente'.$offres[$j]['id']],
						'categorie_id' => $_POST['offresCategorie'.$offres[$j]['id']],
						'ordre' => $_POST['offresOrdre'.$offres[$j]['id']],
						'evo' => $_POST['dep'.$offres[$j]['id']],
						'max_vente' => $_POST['max_vente'.$offres[$j]['id']],
						'id' => $offres[$j]['id']));
        	}
        }

    }
}
?>