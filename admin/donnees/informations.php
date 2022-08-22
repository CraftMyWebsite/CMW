<?php

if($_Permission_->verifPerm('PermsPanel', 'info', 'showPage')) {

    /* Statistiques de la boutique 
        -> $lastachatreq = 10 derniers achats sur la boutique
        -> $TotalOffre = nombre d'offre boutique
    */
    $lastachatreq = $bddConnection->query('SELECT * FROM `cmw_boutique_stats` ORDER BY `id` DESC LIMIT 10');

    $nboffreboutique = $bddConnection->query('SELECT count(id) as nb FROM `cmw_boutique_offres`');
    $nboffre = $nboffreboutique->fetch(PDO::FETCH_ASSOC);
    $TotalOffre = $nboffre["nb"];

    /*Récupération des données JSONAPI
        $serveurStats -> toutes les données utiles du serveur (RAM, DD, Joueurs MAX, Actuels et leurs noms ...)
        $console -> La console
        $plugins -> les plugins 
    */
    if(isset($jsonCon))
    {
        foreach($jsonCon as $key => $serveur)
        {
            if($conEtablie[$key])
            {
                $serveurStats[$key] = $serveur->GetServeurInfos();
                $console[$key] = $serveur->GetConsole();
                $plugins[$key] = $serveur->getPlugins();
            }
        }
    }


    // <!-- Statistiques support -->
    $lastticketreq = $bddConnection->query('SELECT id,auteur,titre,etat FROM `cmw_support` ORDER BY `id` DESC LIMIT 1');
    $LastTicket = $lastticketreq->fetch(PDO::FETCH_ASSOC);

    $nbsupport = $bddConnection->query('SELECT count(id) as nb FROM `cmw_support`');
    $nbsupportwait = $nbsupport->fetch(PDO::FETCH_ASSOC);
    $TotalSupport = $nbsupportwait["nb"];

    //  Statistiques des News
    $lastnewsreq = $bddConnection->query('SELECT id,auteur,titre FROM `cmw_news` ORDER BY `id` DESC LIMIT 1');
    $LastNews = $lastnewsreq->fetch(PDO::FETCH_ASSOC);

    $nbnews = $bddConnection->query('SELECT count(id) as nb FROM `cmw_news`');
    $nbne = $nbnews->fetch(PDO::FETCH_ASSOC);
    $TotalNews = $nbne["nb"];
    
    //Vérification du système de confirmation par mail des inscriptions
    $req_etatMail = $bddConnection->query("SELECT etatMail FROM cmw_sysmail WHERE idMail = 1");
    $get_etatMail = $req_etatMail->fetch(PDO::FETCH_ASSOC);
    $ShowMail = $get_etatMail['etatMail'] == 1;

    // <!-- Statistiques des membres -->
    $lastRegisterMember = $bddConnection->query('SELECT id,pseudo,tokens,email,anciennete'.(($ShowMail)? ",ValidationMail":"").''.($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showIP') ? ",ip" : "").' FROM cmw_users ORDER BY id DESC LIMIT 0, 10;');
    //Récupération du staff chat
    $all_message_staff = $bddConnection->query('SELECT id, auteur, message FROM cmw_postit ORDER BY id DESC');
}
?>