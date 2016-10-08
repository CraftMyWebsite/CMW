<?php
$message = htmlspecialchars($_POST['message']);
$id = (int)htmlspecialchars($_POST['id']);

require_once('modele/support/postCommentaire.class.php');
$post = new PostCommentaireTicket($bddConnection);
$post->AddCommentaireTicket($id, $message, $_Joueur_['pseudo']);
?>