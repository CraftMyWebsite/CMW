<?php
$titre = htmlspecialchars($_POST['titre']);
$message = htmlspecialchars($_POST['message']);
$ticketDisplay = htmlspecialchars((int)$_POST['ticketDisplay']);

require_once('modele/support/post.class.php');
$post = new PostTicket($bddConnection);
$post->AddTicket($titre, $message, $_Joueur_['pseudo'], $ticketDisplay);
?>