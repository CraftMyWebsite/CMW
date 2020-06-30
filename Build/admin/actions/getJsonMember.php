<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'showPage')) { 


	if($_POST['axe'] == 'rang') {
		$i = 0;
		if($_POST['axeType'] == 'DESC')
		{
			$allmembresReq = $bddConnection->query('SELECT id, id as \'id2\', pseudo, email, rang, tokens, ValidationMail FROM cmw_users WHERE rang = 0 AND pseudo LIKE \'%'.$_POST['search'].'%\'');
			while($allmembresDonnees = $allmembresReq->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				if($i > ($_POST['index']) * $_POST['max'])
				{
					
					if($i > ($_POST['index']+1 ) * $_POST['max'])
					{
						break;
					} else {
						$allmembresDonnees['id'] = $i;
						$allmembres[$i] =$allmembresDonnees;
					}
				}
			}
		}
		$allmembresReq = $bddConnection->query('SELECT id, id as \'id2\', pseudo, email, rang, tokens, ValidationMail FROM cmw_users WHERE rang != 0 AND pseudo LIKE \'%'.$_POST['search'].'%\' ORDER BY rang '.$_POST['axeType']);
		
		while($allmembresDonnees = $allmembresReq->fetch(PDO::FETCH_ASSOC))
		{
			$i++;
			if($i > ($_POST['index'] ) * $_POST['max'])
			{
					
				if($i > ($_POST['index']+1 ) * $_POST['max'])
				{
					break;
				} else {
					$allmembresDonnees['id'] = $i;
					$allmembres[$i] =$allmembresDonnees;
				}
			}
		}
		if($_POST['axeType'] == 'ASC')
		{
			$allmembresReq = $bddConnection->query('SELECT id, id as \'id2\', pseudo, email, rang, tokens, ValidationMail FROM cmw_users WHERE rang = 0 AND pseudo LIKE \'%'.$_POST['search'].'%\'');
			while($allmembresDonnees = $allmembresReq->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				if($i > ($_POST['index'] ) * $_POST['max'])
				{
					
					if($i > ($_POST['index']+1 ) * $_POST['max'])
					{
						break;
					} else {
						$allmembresDonnees['id'] = $i;
						$allmembres[$i] =$allmembresDonnees;
					}
				}
			}
		}
	} else {
		$i = 0;
		$allmembresReq = $bddConnection->query('SELECT id, id as \'id2\', pseudo, email, rang, tokens, ValidationMail FROM cmw_users WHERE pseudo LIKE \'%'.$_POST['search'].'%\' ORDER BY '.$_POST["axe"].' '.$_POST["axeType"]);
		while($allmembresDonnees = $allmembresReq->fetch(PDO::FETCH_ASSOC))
		{
			$i++;
			if($i > ($_POST['index']) * $_POST['max'])
			{
				
				if($i > ($_POST['index']+1 ) * $_POST['max'])
				{
					break;
				} else {
					$allmembresDonnees['id'] = $i;
					$allmembres[$i] =$allmembresDonnees;
				}
			}
		}
	}
	echo '[DIV]'.json_encode(array_values($allmembres));
}
?>