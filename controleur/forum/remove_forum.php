<?php 
if(isset($_Joueur_) AND $_Joueur_['rang'] == 1 AND isset($_GET['id']))
{
	$id = htmlspecialchars($_GET['id']);
	$remove = $bddConnection->prepare('DELETE FROM cmw_forum WHERE id = :id');
	$remove->execute(array(
		'id' => $id
	));
	header('Location: ?page=forum');
}
elseif(!isset($_Joueur_))
{
	?><script> console.log("Erreur t pas co bouffon"); </script> <?php 
}
elseif($_Joueur_ != 1)
{
	?><script> console.log("Mauvais truc de perm :("); </script> <?php 
}
else
{
	?><script> console.log("PBL"); </script><?php 
}