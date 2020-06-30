<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) {
//Statistiques de la Boutique

    $boutiquesStatsReq = $bddConnection->query('SELECT * FROM cmw_boutique_stats ORDER BY id DESC LIMIT 0, 12;');
    $i = 0;
    while($boutiquesStatsDonnees = $boutiquesStatsReq->fetch(PDO::FETCH_ASSOC))
    {
        $boutiquesStats[$i] = $boutiquesStatsDonnees;
        $i++;
    }
    $lastOffreReq = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffreDonnees = $lastOffreReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastOffre[$i] = $lastOffreDonnees;
        $i++;
    }
    $lastOffrePaypalReq = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffrePaypalDonnees = $lastOffrePaypalReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastOffrePaypal[$i] = $lastOffrePaypalDonnees;
        $i++;
    }
    // <!-- Statistiques des membres -->
    $membresStatsReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 0, 8;');
    $i = 0;
    while($membresStatsDonnees = $membresStatsReq->fetch(PDO::FETCH_ASSOC))
    {
        $membresStats[$i] = $membresStatsDonnees;
        $i++;
    }
// Statistiques du dernier inscrit
    $lastMembreReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastMembreDonnees = $lastMembreReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastMembre[$i] = $lastMembreDonnees;
        $i++;
    }
// <!-- Statistiques du dernier Ticket -->
    $lastTicketReq = $bddConnection->query('SELECT * FROM cmw_support ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastTicketDonnees = $lastTicketReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastTicket[$i] = $lastTicketDonnees;
        $i++;
    }
    // <!-- Statistiques du dernier Commentaire Support -->
    $lastCommentaireSuppReq = $bddConnection->query('SELECT * FROM cmw_support_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesSupp = $lastCommentaireSuppReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastCommentaireSupp[$i] = $lastCommentaireDonneesSupp;
        $i++;
    }
    $lastCommentaireNewsReq = $bddConnection->query('SELECT * FROM cmw_news_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesNews = $lastCommentaireNewsReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastCommentaireNews[$i] = $lastCommentaireDonneesNews;
        $i++;
    }
    $lastNewsReq = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastNewsDonnees = $lastNewsReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastNews[$i] = $lastNewsDonnees;
        $i++;
    }
    $lastVoteReq = $bddConnection->query('SELECT * FROM cmw_votes ORDER BY date_dernier DESC LIMIT 1;');
    $i = 0;
    while($lastVoteDonnees = $lastVoteReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastVote[$i] = $lastVoteDonnees;
        $i++;
    }
    $lastMaintenanceReq = $bddConnection->query('SELECT * FROM cmw_maintenance WHERE maintenanceId = 1');
    $i = 0;
    while($lastMaintenanceDonnees = $lastMaintenanceReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastMaintenance[$i] = $lastMaintenanceDonnees;
        $i++;
    }
    $req = $bddConnection->query('SELECT * FROM cmw_log_DealJeton ORDER BY date DESC LIMIT 10;');
    $i = 0;
    while($d = $req->fetch(PDO::FETCH_ASSOC))
    {
        $lastDealJeton[$i] = $d;
        $i++;
    }

}
?>