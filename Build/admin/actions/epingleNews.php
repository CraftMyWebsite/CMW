<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['editNews'] == true)
{
	if(isset($_GET['newsId'], $_GET['epingle']))
	{
		$epingle = ($_GET['epingle'] == 1) ? 0 : 1;
		$id = intval($_GET['newsId']);
		$req = $bddConnection->prepare('UPDATE cmw_news SET epingle = :epingle WHERE id = :id');
		$req->execute(array(
			'epingle' => $epingle,
			'id' => $id
		));
	}
}