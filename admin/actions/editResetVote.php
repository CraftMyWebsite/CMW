<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', "actions", 'editReset')) { 


	$type = intval(htmlspecialchars($_POST['type']));
	$action = null;
	if($type != 0) {
		require('modele/recompenseAuto.class.php');
		$temp['heur'] = intval(htmlspecialchars($_POST['heur']));
		$temp['min'] = intval(htmlspecialchars($_POST['min']));
		if($type == 1) {
			$temp['jour'] = intval(htmlspecialchars($_POST['jour']));
		} else if($type==2) {
			$temp['mois'] = intval(htmlspecialchars($_POST['mois']));
		}
		$temp['etat'] = RecompenseAuto::configureNextDate($temp, $type);
		$action = json_encode($temp);

		$req = $bddConnection->query('SELECT * FROM cmw_votes_recompense_auto_config WHERE type=3');
		$req = $req->fetch(PDO::FETCH_ASSOC);
		if(isset($req) && !empty($req)) {
			$req = $bddConnection->prepare('UPDATE cmw_votes_recompense_auto_config SET `valueType`=:type, `action`=:action WHERE type=3 ');
			$req->execute(array(
				'type' => $type,
				'action' => $action
			));
		} else {
			$req = $bddConnection->prepare('INSERT INTO cmw_votes_recompense_auto_config ( `type`, `valueType`, `action`) VALUES (3,:type,:action)');
			$req->execute(array(
				'type' => $type,
				'action' => $action
			));
		}
	}
	else {
		$bddConnection->exec('DELETE FROM cmw_votes_recompense_auto_config WHERE type=3 ');
	}

}
?>