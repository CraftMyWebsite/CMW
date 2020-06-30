<?php

if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'showPage')) {

    /* Statistiques de la boutique 
        -> $boutiqueStats = 12 dernièrs achats sur la boutique
        -> $lastOffre = Dernière offre Boutique créé
        -> lastOffresPaypal = Dernière offre Paypal créé
    */

    $boutiquesStatsReq = $bddConnection->query('SELECT * FROM cmw_boutique_stats ORDER BY id DESC LIMIT 0, 12;'); //12 derniers achats
    $boutiquesStats = $boutiquesStatsReq->fetchAll(PDO::FETCH_ASSOC);
    
    $lastOffreReq = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY id DESC LIMIT 1;');
    $lastOffre = $lastOffreReq->fetchAll(PDO::FETCH_ASSOC);

    $lastOffrePaypalReq = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres ORDER BY id DESC LIMIT 1;');
    $lastOffrePaypal = $lastOffrePaypalReq->fetchAll(PDO::FETCH_ASSOC);
    
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
    

    // <!-- Statistiques des membres -->
    $membresStatsReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 0, 8;');
    $membresStats = $membresStatsReq->fetchAll(PDO::FETCH_ASSOC);
   

    // Statistiques du dernier inscrit
    $lastMembreReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 1;');
    $lastMembre = $lastMembreReq->fetchAll(PDO::FETCH_ASSOC);
    

    // <!-- Statistiques du dernier Ticket -->
    $lastTicketReq = $bddConnection->query('SELECT * FROM cmw_support ORDER BY id DESC LIMIT 1;');
    $lastTicket = $lastTicketReq->fetchAll(PDO::FETCH_ASSOC);

    // <!-- Statistiques du dernier Commentaire Support -->
    $lastCommentaireSuppReq = $bddConnection->query('SELECT * FROM cmw_support_commentaires ORDER BY id DESC LIMIT 1;');
    $lastCommentaireSupp = $lastCommentaireSuppReq->fetchAll(PDO::FETCH_ASSOC);

    //  Statistiques des News
    $lastCommentaireNewsReq = $bddConnection->query('SELECT * FROM cmw_news_commentaires ORDER BY id DESC LIMIT 1;');
    $lastCommentaireNews = $lastCommentaireNewsReq->fetchAll(PDO::FETCH_ASSOC);

    $lastNewsReq = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id DESC LIMIT 1;');
    $lastNews = $lastNewsReq->fetchAll(PDO::FETCH_ASSOC);

    //Stats des votes
    $lastVoteReq = $bddConnection->query('SELECT * FROM cmw_votes ORDER BY date_dernier DESC LIMIT 1;');
    $lastVote = $lastVoteReq->fetchAll(PDO::FETCH_ASSOC);

    //Stats Maintenance
    $lastMaintenanceReq = $bddConnection->query('SELECT * FROM cmw_maintenance WHERE maintenanceId = 1');
    $lastMaintenance = $lastMaintenanceReq->fetchAll(PDO::FETCH_ASSOC);

    //Stats échange Jetons
    $req = $bddConnection->query('SELECT * FROM cmw_log_DealJeton ORDER BY date DESC LIMIT 10;');
    $lastDealJeton = $req->fetchAll(PDO::FETCH_ASSOC);
}
?>