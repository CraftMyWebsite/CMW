<?php
$id = (int)htmlspecialchars($_POST['id']);
$message = htmlspecialchars($_POST['message']);

require_once('modele/support/postCommentaire.class.php');
$post = new PostCommentaireTicket($bddConnection);
$req_infosTicket = $post->GetInfosTicket($id);
$infosTicket = $req_infosTicket->fetch(PDO::FETCH_ASSOC);

if($infosTicket['auteur'] == $_Joueur_['pseudo'] AND $infosTicket['ticketDisplay'] == 1 OR ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsDefault']['support']['displayTicket'] == true)) {
	$post->AddCommentaireTicket($id, $message, $_Joueur_['pseudo']);
} elseif($ticketDisplay == 0) {
	$post->AddCommentaireTicket($id, $message, $_Joueur_['pseudo']);
}
?>