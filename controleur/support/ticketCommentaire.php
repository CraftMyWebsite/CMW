<?php
$id = (int)htmlspecialchars($_POST['id']);
require('modele/app/ckeditor.class.php');
	$message = ckeditor::verif($_POST['message']);
    $message = Security::sanitizeInput($message);

require_once('modele/support/postCommentaire.class.php');
$post = new PostCommentaireTicket($bddConnection);
$req_infosTicket = $post->GetInfosTicket($id);
$infosTicket = $req_infosTicket->fetch(PDO::FETCH_ASSOC);

if(($infosTicket['auteur'] === $_Joueur_['pseudo'] && $infosTicket['ticketDisplay'] === 1) || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) {
	$post->AddCommentaireTicket($id, $message, $_Joueur_['pseudo']);
} elseif($ticketDisplay == 0) {
	$post->AddCommentaireTicket($id, $message, $_Joueur_['pseudo']);
}
