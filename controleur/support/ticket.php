<?php
$titre = htmlspecialchars($_POST['titre']);
$message = htmlspecialchars($_POST['message']);

require_once('modele/support/post.class.php');
$post = new PostTicket($bddConnection);
$post->AddTicket($titre, $message, $_Joueur_['pseudo']);
?>