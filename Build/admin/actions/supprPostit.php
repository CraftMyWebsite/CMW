<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'postit', 'actions', 'addPostIt')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_postit WHERE id = :id');
	$req->execute(array(':id' => $_GET['id']));
	$all_message_postit = $bddConnection->query('SELECT id, auteur, message FROM cmw_postit ORDER BY id DESC LIMIT 0, 4');
    while ($message_postit = $all_message_postit->fetch(PDO::FETCH_ASSOC)) { ?>
    	<p id="<?=$message_postit['id'];?>"><strong>[<?php echo $message_postit['auteur']; ?>] </strong> <?php echo $message_postit['message']; ?>&nbsp;&nbsp; <a onClick="ajaxSupprPostIt(<?php echo $message_postit['id']; ?>);"><i class="fa fa-trash" aria-hidden="true"></i></a></p>
   <?php }
   exit();
}
?>