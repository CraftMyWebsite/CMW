<?php
$titre = Security::sanitizeInput($_POST['titre']);
require('modele/app/ckeditor.class.php');
$message = ckeditor::verif($_POST['message']);
$message = Security::sanitizeInput($message);

$ticketDisplay = htmlspecialchars((int)$_POST['ticketDisplay']);
require_once('modele/support/post.class.php');
if ($_Serveur_['support']['visibilite'] !== 'both') {
    if (($_Serveur_['support']['visibilite'] === 'prive' && $ticketDisplay != 1) || ($_Serveur_['support']['visibilite'] === 'public' && $ticketDisplay != 0)) {
        header('Location: index.php?page=erreur&erreur=17');
    } else {
        $post = new PostTicket($bddConnection);
        $post->AddTicket($titre, $message, $_Joueur_['pseudo'], $ticketDisplay);
    }
} else {
    $post = new PostTicket($bddConnection);
    $post->AddTicket($titre, $message, $_Joueur_['pseudo'], $ticketDisplay);
}